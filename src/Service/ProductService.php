<?php

namespace App\Service;

use App\Dto\ProductListResponse;
use App\Repository\ProductRepository;
use App\Dto\ProductListItem;
use App\Repository\CategoryRepository;
use App\Serializer\Normalizer\ProductNormalizer;
use App\Utils\Pager;
use Symfony\Component\Serializer\SerializerInterface;

final class ProductService
{

    use Pager;
    public function __construct(
        private readonly ProductRepository $productRepository,
        private readonly CategoryRepository $categoryRepository,
        private readonly SerializerInterface $serializer,
        private readonly ProductNormalizer $productNormalizer,
    ) {}
    public function getProducts(
        ?string $categorySlug,
        ?int $queryPage,
        ?int $queryLimit,
        ?int $priceFrom,
        ?int $priceTo,
        ?bool $alphabetAtoZ,
        ?bool $alphabetZtoA,
        ?bool $oldest,
        ?bool $newest,
    ): ProductListResponse
    {

        $limit = $this->getLimit($queryLimit);
        $page = $this->getPage($queryPage);
        $offset = $this->getOffset($page, $limit);


        $category = $this->categoryRepository->findOneBy(['slug' => $categorySlug]);
        $products = $this->productRepository->paginateProducts(
            $limit,
            $offset,
            $category,
            $priceFrom,
            $priceTo,
            $alphabetAtoZ,
            $alphabetZtoA,
            $oldest,
            $newest
        );
        $total = $this->productRepository->getTotalProductsCount($category, $priceFrom, $priceTo);
        $serializedProducts = $this->serializer->serialize($products, 'json', ['groups' => ['product']]);

        return new ProductListResponse(
            array_map(
            /**
             * @throws \Exception
             */
            fn ($product) => $this->productNormalizer->denormalize($product, ProductListItem::class),
                json_decode($serializedProducts)
            ),
            $total
        );
    }

    /**
     * @throws \Exception
     */
    public function getProductBySlug(string $slug): ProductListItem
    {

        $product = $this->productRepository->findOneBy(['slug' => $slug]);


        //new code

        $serializeProduct = $this->serializer->serialize($product, 'json', ['groups' => ['product']]);
        /*

        $products = $this->productRepository->findAll();

        $serializedProducts = $this->serializer->serialize($products, 'json', ['groups' => ['product']]);


        $normProducts = array_map(
            fn ($product) => $this->productNormalizer->denormalize($product, ProductListItem::class),
            json_decode($serializedProducts)
        );

        $data = array_map(
            fn ($product) =>
            [
                $product->getPrice(),
                //'discountPrice' => $product->getDiscountPrice() ?? null,
                //'category' => $product->getCategory() ?? null,
                $product->getWidth(),
                $product->getHeight(),
                $product->getDepth(),
            ],
            $normProducts
        );

        $samples = [[1, 1], [8, 7], [1, 2], [7, 8], [2, 1], [8, 9]];

        //dd($data);
        $kmeans = new KMeans(4);

        //dd($kmeans);

        $clusters = $kmeans->cluster($data);

        //$clusters = $kmeans->cluster($samples);
        $kmeans->predict([

        ]);

        dd($clusters);

        */
        //

        return $this->productNormalizer->denormalize(json_decode($serializeProduct), ProductListItem::class);
    }
}
