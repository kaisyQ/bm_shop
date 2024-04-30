<?php declare(strict_types=1);

namespace App\Application\UseCase;

use App\Application\UseCase\Interface\ConfirmRegistrationUseCaseInterface;
use App\Domain\Entity\Customer;
use App\Infrastructure\Repository\CodeRepository;
use App\Infrastructure\Repository\CustomerRepository;
use App\Presentation\Request\ConfirmRegisterRequest;
use Doctrine\ORM\EntityManagerInterface;

final class ConfirmRegistrationUseCase implements ConfirmRegistrationUseCaseInterface
{
    private EntityManagerInterface $em;
    private CustomerRepository $customerRepository;
    private CodeRepository $codeRepository;
    public function __construct(
        EntityManagerInterface $em,
        CustomerRepository $customerRepository,
        CodeRepository $codeRepository
    ) {
        $this->em = $em;
        $this->customerRepository = $customerRepository;
        $this->codeRepository = $codeRepository;
    }

    /**
     * @throws \Exception
     */
    public function execute(ConfirmRegisterRequest $data): array
    {
        $customer = $this->customerRepository->findOneBy([
            'name' => $data->username,
            'email' => $data->email,
            'password' => (hash_hmac('sha256', $data->password, 'bababa'))
        ]);

        if ($customer === null) {
            throw new \Exception('Customer not found');
        }

        $code = $this->codeRepository->findActualByCustomerIdAndCode($customer->getId(), strtolower($data->code));

        if ($code === null) {
            throw new \Exception('There is no valid code for this customer');
        }

        $code->setDeletedAt(new \DateTimeImmutable());
        $customer->setPending(false);

        $this->em->flush();


        return [
            'id' => $customer->getId(),
            'name' => $customer->getName(),
            'email' => $customer->getEmail(),
        ];
    }
}