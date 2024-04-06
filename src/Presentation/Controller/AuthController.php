<?php declare(strict_types=1);

namespace App\Presentation\Controller;

use App\Application\UseCase\RegisterUseCase;
use App\Presenstation\Request\RegisterRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


#[Route(path: '/api/v1/auth', name: 'auth')]
final class AuthController extends AbstractController 
{
    public function __construct(
        private readonly RegisterUseCase $registerUseCase
    ){}

    #[Route(path: '/login', name: 'auth_login', methods: ['POST'])]
    public function login() {

    }

    #[Route(path: '/logout', name: 'auth_logout', methods: ['DELETE'])]
    public function logout() {

    }

    #[Route(path: '/register', name: 'auth_register', methods: ['POST'])]
    public function register(Request $request): JsonResponse
    {
        $payload = $request->getPayload();

        $data = new RegisterRequest(
            $payload->get('email'),
            $payload->get('password'),
            $payload->get('username')
        );
        
        $this->registerUseCase->execute($data);
        
        return $this->json([$data]);
    }

    #[Route(path: '/check_me', name: 'auth_check_me', methods: ['GET'])]
    public function checkMe() {

    }
}