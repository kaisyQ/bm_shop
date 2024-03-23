<?php

namespace App\Application\Service;

use App\Presenstation\Dto\SearchListItem;
use App\Presenstation\Dto\SearchListResponse;
use App\Infrastructure\Repository\ProductRepository;
use Symfony\Component\Serializer\SerializerInterface;

final class SearchService
{
    public function __construct(
        private readonly ProductRepository $productRepository,
        private readonly SerializerInterface $serializer,
    ) {
    }
    public function search(string $query): SearchListResponse
    {
        $products = $this->productRepository->findByContainingName($query);
        $serializedProducts = $this->serializer->serialize($products, 'json', ['groups' => ['search']]);

        return new SearchListResponse(
            array_map(
                fn ($product) => new SearchListItem($product->id, $product->name, $product->slug, $product->attachments[0]->image),
                json_decode($serializedProducts)
            )
        );
    }
}
