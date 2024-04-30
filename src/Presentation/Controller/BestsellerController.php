<?php

declare(strict_types=1);

namespace App\Presentation\Controller;

use App\Application\Service\BestsellerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Presentation\Docs\BestsellerControllerInterface;

#[Route(path: "/api/v1/bestsellers", name: "bestseller")]
final class BestsellerController extends AbstractController implements BestsellerControllerInterface
{
    public function __construct(
        private readonly BestsellerService $bestsellerService
    ){}


    #[Route(path: "/", name: "bestseller_index", methods: ["GET"])]
    public function index() : JsonResponse
    {
        return $this->json([]);
        return $this->json($this->bestsellerService->getBestsellers());
    }
}

