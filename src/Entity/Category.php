<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\String\Slugger\SluggerInterface;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Product::class)]
    private Collection $products;

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
