<?php declare(strict_types=1);

namespace App\Presentation\Request;

final class SellCouchRequest {
    private string $name;
    private string $email;
    private string $phone;
    private string $message;
    private string $brand;

	public function __construct(string $name, string $email, string $phone, string $message, string $brand) {
		$this->name = $name;
		$this->email = $email;
		$this->phone = $phone;
		$this->message = $message;
		$this->brand = $brand;
	}
	public function getName(): string {
		return $this->name;
	}

    public function setName(string $name): self {
		$this->name = $name;
		return $this;
	}
	public function getEmail(): string {
		return $this->email;
	}
	
	public function setEmail(string $email): self {
		$this->email = $email;
		return $this;
	}
	
	public function getPhone(): string {
		return $this->phone;
	}
	
	public function setPhone(string $phone): self {
		$this->phone = $phone;
		return $this;
	}
	
	public function getMessage(): string {
		return $this->message;
	}
	
	public function setMessage(string $message): self {
		$this->message = $message;
		return $this;
	}
	
	public function getBrand(): string {
		return $this->brand;
	}
	
	public function setBrand(string $brand): self {
		$this->brand = $brand;
		return $this;
	}
}