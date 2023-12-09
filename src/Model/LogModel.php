<?php

namespace App\Model;

use App\Constants\LogEnum;
use App\Exception\ValidateException;

class LogModel
{
    private string $message;

    private string $logType;

    /**
     * @throws ValidateException
     */
    public function __construct (string $message, string $logType)
    {
        $this->validateLogType($logType);

        $this->logType = $logType;
        $this->message = $message;
    }
    public function getLogType(): string
    {
        return $this->logType;
    }

    /**
     * @throws ValidateException
     */
    public function setLogType(string $logType): self
    {
        $this->validateLogType($logType);
        $this->logType = $logType;

        return $this;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @throws ValidateException
     */
    private function validateLogType (string $logType): void
    {
        LogEnum::tryFrom($logType) ?? throw new ValidateException('log with this type doesnt exist');
    }

}