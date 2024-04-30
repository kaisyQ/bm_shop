<?php declare(strict_types=1);

namespace App\Presentation\Request;

final class PaymentRequest
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