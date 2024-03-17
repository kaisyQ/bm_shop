<?php
declare(strict_types=1);
namespace App\Controller;

use App\Dto\BestsellerListItem;
use App\Service\BestsellerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Attributes as OA;
use Nelmio\ApiDocBundle\Annotation\Model;

#[Route(path: "/api/v1/bestsellers", name: "bestseller")]
final class BestsellerController extends AbstractController
{
    public function __construct(private readonly BestsellerService $bestsellerService)
    {
    }

    #[Route(path: "/", name: "bestseller_index", methods: ["GET"])]
    #[OA\Response(
        response: 200,
        description: 'Return all bestseller products',
        content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(ref: new Model(type: BestsellerListItem::class))
        ),
    )]
    public function index() : JsonResponse
    {
        return $this->json($this->bestsellerService->getBestsellers());
    }
}

