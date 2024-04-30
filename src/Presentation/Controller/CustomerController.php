<?php declare(strict_types=1);

namespace App\Presentation\Controller;

use App\Application\UseCase\ChangePasswordUseCase;
use App\Application\UseCase\Interface\ChangePasswordUseCaseInterface;
use App\Application\UseCase\Interface\RefreshPasswordUseCaseInterface;
use App\Application\UseCase\RefreshPasswordUseCase;
use App\Presentation\Request\ChangePasswordRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/api/v1/customer', name: 'customer')]
final class CustomerController extends AbstractController
{
    private RefreshPasswordUseCaseInterface $refreshPasswordUseCase;
    private ChangePasswordUseCaseInterface $changePasswordUseCase;

    public function __construct(
        RefreshPasswordUseCase $refreshPasswordUseCase,
        ChangePasswordUseCase $changePasswordUseCase
    ) {
        $this->refreshPasswordUseCase = $refreshPasswordUseCase;
        $this->changePasswordUseCase = $changePasswordUseCase;
    }

    /**
     * @throws \Exception
     */
    #[Route(path: '/password/reset', name: 'customer_password_refresh', methods: ['PUT'])]
    public function refreshPassword(Request $request): JsonResponse
    {
        $this->refreshPasswordUseCase->execute($request->getPayload()->get('email'));

        return $this->json(['success' => true]);
    }

    #[Route('/password', name: 'customer_password_update', methods: ['PUT'])]

    public function changePassword(Request $request): JsonResponse
    {
        $payload = $request->getPayload();

        $data = new ChangePasswordRequest(
            $payload->get('old_password'),
            $payload->get('new_password'),
            $payload->get('email')
        );

        $this->changePasswordUseCase->execute($data);

        return $this->json(['success' => true]);
    }
}