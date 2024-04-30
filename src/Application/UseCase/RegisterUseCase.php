<?php declare(strict_types=1);

namespace App\Application\UseCase;

use App\Application\Model\EmailDataModel;
use App\Application\UseCase\Interface\SendEmailUseCaseInterface;
use App\Application\Utils\CodeGenerator;
use App\Application\Utils\PasswordGenerator;
use App\Domain\Entity\Code;
use App\Domain\Entity\Customer;
use App\Infrastructure\Repository\CustomerRepository;
use App\Presentation\Request\RegisterRequest;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

final class RegisterUseCase
{
    use CodeGenerator;
    use PasswordGenerator;
    private SendEmailUseCaseInterface $sendEmailUseCase;
    private CustomerRepository $customerRepository;
    private EntityManagerInterface $em;

    public function __construct(
        SendEmailUseCase $sendEmailUseCase,
        CustomerRepository $customerRepository,
        EntityManagerInterface $em

    ){
        $this->sendEmailUseCase  = $sendEmailUseCase;
        $this->customerRepository = $customerRepository;
        $this->em = $em;
    }

    /**
     * @throws \Exception
     * @throws TransportExceptionInterface
     */
    public function execute(RegisterRequest $data): void
    {
        $user = $this->customerRepository->findOneBy(['email' => $data->email]);

        if ($user) {
            throw new \Exception('Error! User already exists.');
        }

        $now = new \DateTimeImmutable();

        $customer = (new Customer())
            ->setDeletedAt(new \DateTimeImmutable())
            ->setName($data->username)
            ->setPassword($this->generatePassword($data->password))
            ->setEmail($data->email)
            ->setPending(true);

        $this->em->persist($customer);

        $code = (new Code())
            ->setCustomerId($customer->getId())
            ->setCode(strtolower($this->generateCode()))
            ->setExpiresAt($now->add(new \DateInterval('PT1H')));


        $this->em->persist($code);

        $this->em->flush();

        $emailData = (new EmailDataModel())
            ->setEmail($data->email)
            ->setTemplateType('confirm_registration')
            ->setSubject('Confirm Registration')
            ->setParams(['code' => $code->getCode()]);


       $this->sendEmailUseCase->send($emailData);
    }
}