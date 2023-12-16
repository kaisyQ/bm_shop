<?php

namespace App\Service\Logger;

use App\Model\LogModel;

interface LoggerServiceInterface
{
    /**
     * Method for writing logs into logs database
     */
    public function log(LogModel $logModel): void;
}