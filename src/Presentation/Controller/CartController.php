<?php declare(strict_types=1);

namespace App\Presentation\Controller;

use App\Application\UseCase\BlockProductUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/api/v1/cart', name: 'cart')]
final class CartController extends AbstractController
{

    private BlockProductUseCase $blockProductUseCase;
    public function __construct(BlockProductUseCase $blockProductUseCase)
    {
        $this->blockProductUseCase = $blockProductUseCase;
    }

    #[Route(path: '/{id}/block', name: 'cart_block_product')]
    public function addToCart(Request $request, int $id): JsonResponse
    {

        $blockedProductId = $this->blockProductUseCase->execute($id);

        return $this->json([
            'success' => true,
            'id' => $blockedProductId
        ]);
    }
}