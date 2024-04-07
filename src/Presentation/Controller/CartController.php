<?php declare(strict_types=1);

namespace App\Presentation\Controller;

use App\Application\UseCase\AddProductToCartUseCase;
use App\Application\UseCase\DeleteProductFromCartUserCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/api/v1/cart', name: 'cart')]
final class CartController extends AbstractController
{

    private AddProductToCartUseCase $addProductToCartUseCase;
    private DeleteProductFromCartUserCase $deleteProductFromCartUserCase;
    public function __construct(
        AddProductToCartUseCase $addProductToCartUseCase,
        DeleteProductFromCartUserCase $deleteProductFromCartUserCase
    ){
        $this->addProductToCartUseCase = $addProductToCartUseCase;
        $this->deleteProductFromCartUserCase = $deleteProductFromCartUserCase;
    }

    /**
     * @throws \Exception
     */
    #[Route(path: '/', name: 'cart_product', methods: ['POST'])]
    public function addToCart(Request $request): JsonResponse
    {
        $payload = $request->getPayload();

        $addedProductId = $this->addProductToCartUseCase->execute($payload->get('product_id'));

        return $this->json([
            'success' => true,
            'id' => $addedProductId
        ]);
    }

    #[Route(path: '/by_product_id/{productId}/', name: 'cart_product_delete', methods: ['DELETE'])]
    public function delete(Request $request, int $productId): JsonResponse
    {
        $deletedProductId = $this->deleteProductFromCartUserCase->execute($productId, 1);

        return $this->json([
            'success' => true,
            'id' => $deletedProductId
        ]);
    }
}