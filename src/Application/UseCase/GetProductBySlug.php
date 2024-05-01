<?php declare(strict_types=1);

namespace App\Application\UseCase;

use App\Application\UseCase\Interface\GetProductBySlugInterface;
use App\Infrastructure\Repository\CategoryRepository;
use App\Infrastructure\Repository\ProductRepository;
use App\Presentation\Response\ProductListItem;
use phpDocumentor\Reflection\Types\AbstractList;
use Symfony\Component\Serializer\SerializerInterface;
use function example\retrieveRelated;

final class GetProductBySlug implements GetProductBySlugInterface
{
    // @TODO refactor

    public function __construct(
        private readonly ProductRepository $productRepository,
        private readonly SerializerInterface $serializer
    ) {}

    /**
     * @throws \Exception
     */
    public function execute(string $slug): ProductListItem
    {
        $product = $this->productRepository->findOneBy(['slug' => $slug]);

        if ($product === null) {
            throw new \Exception('Product not found');
        }

        $serializedProduct = $this->serializer->serialize($product, 'json', ['groups' => ['product']]);

        $serializedProduct = json_decode($serializedProduct);

        return (new ProductListItem())
            ->setName($serializedProduct->name)
            ->setStatus($serializedProduct->status)
            ->setWidth($serializedProduct->width)
            ->setDescription($serializedProduct->description)
            ->setId($serializedProduct->id)
            ->setSlug($serializedProduct->slug)
            ->setBestseller($serializedProduct->bestseller)
            ->setDelivery($serializedProduct->delivery)
            ->setPrice($serializedProduct->price)
            ->setCount($serializedProduct->count)
            ->setCategory($serializedProduct->category)
            ->setDepth($serializedProduct->depth)
            ->setHeight($serializedProduct->height)
            ->setImages(array_map(fn ($attachment) => ($attachment->image), $serializedProduct->attachments))
            ->setDiscountPrice($serializedProduct->discountPrice);
    }
}