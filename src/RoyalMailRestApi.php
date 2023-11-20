<?php

declare(strict_types=1);

namespace MobiMarket\RoyalMailShipping;

use MobiMarket\RoyalMailShipping\Entities\ApiAuth;
use MobiMarket\RoyalMailShipping\Traits\RestApiClient;

class RoyalMailRestApi
{
    use RestApiClient;

    public function __construct(
        string $base_uri,
        float $timeout,
        bool $should_log,
        ?int $cache_ttl,
        ApiAuth $auth
    ) {
        $this->buildClient(
            $base_uri,
            $timeout,
            $should_log,
            $cache_ttl,
            $auth
        );
    }

    // entities are not complete because of time constraints so are array -> object

    // shipments

    /*
     * POST /shipments
     */
    public function shipment(array $body): object
    {
        return $this->sendAPIRequestNotEmpty('post', 'shipments/rm', $body);
    }

    /*
     * PUT /shipments/status
     */
    public function shipmentStatus(array $body): ?object
    {
        return $this->sendAPIRequestNotEmpty('put', 'shipments/cancel', $body);
    }
}
