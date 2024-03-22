<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Category;
use App\Domain\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\AbstractQuery;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @extends ServiceEntityRepository<Product>
 *
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository implements ProductRepositoryInterface
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

    /**
     * @param int $limit
     * @param int $offset
     * @param Category|null $category
     * @param int|null $priceTo
     * @param int|null $priceFrom
     * @param bool|null $alphabetAtoZ
     * @param bool|null $alphabetZtoA
     * @param bool|null $oldest
     * @param bool|null $newest
     * @return Product[]
     */
    public function paginateProducts(
        int $limit,
        int $offset,
        ?Category $category=null,
        ?int $priceFrom=null,
        ?int $priceTo=null,
        ?bool $alphabetAtoZ=false,
        ?bool $alphabetZtoA=false,
        ?bool $oldest=false,
        ?bool $newest=false
    ): array
    {
        $qb = $this->createQueryBuilder('p')->select('p')
            ->setMaxResults($limit)->setFirstResult($offset);

        if (isset($category)) {
            $qb->where('p.category = :category')->setParameter('category', $category);
        }

        if (isset($priceFrom)) {
            $qb
                ->andWhere('COALESCE(p.discountPrice, p.price) >= :priceFrom')
                ->setParameter('priceFrom', $priceFrom);
        }

        if (isset($priceTo)) {
            $qb
                ->andWhere('COALESCE(p.discountPrice, p.price) <= :priceTo')
                ->setParameter('priceTo', $priceTo);
        }

        if ($alphabetAtoZ) {
            $qb->orderBy('p.name', 'ASC');
        }

        if ($alphabetZtoA) {
            $qb->orderBy('p.name', 'DESC');
        }

        if ($oldest) {
            $qb->addOrderBy('p.createdAt', 'DESC');
        }

        if ($newest) {
            $qb->addOrderBy('p.createdAt', 'ASC');
        }
        return $qb->getQuery()->getResult(AbstractQuery::HYDRATE_SIMPLEOBJECT);
    }

    public function getTotalProductsCount(?Category $category, ?int $priceFrom, ?int $priceTo): int
    {
        $qb = $this->createQueryBuilder('p')->select('COUNT(p)');

        if (isset($category)) {
            $qb->where('p.category = :category')->setParameter('category', $category);
        }

        return $qb->getQuery()->getResult(AbstractQuery::HYDRATE_SINGLE_SCALAR);
    }

    public function getByIds(array $ids) 
    {
        $qb = $this->createQueryBuilder('p')
            ->select('p')->where('id in :ids')->setParameter('name', '('. implode(',', $ids) . ')');

        return $qb->getQuery()->getResult(AbstractQuery::HYDRATE_SIMPLEOBJECT);
    }

}
