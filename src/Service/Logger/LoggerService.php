<?php

namespace App\Service\Logger;

use App\Mapper\LogMapperTrait;
use App\Model\LogModel;
use Doctrine\ORM\EntityManagerInterface;

final class LoggerService implements LoggerServiceInterface
{
    use LogMapperTrait;
    public function __construct(
        private readonly EntityManagerInterface $em
    ){}

    public function log(LogModel $logModel): void
    {
        $log = $this->mapToEntity($logModel);
        $this->em->persist($log);
        $this->em->flush();
    }
}