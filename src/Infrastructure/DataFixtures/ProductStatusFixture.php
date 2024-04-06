<?php

namespace App\Infrastructure\DataFixtures;

use App\Domain\Entity\ProductStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductStatusFixture extends Fixture
{

    private function getData(): array
    {
        return [
            [
                'id' => 1,
                'name' => 'available'
            ],
            [
                'id' => 2,
                'name' => 'pending'
            ],
            [
                'id' => 3,
                'name' => 'sold_out'
            ]
        ];
    }
    public function load(ObjectManager $manager): void
    {
        foreach ($this->getData() as $data) {
            $productStatus = new ProductStatus();
            $productStatus
                ->setId($data['id'])
                ->setName($data['name'])
            ;
            $manager->persist($productStatus);
        }

        $manager->flush();
    }
}