<?php

namespace App\Application\UseCase;

use App\Application\UseCase\Interface\LoginUseCaseInterface;
use App\Application\Utils\PasswordGenerator;
use App\Infrastructure\Repository\CustomerRepository;
use App\Presentation\Request\LoginRequest;

final class LoginUseCase implements LoginUseCaseInterface
{
    use PasswordGenerator;
    private CustomerRepository $customerRepository;
    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;

    }

    /**
     * @throws \Exception
     */
    public function execute(LoginRequest $data): array
    {
        $customer = $this->customerRepository->findOneBy([
            'email' => $data['email'],
            'password' => $this->generatePassword($data->password)
        ]);

        if ($customer === null) {
            throw new \Exception('Customer not found');
        }

        return [
            'id' => $customer->getId(),
            'name' => $customer->getName(),
            'email' => $customer->getEmail()
        ];
    }
}