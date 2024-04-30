<?php

declare(strict_types=1);

namespace App\Application\Intefaces\Service;

use Stripe\StripeObject;

/**
 * Interface for working with payment system
 */

interface PaymentServiceInterface {

    /**
     * Create payment session
     *
     * @return array|StripeObject
     */
    public function pay(array $items): StripeObject|array;
}