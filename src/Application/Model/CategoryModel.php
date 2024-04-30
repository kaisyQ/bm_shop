<?php declare(strict_types=1);

namespace App\Application\Model;

final class CategoryModel 
{
    private string $name;
    private string $slug;
    private int $id;

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): self {
        $this->name = $name;
        return $this;
    }


    public function getSlug(): string {
        return $this->slug;
    }

    public function setSlug(string $slug): self {
        $this->slug = $slug;
        return $this;
    }

    public function setId(int $id): self {
        $this->id = $id;
        return $this;
    }

    public function getId(): int {
        return $this->id;
    }

}