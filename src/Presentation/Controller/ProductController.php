<?php

declare(strict_types=1);

namespace App\Presentation\Controller;

use App\Application\UseCase\GetProductBySlug;
use App\Application\UseCase\GetProductsUseCase;
use App\Application\UseCase\Interface\GetProductBySlugInterface;
use App\Application\UseCase\Interface\GetProductsUseCaseInterface;
use App\Presentation\Dto\GetProductsDto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: "/api/v1/products", name: "product_controller")]
final class ProductController extends AbstractController
{
    private GetProductsUseCaseInterface $getProductsUseCase;
    private GetProductBySlugInterface $getProductBySlugUseCase;
    public function __construct(
        GetProductBySlug $getProductBySlugUseCase,
        GetProductsUseCase $getProductsUseCase
    ) {
        $this->getProductBySlugUseCase = $getProductBySlugUseCase;
        $this->getProductsUseCase = $getProductsUseCase;
    }

    #[Route(path: "/", name: "index", methods: ["GET"])]
    public function index(Request $request): JsonResponse
    {
        $result = $this->getProductsUseCase->execute(
            new GetProductsDto(
                $request->query->get('category'),
                (int)$request->query->get('limit'),
                $request->query->get('page') ? (int)$request->query->get('page') : null,
                $request->query->get('priceFrom') ? (int)$request->query->get('priceFrom') : null,
                $request->query->get('priceTo') ? (int)$request->query->get('priceTo') : null,
                $request->query->get('alphabetAtoZ') === 'true',
                $request->query->get('alphabetZtoA') === 'true',
                $request->query->get('oldest') === 'true',
                $request->query->get('newest') === 'true'
            )
        );
        return $this->json($result);
    }

    #[Route(path: '/{slug}', name: 'how', methods: ['GET'])]
    public function show(string $slug): JsonResponse
    {
        $result = $this->getProductBySlugUseCase->execute($slug);

        return $this->json($result);
    }
}
