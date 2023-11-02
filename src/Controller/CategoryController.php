<?php

namespace App\Controller;

use App\Dto\CategoryListItem;
use App\Service\CategoryService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Attributes as OA;
use Nelmio\ApiDocBundle\Annotation\Model;

#[Route(path: "/api/v1/categories", name: "categories")]
class CategoryController extends AbstractController
{

    public function __construct(private CategoryService $categoryService)
    {
    }

    #[Route(path: "/", name: "categories_index", methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: 'Return all categories',
        content: new OA\JsonContent(
            ref: new Model(type: CategoryListItem::class)
        )
    )]
    public function index()
    {
        return $this->json($this->categoryService->getCategories());
    }
}
