<?php declare(strict_types=1);

namespace App\Infrastructure\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Domain\Entity\Category;

class CategoryFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $categories = ['Couch', 'Sofa', 'Seater sofa'];

        foreach ($categories as $categoryName) {
            $category = (new Category())->setName($categoryName);
            $manager->persist($category);
        }

        $manager->flush();
    }
}
