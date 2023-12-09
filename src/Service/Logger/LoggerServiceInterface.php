<?php

namespace App\Service\Logger;

use App\Model\LogModel;

interface LoggerServiceInterface
{
    public function log(LogModel $logModel): void;
}