<?php declare(strict_types=1);

namespace App\Application\UseCase;

use App\Application\UseCase\Interface\GetProductsUseCaseInterface;
use App\Application\Utils\Pager;
use App\Infrastructure\Repository\CategoryRepository;
use App\Infrastructure\Repository\ProductRepository;
use App\Presentation\Dto\GetProductsDto;
use App\Presentation\Response\ProductListItem;
use App\Presentation\Response\ProductListResponse;
use Symfony\Component\Serializer\SerializerInterface;


// @TODO refactor
final class GetProductsUseCase implements GetProductsUseCaseInterface
{
    use Pager;
    public function __construct(
        private readonly ProductRepository $productRepository,
        private readonly CategoryRepository $categoryRepository,
        private readonly SerializerInterface $serializer
    ) {}
    public function execute(GetProductsDto $data): ProductListResponse
    {
        $limit = $this->getLimit($data->limit);
        $page = $this->getPage($data->page);

        $offset = $this->getOffset($page, $limit);


        $category = $this->categoryRepository->findOneBy(['slug' => $data->category]);
        $products = $this->productRepository->paginateProducts(
            $limit,
            $offset,
            $category,
            $data->priceFrom,
            $data->priceTo,
            $data->alphabetAtoZ,
            $data->alphabetZtoA,
            $data->oldest,
            $data->newest
        );
        $total = $this->productRepository->getTotalProductsCount($category, $data->priceFrom, $data->priceTo);

        $serializedProducts = $this->serializer->serialize($products, 'json', ['groups' => ['product']]);

        return new ProductListResponse(
            array_map(
                fn ($product) =>
                (new ProductListItem())
                    ->setName($product->name)
                    ->setStatus($product->status)
                    ->setWidth($product->width)
                    ->setDescription($product->description)
                    ->setId($product->id)
                    ->setSlug($product->slug)
                    ->setBestseller($product->bestseller)
                    ->setDelivery($product->delivery)
                    ->setPrice($product->price)
                    ->setCount($product->count)
                    ->setCategory($product->category)
                    ->setDepth($product->depth)
                    ->setHeight($product->height)
                    ->setImages(array_map(fn ($attachment) => ($attachment->image), $product->attachments))
                    ->setDiscountPrice($product->discountPrice)
                , json_decode($serializedProducts)
            ),
            $total
        );
    }
}