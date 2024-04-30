<?php declare(strict_types=1);

namespace App\Application\UseCase;

use App\Application\Enums\ProductStatusEnums;
use App\Domain\Entity\UserCart;
use App\Infrastructure\Repository\ProductRepository;
use App\Infrastructure\Repository\ProductRepositoryInterface;
use App\Infrastructure\Repository\UserCartRepository;
use Doctrine\ORM\EntityManagerInterface;

final class AddProductToCartUseCase
{
    private ProductRepositoryInterface $productRepository;
    private UserCartRepository $userCartRepository;
    private EntityManagerInterface $em;
    public function __construct(
        ProductRepository $productRepository,
        UserCartRepository $userCartRepository,
        EntityManagerInterface $em
    ){
        $this->productRepository = $productRepository;
        $this->userCartRepository = $userCartRepository;
        $this->em = $em;
    }

    /**
     * @throws \Exception
     */
    public function execute(int $id): int
    {
        $product  = $this->productRepository->find($id);

        if (!$product) {
            throw new \Exception('Error product not found!');
        }

        $cartItem = $this->userCartRepository->findOneBy([
            'productId' => $product->getId(),
            'userId' => 1
        ]);

        if (!$cartItem) {
            $cartItem = (new UserCart())->setUserId(1)->setProductId($product->getId());

            $this->em->persist($cartItem);
        } else {
            $cartItem->setUpdatedAt(new \DateTimeImmutable());
        }

        $product->setStatus(ProductStatusEnums::PENDING);

        $this->em->flush();

        return $product->getId();
    }
}