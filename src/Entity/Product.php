<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\String\Slugger\SluggerInterface;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["product", "search"])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(["product", "search"])]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups("product")]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups("product")]
    private ?string $delivery = null;

    #[ORM\Column]
    #[Groups("product")]
    private ?int $price = null;

    #[ORM\Column(nullable: true)]
    #[Groups("product")]
    private ?int $discountPrice = null;

    #[ORM\Column(nullable: true)]
    #[Groups("product")]
    private ?bool $bestseller = null;

    #[ORM\ManyToOne]
    #[Groups("product")]
    private ?Category $category = null;

    #[ORM\Column]
    #[Groups("product")]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column]
    #[Groups("product")]
    private ?int $count = null;

    #[ORM\OneToMany(targetEntity: Attachment::class, mappedBy: "product", cascade: ["persist", "remove"])]
    #[Groups(["product", "search"])]
    private Collection $attachments;

    #[ORM\Column(length: 255)]
    #[Groups(["product", "search"])]
    private ?string $slug = null;

    #[ORM\Column]
    #[Groups("product")]
    private ?int $width = null;

    #[ORM\Column]
    #[Groups("product")]
    private ?int $height = null;

    #[ORM\Column]
    #[Groups("product")]
    private ?int $depth = null;

    public function __construct()
    {
        $this->attachments = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
    }

    #[ORM\PreUpdate]
    public function setUpdatedAtValue()
    {
        $this->updatedAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDelivery(): ?string
    {
        return $this->delivery;
    }

    public function setDelivery(string $delivery): self
    {
        $this->delivery = $delivery;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDiscountPrice(): ?int
    {
        return $this->discountPrice;
    }

    public function setDiscountPrice(?int $discountPrice): self
    {
        $this->discountPrice = $discountPrice;

        return $this;
    }

    public function isBestseller(): ?bool
    {
        return $this->bestseller;
    }

    public function setBestseller(?bool $bestseller): self
    {
        $this->bestseller = $bestseller;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getCount(): ?int
    {
        return $this->count;
    }

    public function setCount(int $count): self
    {
        $this->count = $count;

        return $this;
    }

    /**
     * @return Collection|Attachment[]
     */
    public function getAttachments(): Collection
    {
        return $this->attachments;
    }

    public function addAttachment(Attachment $attachment): self
    {
        if (!$this->attachments->contains($attachment)) {
            $this->attachments[] = $attachment;
            $attachment->setProduct($this);
        }

        return $this;
    }

    public function removeAttachment(Attachment $attachment): self
    {
        if ($this->attachments->contains($attachment)) {
            $this->attachments->removeElement($attachment);
            // set the owning side to null (unless already changed)
            if ($attachment->getProduct() === $this) {
                $attachment->setProduct(null);
            }
        }

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function computeSlug(SluggerInterface $sluggerInterface)
    {
        if (!$this->slug || '-' === $this->slug) {
            $this->slug = $sluggerInterface->slug($this->name)->lower();
        }
    }

    public function getWidth(): ?int
    {
        return $this->width;
    }

    public function setWidth(int $width): self
    {
        $this->width = $width;

        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(int $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getDepth(): ?int
    {
        return $this->depth;
    }

    public function setDepth(int $depth): self
    {
        $this->depth = $depth;

        return $this;
    }
}
