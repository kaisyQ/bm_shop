<?php

namespace App\Application\Service;

use App\Presenstation\Response\CategoryListItem;
use App\Presenstation\Response\CategoryListResponse;
use App\Infrastructure\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;

final class CategoryService
{
    public function __construct(
        private CategoryRepository $categoryRepository,
        private SerializerInterface $serializer,
        private EntityManagerInterface $em
    ) {}

    public function getCategories()
    {
        $categories = $this->categoryRepository->findAll();

        $serializedProducts = $this->serializer->serialize($categories, 'json', ['groups' => ['category']]);


        // return $serializedProducts;
        return new CategoryListResponse(
            array_map(
                fn ($category) => new CategoryListItem($category->id, $category->name, $category->slug),
                json_decode($serializedProducts)
            )
        );
    }

    public function deleteById (int $id) 
    {
        $category = $this->categoryRepository->find($id);

        if ($category === null) {
            throw new \Exception('Category doesnt found');
        }

        $this->em->remove($category);

        $this->em->flush();
    }
}
