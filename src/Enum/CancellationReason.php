<?php

declare(strict_types=1);

namespace MobiMarket\RoyalMailShipping\Enum;

class CancellationReason
{
    public const OrderCancelled  = 'Order Cancelled';
    public const Repacked        = 'Repacked';
    public const PackedInError = 'Packed in Error';
    public const WrongService    = 'WrongService';
}
