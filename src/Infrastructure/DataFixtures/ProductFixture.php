<?php

namespace App\Infrastructure\DataFixtures;

use App\Application\Constants\Constants;
use App\Domain\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixture extends Fixture
{


    private function getData(): array
    {
        return [
            [
                'name' => 'couch2',
                'description' => 'Couch2',
                'delivery' => Constants::DELIVERY_MESSAGE,
                'price' => 100,
                'discountPrice' => 80,
                'count' => 1,
                'slug' => 'couch2',
                'width' => 150,
                'height' => 100,
                'depth' => 100,
                'status' => 1
            ],
            [
                'name' => 'couch1',
                'description' => 'Couch1',
                'delivery' => Constants::DELIVERY_MESSAGE,
                'price' => 100,
                'discountPrice' => 80,
                'count' => 1,
                'slug' => 'couch1',
                'width' => 150,
                'height' => 100,
                'depth' => 100,
                'status' => 1
            ]
        ];
    }


    public function load(ObjectManager $manager): void
    {
        foreach ($this->getData() as $data) {
            $product = new Product();

            $product
                ->setName($data['name'])
                ->setCount($data['count'])
                ->setDelivery($data['delivery'])
                ->setDescription($data['description'])
                ->setPrice($data['price'])
                ->setDiscountPrice($data['discountPrice'])
                ->setSlug($data['slug'])
                ->setWidth($data['width'])
                ->setHeight($data['height'])
                ->setDepth($data['depth']);

            $manager->persist($product);
        }

        $manager->flush();
    }
}