<?php

namespace App\Infrastructure\Repository;

use App\Entity\MailType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MailType>
 *
 * @method MailType|null find($id, $lockMode = null, $lockVersion = null)
 * @method MailType|null findOneBy(array $criteria, array $orderBy = null)
 * @method MailType[]    findAll()
 * @method MailType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MailTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MailType::class);
    }

//    /**
//     * @return MailType[] Returns an array of MailType objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?MailType
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
