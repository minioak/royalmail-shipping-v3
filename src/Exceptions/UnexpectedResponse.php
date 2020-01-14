<?php

declare(strict_types=1);

namespace MobiMarket\RoyalMailShipping\Exceptions;

use Throwable;

class UnexpectedResponse extends RoyalMailBaseException
{
    public function __construct(string $message, ?Throwable $previous = null)
    {
        parent::__construct($message, 1000, $previous);
    }
}
