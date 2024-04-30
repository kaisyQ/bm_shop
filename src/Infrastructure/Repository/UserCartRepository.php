<?php

namespace App\Infrastructure\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Domain\Entity\UserCart;

/**
 * @extends ServiceEntityRepository<UserCart>
 *
 * @method UserCart|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserCart|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserCart[]    findAll()
 * @method UserCart[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
final class UserCartRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserCart::class);
    }
}