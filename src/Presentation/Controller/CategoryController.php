<?php declare(strict_types=1);

namespace App\Presentation\Controller;

use App\Application\Service\CategoryService;
use App\Presentation\Docs\CategoryControllerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: "/api/v1/categories", name: "categories")]
final class CategoryController extends AbstractController implements CategoryControllerInterface
{

    public function __construct(
        private readonly CategoryService $categoryService
    ){}

    #[Route(path: "/", name: "categories_index", methods: ['GET'])]
    public function index(): JsonResponse
    {
        return $this->json($this->categoryService->getCategories());
    }


    #[Route(path: "/{id}", name: "categories_destroy", methods: ['DELETE'])]
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
