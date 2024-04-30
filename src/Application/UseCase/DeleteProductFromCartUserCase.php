<?php declare(strict_types=1);

namespace App\Application\UseCase;

use App\Application\Enums\ProductStatusEnums;
use App\Infrastructure\Repository\ProductRepository;
use App\Infrastructure\Repository\ProductRepositoryInterface;
use App\Infrastructure\Repository\UserCartRepository;
use Doctrine\ORM\EntityManagerInterface;

final class DeleteProductFromCartUserCase
{
    private EntityManagerInterface $em;
    private UserCartRepository $userCartRepository;
    private ProductRepositoryInterface $productRepository;
    public function __construct(
        EntityManagerInterface $em,
        UserCartRepository $userCartRepository,
        ProductRepository $productRepository
    ){
        $this->em = $em;
        $this->userCartRepository = $userCartRepository;
        $this->productRepository = $productRepository;
    }


    /**
     * @throws \Exception
     */
    public function execute(int $productId, int $userId): int
    {
        $product = $this->productRepository->find($productId);

        if (!$product) {
            throw new \Exception('Failed to retrieve product');
        }

        $product->setStatus(ProductStatusEnums::AVAILABLE);

        $cartItem = $this->userCartRepository->findOneBy([
            'userId' => $userId,
            'productId' => $productId
        ]);


        if (!$cartItem) {
            throw new \Exception('Failed to retrieve product from cart');
        }

        $this->em->remove($cartItem);

        $this->em->flush();

        return $productId;
    }
}