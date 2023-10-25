<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

#[ORM\Entity(repositoryClass: ImageRepository::class)]
#[Vich\Uploadable]
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private string $src;

    #[ORM\ManyToOne(inversedBy: 'images')]
    private ?Product $product = null;
    
    #[Vich\UploadableField(mapping:'attachments', fileNameProperty: 'src')]
    private ?File $imageFile;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;  


    public function __construct() {
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
    }
    
    #[ORM\PrePersist]
    public function setCreatedAtValue () {
        $this->createdAt = new \DateTimeImmutable();
    }

    #[ORM\PreUpdate]
    #[ORM\PrePersist]
    public function setUpdatedAtValue ()  {
        $this->updatedAt = new \DateTimeImmutable();     
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSrc(): string
    {
        return $this->src;
    }

    public function setSrc(string $src): static
    {
        $this->src = $src;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): static
    {
        $this->product = $product;

        return $this;
    }

    public function getImageFile() {
        return $this->imageFile;
    }
    public function setImageFile(?File $imageFile): self {
        
        $this->imageFile = $imageFile;
        
        if ($imageFile) {
            $this->updatedAt = new \DateTimeImmutable();
        }

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
