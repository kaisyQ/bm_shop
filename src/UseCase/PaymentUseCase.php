<?php

declare(strict_types=1);

namespace App\UseCase;

use App\Adapter\Interface\PaymentAdapterInterface;
use App\Adapter\StripeAdapter;
use App\Repository\ProductRepository;
use App\UseCase\Interface\PaymentUseCaseInterface;
use App\Repository\IProductRepositoryInterface;

final readonly class PaymentUseCase implements PaymentUseCaseInterface
{

    private PaymentAdapterInterface $paymentAdapter;
    private IProductRepositoryInterface $productRepository;
    
    public function __construct(StripeAdapter $paymentAdapter, ProductRepository $productRepository)
    {        
        $this->paymentAdapter = $paymentAdapter;
        $this->productRepository = $productRepository;
    }

    /**
     * @param int[]
     */
    public function execute(array $productIds)
    {

        $products = $this->productRepository->getByIds($productIds);
        return $this->paymentAdapter->pay();    
    }
}