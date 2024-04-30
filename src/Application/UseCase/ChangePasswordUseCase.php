<?php declare(strict_types=1);

namespace App\Application\UseCase;

use App\Application\UseCase\Interface\ChangePasswordUseCaseInterface;
use App\Application\Utils\PasswordGenerator;
use App\Infrastructure\Repository\CustomerRepository;
use App\Presentation\Request\ChangePasswordRequest;
use Doctrine\ORM\EntityManagerInterface;

final class ChangePasswordUseCase implements ChangePasswordUseCaseInterface
{

    use PasswordGenerator;
    private CustomerRepository $customerRepository;
    private EntityManagerInterface $em;
    public function __construct(CustomerRepository $customerRepository, EntityManagerInterface $em)
    {
        $this->customerRepository = $customerRepository;
        $this->em = $em;
    }

    /**
     * @throws \Exception
     */
    public function execute(ChangePasswordRequest $data): void
    {
        $customer = $this->customerRepository->findOneBy([
            'email' => $data->email,
            'password' => $this->generatePassword($data->oldPassword)
        ]);

        if ($customer === null) {
            throw new \Exception('Customer not found');
        }

        $customer->setPassword($this->generatePassword($data->newPassword));

        $this->em->flush();

    }
}