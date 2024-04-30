<?php

declare(strict_types=1);

namespace App\Presentation\Controller;

use App\Presentation\Request\PaymentRequestDto;
use App\Application\UseCase\Interface\PaymentUseCaseInterface;
use App\Application\UseCase\PaymentUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

#[Route(path: '/api/v1/payment', name: 'payment')]
final class PaymentController extends AbstractController
{
    private readonly PaymentUseCaseInterface $paymentUseCase;
    
    public function __construct(PaymentUseCase $paymentUseCase)
    {
        $this->paymentUseCase = $paymentUseCase;
    }

    #[Route(path: '/', name: 'payment_index', methods: ['POST'])]
    public function index(#[MapRequestPayload] PaymentRequestDto $request): Response
    {

        try {
            $payment = $this->paymentUseCase->execute($request->getProductIds());
        } catch (\Throwable $e) {
            return $this->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);            
        }

        return $this->redirect($payment->url, 303);
    }

}