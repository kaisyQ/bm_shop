<?php

declare(strict_types=1);

namespace App\Application\UseCase;

use App\Application\Intefaces\Service\PaymentServiceInterface;
use App\Application\Service\StripeService;
use App\Application\UseCase\Interface\PaymentUseCaseInterface;
use App\Infrastructure\Repository\ProductRepository;
use App\Infrastructure\Repository\ProductRepositoryInterface;
use Stripe\Exception\ApiErrorException;

final readonly class PaymentUseCase implements PaymentUseCaseInterface
{

    private PaymentServiceInterface $paymentAdapter;
    private ProductRepositoryInterface $productRepository;
    
    public function __construct(StripeService $paymentAdapter, ProductRepository $productRepository)
    {        
        $this->paymentAdapter = $paymentAdapter;
        $this->productRepository = $productRepository;
    }

    /**
     * @param int[]
     * @throws ApiErrorException
     */
    public function execute(array $productIds): \Stripe\StripeObject|array
    {

        $products = $this->productRepository->getByIds($productIds);

        $stripeItems = [];

        foreach ($products as $product) {
            $stripeItems[] = [
                'quantity' => 1,
                'price_data' => [
                    'currency' => 'usd',
                    'unit_amount' => $product->getDiscountPrice(),
                    'product_data' => [
                        'name' => $product->getName()
                    ]
                ]
            ];
        }

        return $this->paymentAdapter->pay($stripeItems);
    }
}