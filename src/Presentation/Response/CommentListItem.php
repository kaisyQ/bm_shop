<?php declare(strict_types=1);

namespace App\Presentation\Response;

use DateTimeImmutable;

final class CommentListItem {
    private int $id;
    private string $username;
    private string $text;
    private int $stars;
    private DateTimeImmutable $createdAt;

    public function __construct(int $id, string $username, string $text, int $stars, DateTimeImmutable $createdAt) {
        $this->id = $id;
        $this->username = $username;
        $this->text = $text;
        $this->stars = $stars;
        $this->createdAt = $createdAt;
    }

	/**
	 * @return DateTimeImmutable
	 */
	public function getCreatedAt(): DateTimeImmutable {
		return $this->createdAt;
	}
	
	/**
	 * @param DateTimeImmutable $createdAt 
	 * @return self
	 */
	public function setCreatedAt(DateTimeImmutable $createdAt): self {
		$this->createdAt = $createdAt;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getStars(): int {
		return $this->stars;
	}
	
	/**
	 * @param int $stars 
	 * @return self
	 */
	public function setStars(int $stars): self {
		$this->stars = $stars;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getText(): string {
		return $this->text;
	}
	
	/**
	 * @param string $text 
	 * @return self
	 */
	public function setText(string $text): self {
		$this->text = $text;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getUsername(): string {
		return $this->username;
	}
	
	/**
	 * @param string $username 
	 * @return self
	 */
	public function setUsername(string $username): self {
		$this->username = $username;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getId(): int {
		return $this->id;
	}
	
	/**
	 * @param int $id 
	 * @return self
	 */
	public function setId(int $id): self {
		$this->id = $id;
		return $this;
	}
}