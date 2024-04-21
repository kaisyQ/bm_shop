<?php declare(strict_types=1);

namespace App\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
final class MailTemplate
{

    #[ORM\Id]
    #[ORM\Column]
    #[ORM\GeneratedValue]
    private int $id;

    #[ORM\Column]
    private string $template;

    #[ORM\Column(type: 'string', length: 255)]
    private string $type;

    #[ORM\Column]
    private \DateTimeImmutable|null $deletedAt;

    public function __construct()
    {
        $this->deletedAt = null;
    }

    public function getTemplate(): string
    {
        return $this->template;
    }

    public function setTemplate(string $template): self
    {
        $this->template = $template;

        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }


    public function getDeletedAt(): ?\DateTimeImmutable
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(?\DateTimeImmutable $deletedAt = null): self
    {
        $this->deletedAt = $deletedAt;

        return  $this;
    }
    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

}