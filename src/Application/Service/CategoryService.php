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

    public function getCategories(): Maybe\Maybe
    {
        return Maybe\nothing();
        try {

            $categories = $this->categoryRepository->findAll();

            if (count($categories) === 0) {
                return Maybe\nothing();
            }

            $categories = json_decode($this->serializer->serialize($categories, 'json', ['groups' => ['category']]));

            $categories = array_map(fn ($category) => (AutoMapper::create())->map($category, CategoryModel::class), $categories);

            return Maybe\just($categories);

        } catch (\Throwable $e) {
            return Maybe\nothing();
        }
    }

    public function deleteById (int $id) 
    {
        try {

            $category = $this->categoryRepository->find($id);

            if ($category === null) {
                return Maybe\nothing();
            }

            $this->em->remove($category);

            $this->em->flush();

            return Maybe\just([]);

        } catch (\Throwable $e) {
            return Maybe\nothing();
        }
    }
}
