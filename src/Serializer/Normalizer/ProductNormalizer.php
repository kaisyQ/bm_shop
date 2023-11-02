<?php

namespace App\Serializer\Normalizer;

use App\Dto\ProductListItem;
use DateTimeImmutable;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;


class ProductNormalizer implements DenormalizerInterface
{
    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): ProductListItem
    {

        $product = new ProductListItem();

        if (isset($data->id))
            $product->setId($data->id);

        if (isset($data->name))
            $product->setName($data->name);

        if (isset($data->description))
            $product->setDescription($data->description);

        if (isset($data->count))
            $product->setCount($data->count);

        if (isset($data->price))
            $product->setPrice($data->price);

        if (isset($data->discountPrice))
            $product->setDiscountPrice($data->discountPrice);

        if (isset($data->delivery))
            $product->setDelivery($data->delivery);

        if (isset($data->bestseller))
            $product->setBestseller($data->bestseller);

        if (isset($data->createdAt))
            $product->setCreatedAt(new DateTimeImmutable($data->createdAt));

        if (isset($data->category))
            $product->setCategory($data->category->name);

        if (isset($data->slug))
            $product->setSlug($data->slug);

        if (isset($data->width))
            $product->setWidth($data->width);
        
        if (isset($data->height))
            $product->setHeight($data->height);
        
        if (isset($data->depth))
            $product->setDepth($data->depth);

        if (isset($data->attachments))
            $product->setImages(array_map(fn ($attachment) => $attachment->image, $data->attachments));

        return $product;
    }

    public function supportsDenormalization(mixed $data, string $type, string $format = null): bool
    {
        return $data instanceof ProductListItem;
    }
}
