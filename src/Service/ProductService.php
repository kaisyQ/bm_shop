<?php

namespace App\Service;

use App\Dto\ProductListResponse;
use App\Repository\ProductRepository;
use App\Dto\ProductListItem;
use App\Serializer\Normalizer\ProductNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

class ProductService
{

    public function __construct(
        private ProductRepository $productRepository,
        private SerializerInterface $serializer,
        private ProductNormalizer $productNormalizer,
    ) {
    }
    public function getProducts(): ProductListResponse
    {

        $products = $this->productRepository->findAll();

        $serializedProducts = $this->serializer->serialize($products, 'json', ['groups' => ['product']]);

        return new ProductListResponse(
            array_map(
                fn ($product) => $this->productNormalizer->denormalize($product, ProductListItem::class),
                json_decode($serializedProducts)
            )
        );
    }
}
