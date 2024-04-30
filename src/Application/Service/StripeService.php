<?php 

declare(strict_types=1);

namespace App\Application\Service;

use App\Application\Intefaces\Service\PaymentServiceInterface;
use Stripe\Exception\ApiErrorException;
use Stripe\StripeObject;


final class StripeService implements PaymentServiceInterface
{
    public function __construct()
    {
        $this->setKey();
    }

    /**
     * @throws ApiErrorException
     */
    public function pay(array $items): StripeObject|array
    {
    
        return \Stripe\Checkout\Session::create([
            'mode' => 'payment',
            'success_url' => 'http://localhost:3000/home',
            'line_items' => $items
        ]);
    }

    private function setKey(): void
    {
        \Stripe\Stripe::setApiKey($_ENV["STRIPE_SECRET"]);
    }
}