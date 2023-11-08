<?php


namespace App\Controller;

use App\Dto\ProductListItem;
use App\Dto\ProductListResponse;
use App\Service\ProductService;
use OpenApi\Attributes\Schema;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Attributes as OA;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;

#[Route(path: "/api/v1/products", name: "product_controller")]
class ProductController extends AbstractController
{
    public function __construct(private ProductService $productService)
    {
    }

    #[Route(path: "/", name: "index", methods: ["GET"])]
    #[OA\Response(
        response: 200,
        description: 'Return all products',
        content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(ref: new Model(type: ProductListResponse::class))
        ),
    )]
    #[OA\QueryParameter(name: "category", schema: new Schema(type: "?string"))]
    #[OA\QueryParameter(name: "limit", schema: new Schema(type: "?int"))]
    #[OA\QueryParameter(name: "page", schema: new Schema(type: "?int"))]
    public function index(
        #[MapQueryParameter] ?string $category,
        #[MapQueryParameter] ?int $limit,
        #[MapQueryParameter] ?int $page
    ) {
        return $this->json($this->productService->getProducts($category, $page, $limit));
    }

    #[Route(path: '/{slug}', name: 'show', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: 'Return product',
        content: new OA\JsonContent(
            ref: new Model(type: ProductListItem::class)
        )
    )]
    public function show(string $slug)
    {
        return $this->json($this->productService->getProductBySlug($slug));
    }
}
