<?php

namespace App\Domain\EntityListener;

use App\Domain\Entity\Category;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Events;

#[AsEntityListener(event: Events::prePersist, entity: Category::class)]
#[AsEntityListener(event: Events::preUpdate, entity: Category::class)]
class CategoryEntityListener
{

    public function __construct(
        private readonly SluggerInterface $slugger,
    ) {}

    public function prePersist(Category $category, LifecycleEventArgs $lifecycleEventArgs): void
    {
        $category->computeSlug($this->slugger);
    }

    public function preUpdate(Category $category, LifecycleEventArgs $lifecycleEventArgs): void
    {
        $category->computeSlug($this->slugger);
    }
}
