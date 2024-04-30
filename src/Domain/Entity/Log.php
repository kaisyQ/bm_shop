<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Infrastructure\Repository\LogRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LogRepository::class)]
final class Log
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]

    private string $message;

    #[ORM\Column(length: 255)]
    private string $logType;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId (?int $id): self
    {
        $this->id = $id;

        return  $this;
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

    public function getLogType(): string
    {
        return $this->logType;
    }

    public function setLogType(string $logType): self
    {
        $this->logType = $logType;
        return $this;
    }


}
