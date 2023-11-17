<?php

namespace App\Repository;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 *
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    /**
     * 
     * @return Product[] 
     */
    public function findByContainingName(string $name): array
    {
        return $this->createQueryBuilder('u')
            ->where('u.name LIKE :name')
            ->setParameter('name', '%' . $name . '%')
            ->getQuery()
            ->getResult();
    }

    public function paginateProducts(int $limit, int $offset, ?Category $category=null): array
    {
        $qb = $this->createQueryBuilder('p')->select('p')
            ->setMaxResults($limit)->setFirstResult($offset);

        if (isset($category)) {
            $qb->where('p.category = :category')->setParameter('category', $category);
        }

        return $qb->getQuery()->getResult(Query::HYDRATE_SIMPLEOBJECT);
    }

    public function getTotalProductsCount(?Category $category): int
    {
        $qb = $this->createQueryBuilder('p')->select('COUNT(p)');

        if (isset($category)) {
            $qb->where('p.category = :category')->setParameter('category', $category);
        }

        return $qb->getQuery()->getResult(Query::HYDRATE_SINGLE_SCALAR);
    }
}
