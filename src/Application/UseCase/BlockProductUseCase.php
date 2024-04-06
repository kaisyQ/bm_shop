<?php

namespace App\Application\UseCase;

use App\Application\Enums\ProductStatusEnums;
use App\Infrastructure\Repository\ProductRepository;
use App\Infrastructure\Repository\ProductRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

final class BlockProductUseCase
{
    private ProductRepositoryInterface $productRepository;
    private EntityManagerInterface $em;
    public function __construct(ProductRepository $productRepository, EntityManagerInterface $em)
    {
        $this->productRepository = $productRepository;
        $this->em = $em;
    }

    public function execute(int $id): int
    {
        $product  = $this->productRepository->find($id);

        $product->setStatus(ProductStatusEnums::PENDING);

        $this->em->flush();


        return $product->getId();
    }
}