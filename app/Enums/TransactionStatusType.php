<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class TransactionStatusType extends Enum
{
    const WaitingForPayment = 'waiting_for_payment';
    const WaitingForConfirmation = 'waiting_for_confirmation';
    const WaitingForDelivery = 'waiting_for_delivery';
    const Completed = 'completed';
    const Canceled = 'canceled';
}
