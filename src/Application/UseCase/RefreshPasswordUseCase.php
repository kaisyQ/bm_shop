<?php declare(strict_types=1);

namespace App\Application\UseCase;

use App\Application\Model\EmailDataModel;
use App\Application\UseCase\Interface\RefreshPasswordUseCaseInterface;
use App\Application\UseCase\Interface\SendEmailUseCaseInterface;
use App\Application\Utils\PasswordGenerator;
use App\Infrastructure\Repository\CodeRepository;
use App\Infrastructure\Repository\CustomerRepository;
use Doctrine\ORM\EntityManagerInterface;

final class RefreshPasswordUseCase implements RefreshPasswordUseCaseInterface
{

    const TEMP_PASSWORD_LENGTH = 10;

    use PasswordGenerator;
    private CustomerRepository $customerRepository;
    private EntityManagerInterface $em;
    private CodeRepository $codeRepository;
    private SendEmailUseCaseInterface $sendEmailUseCase;

    public function __construct(
        CustomerRepository $customerRepository,
        CodeRepository $codeRepository,
        EntityManagerInterface $em,
        SendEmailUseCase $sendEmailUseCase
    ) {
        $this->customerRepository = $customerRepository;
        $this->codeRepository = $codeRepository;
        $this->em = $em;
        $this->sendEmailUseCase = $sendEmailUseCase;
    }

    /**
     * @throws \Exception
     */
    public function execute(string $email): void
    {
        $customer = $this->customerRepository->findOneBy(['email' => $email]);

        if ($customer === null) {
            throw new \Exception('Customer not found');
        }


        $password = substr(md5((string)rand()), 0, self::TEMP_PASSWORD_LENGTH);

        $customer->setPassword($this->generatePassword($password));

        $this->em->flush();

        $this->sendEmailUseCase->send(
            (new EmailDataModel())
                ->setTemplateType('refresh_password')
                ->setSubject('Bm furniture new password')
                ->setParams(['password' => $password])
                ->setEmail($customer->getEmail())
        );
    }
}