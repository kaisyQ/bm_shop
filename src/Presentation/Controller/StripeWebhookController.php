<?php declare(strict_types=1);

namespace App\Presentation\Controller;

use Stripe\Webhook;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/api/v1/stripe/webhook', name: 'webhook')]
final class StripeWebhookController extends AbstractController
{
    public function __construct()
    {
    }

    #[Route(path: '/', name: 'webhook', methods: ['POST'])]
    public function index(Request $request): Response
    {
        $payload = $request->getContent();
        $sigHeader = $request->headers->get('Stripe-Signature');
        $endpointSecret = 'whsec_365b8522227866229c2bc3e1ddf2d3ffd27e3c1bf1bfdaba0aef4d3b6a16ac63';

        try {
            $event = Webhook::constructEvent(
                $payload, $sigHeader, $endpointSecret
            );
        } catch(\UnexpectedValueException|\Stripe\Exception\SignatureVerificationException $e) {
            return $this->json([
                'success' => false,
            ])->setStatusCode(400);
        }

        if ($event->type === 'charge.succeeded') {
            $charge = $event->data->object;

        }

        return $this->json([
            'success' => true,
        ]);
    }
}