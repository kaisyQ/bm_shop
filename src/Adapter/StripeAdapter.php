<?php 

declare(strict_types=1);

namespace App\Adapter;

use App\Adapter\Interface\PaymentAdapterInterface;
use Stripe\StripeObject;


final class StripeAdapter implements PaymentAdapterInterface
{
    public function __construct()
    {
        $this->setKey();
    }

    public function pay(): StripeObject|array
    {
    
        return \Stripe\Checkout\Session::create([
            'mode' => 'payment',
            'success_url' => 'http://localhost:3000/home',
            'line_items' => [
                [
                    'quantity' => 1,
                    'price_data' => [
                        'currency' => 'usd',
                        'unit_amount' => 2000,
                        'product_data' => [
                            'name' => 'BABABA'
                        ]
                    ]
                        ],
                        [
                            'quantity' => 1,
                            'price_data' => [
                                'currency' => 'usd',
                                'unit_amount' => 2000,
                                'product_data' => [
                                    'name' => 'BABABA'
                                ]
                            ]
                        ]
            ]
        ]);
    }

    private function setKey() 
    {
        \Stripe\Stripe::setApiKey($_ENV["STRIPE_SECRET"]);
    }
}