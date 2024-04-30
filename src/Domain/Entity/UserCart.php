<?php declare(strict_types=1);

namespace App\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Infrastructure\Repository\UserCartRepository;
use http\Env\Response;

#[ORM\Entity(repositoryClass: UserCartRepository::class)]
final class UserCart
{
    #[ORM\Column]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    private int $id;

    #[ORM\Column(type: 'integer')]
    private int $productId;

    #[ORM\Column(type: 'integer')]
    private int $userId;

    #[ORM\Column]
    private \DateTimeImmutable $createdAt;
    #[ORM\Column]
    private \DateTimeImmutable $updatedAt;

    public function __construct()
    {
        $date = new \DateTimeImmutable();
        $this->updatedAt = $date;
        $this->createdAt = $date;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function setProductId(int $productId): self
    {
        $this->productId = $productId;

        return $this;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public  function setUserId(int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $date): self
    {
        $this->updatedAt = $date;
        return $this;
    }
}