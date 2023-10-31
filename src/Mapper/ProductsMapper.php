<?php

namespace App\Mapper;


use App\Dto\ProductListItem;
use App\Dto\ProductListResponse;
use DateTimeImmutable;

class ProductsMapper
{

    public function map(array $products): ProductListResponse
    {
        return new ProductListResponse(
            array_map(
                fn ($product) => (new ProductListItem())
                    ->setId($product->id)
                    ->setName($product->name)
                    ->setCategory($product->category->name)
                    ->setDescription($product->description)
                    ->setDelivery($product->delivery)
                    ->setPrice($product->price)
                    ->setDiscountPrice($product->discountPrice)
                    ->setImages(array_map(
                        fn ($attachment) => $attachment->image,
                        $product->attachments
                    ))
                    ->setCreatedAt(new DateTimeImmutable($product->createdAt))
                    ->setBestseller($product->bestseller),
                
                $products
            ),
        );
    }
}
