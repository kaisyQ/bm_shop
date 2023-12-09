<?php

namespace App\Mapper;

use App\Entity\Log;
use App\Model\LogModel;

trait LogMapperTrait
{
    public function mapToEntity(LogModel $logModel) : Log
    {
        return (new Log())->setMessage($logModel->getMessage())->setLogType($logModel->getLogType());
    }
}