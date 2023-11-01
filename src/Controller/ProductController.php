<?php


namespace App\Controller;

use App\Dto\ProductListItem;
use App\Dto\ProductListResponse;
use App\Service\ProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Attributes as OA;
use Nelmio\ApiDocBundle\Annotation\Model;


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
        )
    )]
    public function index()
    {
        return $this->json($this->productService->getProducts());
    }

    #[Route(path: '/{id}', name: 'show', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: 'Return product',
        content: new OA\JsonContent(
            ref: new Model(type: ProductListItem::class)
        )
    )]
    public function show(int $id)
    {
        return $this->json($this->productService->getProduct($id));
    }
    
}
