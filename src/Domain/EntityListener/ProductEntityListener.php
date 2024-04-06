<?php declare(strict_types=1);

namespace App\Domain\EntityListener;

use App\Domain\Entity\Product;
use Symfony\Component\String\Slugger\SluggerInterface;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Events;

#[AsEntityListener(event: Events::prePersist, entity: Product::class)]
#[AsEntityListener(event: Events::preUpdate, entity: Product::class)]
class ProductEntityListener {
    public function __construct(
        private readonly SluggerInterface $slugger,
    ) {}

    // @TODO Поменять с deprecated на актуальные типы 
    public function prePersist(Product $category, \Doctrine\ORM\Event\LifecycleEventArgs $lifecycleEventArgs): void
    {
        $category->computeSlug($this->slugger);
    }

    public function preUpdate(Product $category, \Doctrine\ORM\Event\LifecycleEventArgs $lifecycleEventArgs): void
    {
        $category->computeSlug($this->slugger);
    }
}