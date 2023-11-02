<?php

namespace App\Service;

use App\Dto\ProductListItem;
use App\Dto\ProductListResponse;
use App\Dto\SearchListItem;
use App\Dto\SearchListResponse;
use App\Repository\ProductRepository;
use App\Serializer\Normalizer\ProductNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

class SearchService
{
    public function __construct(
        private ProductRepository $productRepository,
        private SerializerInterface $serializer,
        private ProductNormalizer $productNormalizer
    ) {
    }
    public function search(string $query)
    {
        $products = $this->productRepository->findByContainingName($query);
        $serializedProducts = $this->serializer->serialize($products, 'json', ['groups' => ['search']]);
        
        //dd($serializedProducts);
        return new SearchListResponse(
            array_map(
                fn ($product) => new SearchListItem($product->id, $product->name, $product->slug, $product->attachments[0]->image),
                json_decode($serializedProducts)
            )
        );
    }
}
