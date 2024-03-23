<?php declare(strict_types=1);

namespace App\Presenstation\Request;

final class UpdateCommentRequest
{
    private ?string $username = null;
    private ?string $text = null;
    private ?int $stars = null;

    public function __construct(?string $username = null, ?string $text = null, ?int $stars = null)
    {
        $this->username = $username;
        $this->text = $text;
        $this->stars = $stars;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param string|null $username
     * @return self
     */
    public function setUsername(?string $username): self
    {
        $this->username = $username;
        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * @param string|null $text
     * @return self
     */
    public function setText(?string $text): self
    {
        $this->text = $text;
        return $this;
    }

    public function getStars(): ?int
    {
        return $this->stars;
    }

    /**
     * @param int|null $stars
     * @return self
     */
    public function setStars(?int $stars): self
    {
        $this->stars = $stars;
        return $this;
    }
}
