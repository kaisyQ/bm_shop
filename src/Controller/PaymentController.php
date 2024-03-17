<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dto\PaymentRequestDto;
use App\UseCase\Interface\PaymentUseCaseInterface;
use App\UseCase\PaymentUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

#[Route(path: '/payment', name: 'payment')]
final class PaymentController extends AbstractController
{
    private readonly PaymentUseCaseInterface $paymentUseCase;
    public function __construct(PaymentUseCase $paymentUseCase)
    {
        $this->paymentUseCase = $paymentUseCase;
    }

    #[Route(path: '/', name: 'payment_index')]
    #[OA\Response(
        response: 200,
        description: 'Return bababa',
        content: new OA\JsonContent()
    )]
    public function index(#[MapRequestPayload] PaymentRequestDto $request): JsonResponse
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