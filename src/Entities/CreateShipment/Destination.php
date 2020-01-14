<?php

declare(strict_types=1);

namespace MobiMarket\RoyalMailShipping\Entities\CreateShipment;

use MobiMarket\RoyalMailShipping\Entities\FillableEntity;

class Destination extends FillableEntity
{
    /**
     * @var string
     */
    public $address_id;
    /**
     * @var string
     */
    public $company_name;
    /**
     * @var string
     */
    public $contact_name;
    /**
     * @var string
     */
    public $address_line1;
    /**
     * @var string
     */
    public $address_line2;
    /**
     * @var string
     */
    public $address_line3;
    /**
     * @var string
     */
    public $town;
    /**
     * @var string
     */
    public $county;
    /**
     * @var string
     */
    public $country_code;
    /**
     * @var string
     */
    public $postcode;
    /**
     * @var string
     */
    public $phone_number;
    /**
     * @var string
     */
    public $email_address;
    /**
     * @var string
     */
    public $vat_number;
}
