<?php

declare(strict_types=1);

namespace MobiMarket\RoyalMailShipping\Entities\CreateShipment;

use MobiMarket\RoyalMailShipping\Entities\FillableEntity;

class ShipmentInformation extends FillableEntity
{
    /**
     * @var string
     */
    public $shipment_date;
    /**
     * @var string
     */
    public $service_code;
    /**
     * @var ServiceOptions
     */
    public $service_options;
}
