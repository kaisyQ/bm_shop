<?php declare(strict_types=1);

namespace App\Application\UseCase;

use App\Application\Model\EmailDataModel;
use App\Application\UseCase\Interface\SendEmailUseCaseInterface;
use App\Domain\Entity\Customer;
use App\Domain\Entity\User;
use App\Infrastructure\Repository\CustomerRepository;
use App\Infrastructure\Repository\UserRepository;
use App\Presentation\Request\RegisterRequest;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

final class RegisterUseCase
{
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


        $user = (new Customer())
            ->setDeletedAt(new \DateTimeImmutable())
            ->setName($data->username)
            ->setPassword(hash_hmac('sha256', $data->password, 'bababa'))
            ->setEmail($data->email)
            ->setPending(true);

        $this->em->persist($user);

        $this->em->flush();


        $emailData = (new EmailDataModel())
            ->setEmail($data->email)
            ->setTemplateType('confirm_registration')
            ->setSubject('Confirm Registration')
            ->setParams(['code' => '228']);


       $this->sendEmailUseCase->send($emailData);
    }
}