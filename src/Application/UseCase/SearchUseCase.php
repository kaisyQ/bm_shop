<?php declare(strict_types=1);

namespace App\Application\UseCase;

use App\Infrastructure\Repository\ProductRepository;
use App\Presentation\Response\SearchListItem;
use App\Presentation\Response\SearchListResponse;
use Symfony\Component\Serializer\SerializerInterface;

final readonly class SearchUseCase
{
    public function __construct(
        private ProductRepository   $productRepository,
        private SerializerInterface $serializer,
    ) {
    }
    public function execute(string $query): SearchListResponse
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
