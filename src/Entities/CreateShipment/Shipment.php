<?php

declare(strict_types=1);

namespace MobiMarket\RoyalMailShipping\Entities\CreateShipment;

use MobiMarket\RoyalMailShipping\Entities\FillableEntity;
use MobiMarket\RoyalMailShipping\Entities\Shipper;

class Shipment extends FillableEntity
{
    /**
     * @var Shipper
     */
    public $shipper;
    /**
     * @var Destination
     */
    public $destination;
    /**
     * @var ShipmentInformation
     */
    public $shipment_information;
}
