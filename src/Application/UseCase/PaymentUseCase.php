<?php

declare(strict_types=1);

namespace App\Application\UseCase;

use App\Adapter\Interface\PaymentAdapterInterface;
use App\Adapter\StripeAdapter;
use App\Infrastructure\Repository\ProductRepository;
use App\Application\UseCase\Interface\PaymentUseCaseInterface;
use App\Infrastructure\Repository\ProductRepositoryInterface;

final readonly class PaymentUseCase implements PaymentUseCaseInterface
{

    private PaymentAdapterInterface $paymentAdapter;
    private ProductRepositoryInterface $productRepository;
    
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