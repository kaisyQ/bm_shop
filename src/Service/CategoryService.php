<?php

namespace App\Service;

use App\Dto\CategoryListItem;
use App\Dto\CategoryListResponse;
use App\Repository\CategoryRepository;
use Symfony\Component\Serializer\SerializerInterface;

class CategoryService
{
    public function __construct(
        private CategoryRepository $categoryRepository,
        private SerializerInterface $serializer,
    ) {
    }
    public function getCategories()
    {
        $categories = $this->categoryRepository->findAll();

        $serializedProducts = $this->serializer->serialize($categories, 'json', ['groups' => ['category']]);

        return new CategoryListResponse(
            array_map(
                fn ($category) => new CategoryListItem($category->id, $category->name, $category->slug),
                json_decode($serializedProducts)
            )
        );
    }
}
