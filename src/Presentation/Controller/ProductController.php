<?php

declare(strict_types=1);

namespace App\Presentation\Controller;

use App\Application\Service\ProductService;
use App\Application\UseCase\GetProductBySlug;
use App\Application\UseCase\GetProductsUseCase;
use App\Application\UseCase\Interface\GetProductBySlugInterface;
use App\Application\UseCase\Interface\GetProductsUseCaseInterface;
use App\Presentation\Dto\GetProductsDto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;

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
    public function index(
        #[MapQueryParameter] ?string $category,
        #[MapQueryParameter] ?int $limit,
        #[MapQueryParameter] ?int $page,
        #[MapQueryParameter] ?int $priceFrom,
        #[MapQueryParameter] ?int $priceTo,
        #[MapQueryParameter] ?bool $alphabetAtoZ,
        #[MapQueryParameter] ?bool $alphabetZtoA,
        #[MapQueryParameter] ?bool $oldest,
        #[MapQueryParameter] ?bool $newest

    ): JsonResponse
    {
        $result = $this->getProductsUseCase->execute(
            new GetProductsDto(
                $category,
                $page,
                $limit,
                $priceFrom,
                $priceTo,
                $alphabetAtoZ,
                $alphabetZtoA,
                $oldest,
                $newest
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
