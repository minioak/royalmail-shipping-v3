<?php

declare(strict_types=1);

namespace MobiMarket\RoyalMailShipping;

use Illuminate\Support\Facades\Facade;

/**
 * @method object shipment(array $body)
 * @method object shipmentStatus(array $body)
 */
class RoyalMailFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return RoyalMailRestApi::class;
    }
}
