<?php

declare(strict_types=1);

namespace MobiMarket\RoyalMailShipping\Enum;

class CancellationReason
{
    public const OrderCancelled  = 'OrderCancelled';
    public const Repacked        = 'Repacked';
    public const UploadedInError = 'UploadedInError';
    public const WrongService    = 'WrongService';
}
