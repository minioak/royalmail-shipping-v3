<?php

declare(strict_types=1);

namespace MobiMarket\RoyalMailShipping\Exceptions;

use Psr\Http\Message\ResponseInterface as HttpResponse;
use Throwable;

class RequestFailed extends RoyalMailBaseException
{
    /**
     * @var HttpResponse
     */
    protected $response;

    public function __construct(HttpResponse $response, ?Throwable $previous = null)
    {
        $this->response = $response;

        parent::__construct((string) $response->getBody(), $response->getStatusCode(), $previous);
    }

    public function getResponse(): HttpResponse
    {
        return $this->response;
    }
}
