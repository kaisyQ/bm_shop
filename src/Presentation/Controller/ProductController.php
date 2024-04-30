<?php

declare(strict_types=1);

namespace App\Presentation\Controller;

use App\Application\Service\ProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;

#[Route(path: "/api/v1/products", name: "product_controller")]
final class ProductController extends AbstractController
{
    public function __construct(
        private readonly ProductService $productService,
    )
    {
    }
    #[Route(path: "/", name: "index", methods: ["GET"])]
    // #[OA\Response(
    //     response: 200,
    //     description: 'Return all products',
    //     content: new OA\JsonContent(
    //         type: 'array',
    //         items: new OA\Items(ref: new Model(type: ProductListResponse::class))
    //     ),
    // )]
    // #[OA\QueryParameter(name: "category", schema: new Schema(type: "?string"))]
    // #[OA\QueryParameter(name: "limit", schema: new Schema(type: "?int"))]
    // #[OA\QueryParameter(name: "page", schema: new Schema(type: "?int"))]
    // #[OA\QueryParameter(name: 'priceFrom', schema: new Schema(type: '?int'))]
    // #[OA\QueryParameter(name: 'priceTo', schema: new Schema(type: '?int'))]
    // #[OA\QueryParameter(name: 'alphabetAtoZ', schema: new Schema(type: '?bool'))]
    // #[OA\QueryParameter(name: 'alphabetZtoA', schema: new Schema(type: '?bool'))]
    // #[OA\QueryParameter(name: 'date', schema: new Schema(type: '?bool'))]

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

        return $this->json(
            $this->productService->getProducts(
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
    }

    #[Route(path: '/{slug}', name: 'show', methods: ['GET'])]
    // #[OA\Response(
    //     response: 200,
    //     description: 'Return product',
    //     content: new OA\JsonContent(
    //         ref: new Model(type: ProductListItem::class)
    //     )
    // )]
    public function show(string $slug): JsonResponse
    {   
        return $this->json($this->productService->getProductBySlug($slug));
    }
}
