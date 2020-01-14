<?php

declare(strict_types=1);

namespace MobiMarket\RoyalMailShipping\Entities;

class ApiAuth
{
    /**
     * @var string
     */
    public $client_id;
    /**
     * @var string
     */
    public $client_secret;
    /**
     * @var string
     */
    public $username;
    /**
     * @var string
     */
    public $password;

    /**
     * @var string
     */
    public $token = null;

    /**
     * Create entity instance from array.
     */
    public static function fromArray(array $auth): self
    {
        $entity = new self();

        $entity->client_id     = $auth['client_id'];
        $entity->client_secret = $auth['client_secret'];
        $entity->username      = $auth['username'];
        $entity->password      = $auth['password'];

        return $entity;
    }
}
