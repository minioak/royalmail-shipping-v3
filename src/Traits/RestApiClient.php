<?php

declare(strict_types=1);

namespace MobiMarket\RoyalMailShipping\Traits;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Provider\GenericProvider;
use MobiMarket\RoyalMailShipping\Entities\ApiAuth;
use MobiMarket\RoyalMailShipping\Exceptions\RequestFailed;
use MobiMarket\RoyalMailShipping\Exceptions\UnexpectedResponse;
use Psr\Http\Message\ResponseInterface as HttpResponse;
use stdClass;

trait RestApiClient
{
    /**
     * @var HttpClient
     */
    protected HttpClient $client;

    /**
     * @var ApiAuth
     */
    protected ApiAuth $auth;

    /**
     * @var int|null
     */
    protected ?int $cache_ttl = null;

    /**
     * Sets up require parameters for the api.
     */
    public function buildClient(
        string $base_uri,
        float $timeout,
        bool $should_log,
        ?int $cache_ttl,
        ApiAuth $auth
    ): void {
        $stack = HandlerStack::create();

        if (true === $should_log) {
            $stack->push(
                Middleware::log(
                    Log::getLogger(),
                    new MessageFormatter('{req_body} - {res_body}'),
                    'debug'
                )
            );

            $stack->push(
                Middleware::log(
                    Log::getLogger(),
                    new MessageFormatter('{uri} - {method} - {code}'),
                    'debug'
                )
            );
        }

        $this->client = new HttpClient([
            // Base URI is used with relative requests
            'base_uri'    => $base_uri,
            // You can set any number of default request options.
            'timeout'     => $timeout,
            // Handler stack for logging purposes.
            'handler'     => $stack,
            // Disable internal errors to let us catch all status codes.
            'http_errors' => false,
        ]);

        $this->auth      = $auth;
        $this->cache_ttl = $cache_ttl;

        // If caching is enabled, attempt to load it.
        if ($cache_ttl && $token = Cache::get('rm-access-token')) {
            $this->auth->token = $token;
        }
    }

    /**
     * Send the request to the API.
     */
    protected function sendAPIRequest(
        string $method,
        string $endpoint,
        ?array $data = null,
        ?array $headers = null,
        bool $dont_refresh = false
    ): ?stdClass {
        // First request which isn't to get a token should get a
        // token first.
        if (false === $dont_refresh && null === $this->auth->token) {
            $this->getFreshToken();
        }

        $body    = json_encode($data ?? []);
        $headers = $headers ?? [
            'Authorization'  => 'Bearer '.$this->auth->token
        ];

        /**
         * @var HttpResponse
         */
        $response = $this->client->{$method}($endpoint, [
            'body'      => $body,
            'headers'   => [
                'Accept'        => 'application/json',
                'Content-Type'  => 'application/json',
            ] + $headers,
        ]);

        $code = $response->getStatusCode();

        // Codes from 400 to 5XX are errors
        if ($code >= 400 && $code <= 599) {
            // Refresh + Unauthed
            if (false === $dont_refresh && 401 === $code) {
                $this->getFreshToken();

                // We should have a fresh token, give it another shot.
                // (however we tell it not to continue trying if it fails)
                return $this->sendAPIRequest(
                    $method,
                    $endpoint,
                    $data,
                    $headers,
                    $dont_refresh = true
                );
            }

            throw new RequestFailed($response);
        }

        // Methods either return nothing or json, so the caller
        // should expect an object or null.
        return json_decode((string) $response->getBody());
    }

    protected function sendAPIRequestNotEmpty(
        string $method,
        string $endpoint,
        ?array $data = null,
        ?array $headers = null,
        bool $dont_refresh = false
    ): ?stdClass {
        if ($response = $this->sendAPIRequest($method, $endpoint, $data, $headers, $dont_refresh)) {
        } else {
            throw new UnexpectedResponse('Response is empty');
        }

        return $response;
    }

    /**
     * Send a request to /token to refresh the token for other methods.
     * POST /token.
     */
    protected function getFreshToken(): void
    {
        $provider = new GenericProvider([
            'clientId'                => $this->auth->client_id,    // The client ID assigned to you by the provider
            'clientSecret'            => $this->auth->client_secret,    // The client password assigned to you by the provider
            'redirectUri'             => 'un-used',
            'urlAuthorize'            => 'un-used',
            'urlAccessToken'          => 'https://authentication.proshipping.net/connect/token',
            'urlResourceOwnerDetails' => 'un-used'
        ]);

        try {
            // Try to get an access token using the client credentials grant.
            $this->auth->token = $provider->getAccessToken('client_credentials')->getToken();
        } catch (IdentityProviderException $e) {
            $this->auth->token = '';
        }

        if ($this->cache_ttl) {
            Cache::put('rm-access-token', $this->auth->token, $this->cache_ttl);
        }
    }
}
