<?php

declare(strict_types=1);

namespace App\Adapter\Interface;

use Stripe\StripeObject;

/**
 * Inteface for working with payment system
 */

interface PaymentAdapterInterface {

    /**
     * Create payment session
     * 
     * @return array|StripeObject
     */
    public function pay(): StripeObject|array;
}