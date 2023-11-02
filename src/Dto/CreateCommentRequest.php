<?php


namespace App\Dto;
class CreateCommentRequest
{

    private string $username;
    private string $text;
    private int $stars;
    public function __construct(string $username, string $text, int $stars)
    {
        $this->username = $username;
        $this->text = $text;
        $this->stars = $stars;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return int
     */
    public function getStars(): int
    {
        return $this->stars;
    }

    /**
     * @param string $username 
     * @return self
     */
    public function setUsername(string $username): self
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @param string $text 
     * @return self
     */
    public function setText(string $text): self
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @param int $stars 
     * @return self
     */
    public function setStars(int $stars): self
    {
        $this->stars = $stars;
        return $this;
    }
}
