<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\String\Slugger\SluggerInterface;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['category'])]

    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(["product", 'category'])]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Groups(['category'])]
    private ?string $slug = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Product::class)]
    #[Groups(['temp'])]
    private Collection $products;

    /**
	 * @param  $id 
	 * @return self
	 */
	public function setId(?int $id): self {
		$this->id = $id;
		return $this;
	}
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

	/**
	 * @return Collection
	 */
	public function getProducts(): Collection {
		return $this->products;
	}
	
	/**
	 * @param Collection $products 
	 * @return self
	 */
	public function setProducts(Collection $products): self {
		$this->products = $products;
		return $this;
	}

    public function computeSlug (SluggerInterface $sluggerInterface) {
        if (!$this->slug || '-' === $this->slug) {
            $this->slug = $sluggerInterface->slug($this->name)->lower();
        }
    }

    public function __toString(): string {
        return $this->name;
    }


}
