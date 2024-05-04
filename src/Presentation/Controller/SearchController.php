<?php declare(strict_types=1);

namespace App\Presentation\Controller;

use App\Application\UseCase\SearchUseCase;
use App\Presentation\Docs\SearchControllerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: "/api/v1/search", name: "search")]
final class SearchController extends AbstractController implements SearchControllerInterface
{
    public function __construct(private readonly SearchUseCase $searchUseCase)
    {
    }

    #[Route(path: "/{query}", name: "index", methods: ["GET"])]
    public function index(string $query): JsonResponse
    {
        return $this->json($this->searchUseCase->execute($query));
    }
}
