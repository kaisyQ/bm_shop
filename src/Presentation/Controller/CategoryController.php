<?php
declare(strict_types=1);
namespace App\Presentation\Controller;

use App\Dto\CategoryListItem;
use App\Application\Service\CategoryService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Attributes as OA;
use Nelmio\ApiDocBundle\Annotation\Model;

#[Route(path: "/api/v1/categories", name: "categories")]
final class CategoryController extends AbstractController
{

    public function __construct(private readonly CategoryService $categoryService)
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
    public function index(): JsonResponse
    {
        return $this->json($this->categoryService->getCategories());
    }


    #[Route(path: "/{id}", name: "categories_destroy", methods: ['DELETE'])]
    #[OA\Response(
        response: 200,
        description: 'Return deleted category status message',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'message', type: 'string')
            ],
            type: 'object'
        )
    )]
    public function destroy(int $id): JsonResponse
    {
        try {
            $this->categoryService->deleteById($id);
        } catch (\Throwable $e) {
            return $this->json(['message' => $e->getMessage()]);
        }

        return $this->json(['message' => 'Category was successfully deleted!']);
    }
}
