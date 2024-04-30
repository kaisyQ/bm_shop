<?php declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Code;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Code>
 *
 * @method Code|null find($id, $lockMode = null, $lockVersion = null)
 * @method Code|null findOneBy(array $criteria, array $orderBy = null)
 * @method Code[]    findAll()
 * @method Code[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CodeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Code::class);
    }

    /**
     * @throws NonUniqueResultException
     */
    public function findActualByCustomerIdAndCode(int $customerId, string $code): ?Code
    {
        $qb = $this->createQueryBuilder('c')->select('c')
            ->where('c.code = :code')->setParameter('code', $code)
            ->andWhere('c.customerId = :customerId')->setParameter('customerId', $customerId)
            ->andWhere('c.expiresAt > current_timestamp()')
            ->andWhere('c.deletedAt is null');

        return $qb->getQuery()->getOneOrNullResult();
    }
}
