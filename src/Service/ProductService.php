<?php

namespace App\Service;

use App\Dto\ProductListResponse;
use App\Repository\ProductRepository;
use App\Dto\ProductListItem;
use App\Repository\CategoryRepository;
use App\Serializer\Normalizer\ProductNormalizer;
use App\Utils\Pager;
use Symfony\Component\Serializer\SerializerInterface;

class ProductService
{

    use Pager;
    public function __construct(
        private ProductRepository $productRepository,
        private CategoryRepository $categoryRepository,
        private SerializerInterface $serializer,
        private ProductNormalizer $productNormalizer,
    ) {
    }
    public function getProducts(?string $categorySlug, ?bool $bestseller, ?int $queryPage, ?int $queryLimit): ProductListResponse
    {

        if ($bestseller) {
            $products = $this->productRepository->findBy(['bestseller' => true]);
            $serializedProducts = $this->serializer->serialize($products, 'json', ['groups' => ['product']]);
            return new ProductListResponse(
                array_map(
                    fn ($product) => $this->productNormalizer->denormalize($product, ProductListItem::class),
                    json_decode($serializedProducts)
                )
            );
        }

        $limit = $this->getLimit($queryLimit);
        $page = $this->getPage($queryPage);
        $offset = $this->getOffset($page, $limit);

        
        $category = $this->categoryRepository->findOneBy(['slug' => $categorySlug]);
        $products = $this->productRepository->paginateProducts($limit, $offset, $category);
        $serializedProducts = $this->serializer->serialize($products, 'json', ['groups' => ['product']]);

        return new ProductListResponse(
            array_map(
                fn ($product) => $this->productNormalizer->denormalize($product, ProductListItem::class),
                json_decode($serializedProducts)
            )
        );
    }

    public function getProductBySlug(string $slug): ProductListItem
    {

        $product = $this->productRepository->findOneBy(['slug' => $slug]);

        $serializeProduct = $this->serializer->serialize($product, 'json', ['groups' => ['product']]);

        return $this->productNormalizer->denormalize(json_decode($serializeProduct), ProductListItem::class);
    }
}
