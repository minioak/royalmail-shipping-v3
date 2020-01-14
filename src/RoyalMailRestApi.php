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
        ApiAuth $auth
    ) {
        $this->buildClient(
            $base_uri,
            $timeout,
            $should_log,
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
        return $this->sendAPIRequestNotEmpty('post', 'shipments', $body);
    }

    /*
     * PUT /shipments/{shipmentId}/printDocument
     */
    public function shipmentPrintDocument(string $shipment_id, array $body): object
    {
        return $this->sendAPIRequestNotEmpty('put', "shipments/{$shipment_id}/printDocument", $body);
    }

    /*
     * PUT /shipments/{shipmentId}/printLabel
     */
    public function shipmentPrintLabel(string $shipment_id, array $body): object
    {
        return $this->sendAPIRequestNotEmpty('put', "shipments/{$shipment_id}/printLabel", $body);
    }

    /*
     * PUT /shipments/cancel
     */
    public function shipmentCancel(array $body): object
    {
        return $this->sendAPIRequestNotEmpty('put', 'shipments/cancel', $body);
    }

    /*
     * PUT /shipments/defer
     */
    public function shipmentDefer(array $body): object
    {
        return $this->sendAPIRequestNotEmpty('put', 'shipments/defer', $body);
    }

    /*
     * PUT /shipments/hold
     */
    public function shipmentHold(array $body): object
    {
        return $this->sendAPIRequestNotEmpty('put', 'shipments/hold', $body);
    }

    /*
     * PUT /shipments/release
     */
    public function shipmentRelease(array $body): object
    {
        return $this->sendAPIRequestNotEmpty('put', 'shipments/release', $body);
    }

    /*
     * POST /shipments/serviceAvailability
     */
    public function shipmentServiceAvailability(array $body): object
    {
        return $this->sendAPIRequestNotEmpty('post', 'shipments/serviceAvailability', $body);
    }

    // manifests

    /*
     * POST /manifest
     */
    public function manifest(array $body): object
    {
        return $this->sendAPIRequestNotEmpty('post', 'manifest', $body);
    }

    /*
     * POST /manifest/bycarrier
     */
    public function manifestByCarrier(array $body): object
    {
        return $this->sendAPIRequestNotEmpty('post', 'manifest/bycarrier', $body);
    }

    /*
     * POST /manifest/byservice
     */
    public function manifestByService(array $body): object
    {
        return $this->sendAPIRequestNotEmpty('post', 'manifest/byservice', $body);
    }

    // addresses

    /*
     * GET /addresses
     * POST /addresses
     */
    public function allAddresses(?array $body = null): object
    {
        return $this->sendAPIRequestNotEmpty($body ? 'post' : 'get', 'addresses', $body);
    }

    /*
     * GET /addresses/{addressId}
     * POST /addresses/{addressId}
     */
    public function address(string $address_id, ?array $body = null): object
    {
        return $this->sendAPIRequestNotEmpty($body ? 'post' : 'get', "addresses/{$address_id}", $body);
    }

    // items

    /*
     * GET /items
     * POST /items
     */
    public function allItems(?array $body = null): object
    {
        return $this->sendAPIRequestNotEmpty($body ? 'post' : 'get', 'items', $body);
    }

    /*
     * GET /items/{itemId}
     * POST /items/{itemId}
     */
    public function item(string $item_id, ?array $body = null): object
    {
        return $this->sendAPIRequestNotEmpty($body ? 'post' : 'get', "items/{$item_id}", $body);
    }

    /*
     * DELETE /items/{itemId}
     */
    public function itemDelete(string $item_id, ?array $body = null): object
    {
        return $this->sendAPIRequestNotEmpty('delete', "items/{$item_id}", $body);
    }

    // packaging

    /*
     * GET /packaging
     * POST /packaging
     */
    public function allPackaging(?array $body = null): object
    {
        return $this->sendAPIRequestNotEmpty($body ? 'post' : 'get', 'packaging', $body);
    }

    /*
     * GET /packaging/{itemId}
     * POST /packaging/{itemId}
     */
    public function packaging(string $item_id, ?array $body = null): object
    {
        return $this->sendAPIRequestNotEmpty($body ? 'post' : 'get', "packaging/{$item_id}", $body);
    }

    /*
     * DELETE /packaging/{itemId}
     */
    public function packagingDelete(string $item_id, ?array $body = null): object
    {
        return $this->sendAPIRequestNotEmpty('delete', "packaging/{$item_id}", $body);
    }
}
