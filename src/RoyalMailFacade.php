<?php

declare(strict_types=1);

namespace MobiMarket\RoyalMailShipping;

use Illuminate\Support\Facades\Facade;

/**
 * @method object shipment(array $body)
 * @method object shipmentPrintDocument(string $shipment_id, array $body)
 * @method object shipmentPrintLabel(string $shipment_id, array $body)
 * @method object shipmentCancel(array $body)
 * @method object shipmentDefer(array $body)
 * @method object shipmentHold(array $body)
 * @method object shipmentRelease(array $body)
 * @method object shipmentServiceAvailability(array $body)
 * @method object manifest(array $body)
 * @method object manifestByCarrier(array $body)
 * @method object manifestByService(array $body)
 * @method object allAddresses(?array $body = null)
 * @method object address(string $address_id, ?array $body = null)
 * @method object allItems(?array $body = null)
 * @method object item(string $item_id, ?array $body = null)
 * @method object itemDelete(string $item_id, ?array $body = null)
 * @method object allPackaging(?array $body = null)
 * @method object packaging(string $item_id, ?array $body = null)
 * @method object packagingDelete(string $item_id, ?array $body = null)
 */
class RoyalMailFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return RoyalMailRestApi::class;
    }
}
