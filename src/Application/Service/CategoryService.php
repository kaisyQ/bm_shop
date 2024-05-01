<?php declare(strict_types=1);

namespace App\Application\Service;

use App\Application\Model\CategoryModel;
use App\Infrastructure\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Widmogrod\Monad\Maybe;
use AutoMapper\AutoMapper;

final class CategoryService
{
    public function __construct(
        private CategoryRepository $categoryRepository,
        private SerializerInterface $serializer,
        private EntityManagerInterface $em
    ) {}

    /**
     * @throws \Exception
     */
    public function getCategories(): array
    {
        try {

            $categories = $this->categoryRepository->findAll();

            $categories = json_decode($this->serializer->serialize($categories, 'json', ['groups' => ['category']]));

            $categories = array_map(fn ($category) => (AutoMapper::create())->map($category, CategoryModel::class), $categories);

            return $categories;

        } catch (\Throwable $e) {
            // @TODO refactor
           throw new \Exception($e->getMessage());
        }
    }

    public function deleteById (int $id): void
    {
        try {

            $category = $this->categoryRepository->find($id);

            $this->em->remove($category);

            $this->em->flush();

        } catch (\Throwable $e) {

            // @TODO refactor
        }
    }
}
