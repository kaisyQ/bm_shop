<?php

namespace App\Controller;

use App\Service\SearchService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Attributes as OA;
use Nelmio\ApiDocBundle\Annotation\Model;
use App\Dto\SearchListItem;

#[Route(path: "/api/v1/search", name: "search")]

class SearchController extends AbstractController
{
    public function __construct(private SearchService $searchService)
    {
    }

    #[Route(path: "/{query}", name: "index", methods: ["GET"])]
    #[OA\Response(
        response: 200,
        description: 'Return all products',
        content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(ref: new Model(type: SearchListItem::class))
        )
    )]
    public function index(string $query)
    {
        return $this->json($this->searchService->search($query));
    }
}
