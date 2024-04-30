<?php declare(strict_types=1);


namespace App\Application\Service;

use App\Presentation\Response\BestsellerListItem;
use App\Presentation\Response\BestsellerListResponse;
use App\Infrastructure\Repository\ProductRepository;
use Symfony\Component\Serializer\SerializerInterface;

final class BestsellerService
{
    public function __construct(
        private ProductRepository $productRepository,
        private SerializerInterface $serializer,
    ) {}

    public function getBestsellers(): BestsellerListResponse
    {
        //$products = $this->productRepository->findBy(['bestseller' => true]);
        //$serializedProducts = $this->serializer->serialize($products, 'json', ['groups' => ['product']]);


//        return new BestsellerListResponse (
//            array_map(
//                fn ($product) =>
//                new BestsellerListItem(
//                    $product['id'],
//                    $product['name'],
//                    $product['slug'],
//                    $product['price'],
//                    array_map(fn ($attachment) => $attachment['image'], $product['attachments']),
//                    $product['discountPrice'],
//                ),
//               json_decode($serializedProducts)
//            )
//        );
        return new BestsellerListResponse([]);
    }
}
