<?php

namespace App\UseCase\Interface;

/**
 *
 * Interface of the main payment method
 */
interface PaymentUseCaseInterface
{
    /**
     * @param int[]
     */
    public function execute(array $productIds);
}