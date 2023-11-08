<?php


namespace App\Service;

use App\Dto\BestsellerListItem;
use App\Dto\BestsellerListResponse;
use App\Repository\ProductRepository;
use App\Serializer\Normalizer\ProductNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

class BestsellerService
{
    public function __construct(
        private ProductRepository $productRepository,
        private SerializerInterface $serializer,
        private ProductNormalizer $productNormalizer,
    ) {
    }

    public function getBestsellers(): BestsellerListResponse
    {
        $products = $this->productRepository->findBy(['bestseller' => true]);
        $serializedProducts = $this->serializer->serialize($products, 'json', ['groups' => ['product']]);

        return new BestsellerListResponse(
            array_map(
                fn ($product) =>
                new BestsellerListItem($product->id, $product->name, $product->price, $product->discountPrice),
                json_decode($serializedProducts)
            )
        );
    }
}
