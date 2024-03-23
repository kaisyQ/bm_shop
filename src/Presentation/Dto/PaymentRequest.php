<?php

declare(strict_types=1);

namespace App\Presenstation\Dto;

final class PaymentRequestDto 
{

    /**
     * @var int[]
     */
    private array $productIds;

    /**
     * @param int[]
     */
    public function __construct(array $productIds)
    {
        $this->productIds = $productIds;
    }


    public function getProductIds() 
    {
        return $this->productIds;
    }
}