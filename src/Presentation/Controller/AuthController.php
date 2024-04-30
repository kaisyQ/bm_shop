<?php declare(strict_types=1);

namespace App\Presentation\Controller;

use App\Application\UseCase\ConfirmRegistrationUseCase;
use App\Application\UseCase\Interface\ConfirmRegistrationUseCaseInterface;
use App\Application\UseCase\Interface\LoginUseCaseInterface;
use App\Application\UseCase\Interface\LogoutUseCaseInterface;
use App\Application\UseCase\LoginUseCase;
use App\Application\UseCase\LogoutUseCase;
use App\Application\UseCase\RegisterUseCase;
use App\Infrastructure\Cache\Cache;
use App\Presentation\Request\ConfirmRegisterRequest;
use App\Presentation\Request\LoginRequest;
use App\Presentation\Request\RegisterRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


#[Route(path: '/api/v1/auth', name: 'auth')]
final class AuthController extends AbstractController 
{
    private LoginUseCaseInterface $loginUseCase;
    private RegisterUseCase $registerUseCase;
    private ConfirmRegistrationUseCaseInterface $confirmRegistrationUseCase;
    private LogoutUseCaseInterface $logoutUseCase;
    private Cache $cache;
    public function __construct(
        RegisterUseCase $registerUseCase,
        ConfirmRegistrationUseCase $confirmRegistrationUseCase,
        Cache $cache,
        LoginUseCase $loginUseCase,
        LogoutUseCase $logoutUseCase
    ){
        $this->confirmRegistrationUseCase = $confirmRegistrationUseCase;
        $this->registerUseCase = $registerUseCase;
        $this->cache = $cache;
        $this->loginUseCase = $loginUseCase;
        $this->logoutUseCase = $logoutUseCase;
    }

    /**
     * @throws \Exception
     */
    #[Route(path: '/login', name: 'auth_login', methods: ['POST'])]
    public function login(Request $request): JsonResponse
    {
        $payload = $request->getPayload();
        $data = new LoginRequest($payload->get('email'), $payload->get('password'));
        $result = $this->loginUseCase->execute($data);

        $hash = hash('sha256', uniqid((string)rand(), true));

        $cookie = new Cookie('session', $hash, time() + (2 * 365 * 24 * 60 * 60));

        $this->cache->set($hash, $result);

        $response = new JsonResponse();
        $response->headers->setCookie($cookie);

        return $response->setJson(json_encode($result));
    }

    #[Route(path: '/logout', name: 'auth_logout', methods: ['DELETE'])]
    public function logout(Request $request): JsonResponse
    {
        $this->logoutUseCase->execute($request->cookies->get('session'));
        return $this->json([
            'success' => true,
        ]);
    }

    /**
     * @throws \Exception
     */
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
        return $this->json([]);
    }

    /**
     * @throws \Exception
     *
     * @todo refactor and create docs
     */
    #[Route(path: '/register/confirm', name: 'auth_register_confirm', methods: ['POST'])]
    public function confirmRegistration(Request $request): JsonResponse
    {
        $payload = $request->getPayload();

        $data = new ConfirmRegisterRequest(
            $payload->get('email'),
            $payload->get('password'),
            $payload->get('username'),
            $payload->get('code')
        );

        $result = $this->confirmRegistrationUseCase->execute($data);

        $hash = hash('sha256', uniqid((string)rand(), true));

        $cookie = new Cookie('session', $hash, time() + (2 * 365 * 24 * 60 * 60));

        $this->cache->set($hash, $result);

        $response = new JsonResponse();

        $response->headers->setCookie($cookie);

        return $response->setJson(json_encode($result));
    }

    #[Route(path: '/check_me', name: 'auth_check_me', methods: ['GET'])]
    public function checkMe(Request $request)
    {
        return $this->json($this->cache->get(
            $request->cookies->get('session')
        ));
    }

}