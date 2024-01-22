<?php

namespace App\Service;

use App\Entity\Mail;
use App\Repository\MailRepository;
use App\Repository\MailTypeRepository;
use Doctrine\ORM\EntityManagerInterface;

final class MailHistoryService
{
    public function __construct(
        private readonly MailRepository $mailRepository,
        private readonly MailTypeRepository $mailTypeRepository,
        private readonly EntityManagerInterface $em
    ){}

    /**
     * @param string $message
     * @param string $name
     * @param string $phoneNUmber
     * @param string $email
     * @param int $type
     * @param string|null $brand
     * @return void
     *
     * Method for creating mail history record
     */
    public function write(string $message, string $name, string $phoneNUmber, string $email, int $type, ?string $brand=null): void
    {

        $type = $this->mailTypeRepository->find($type);

        $mail = new Mail();
        $mail->setMessage($message);
        $mail->setName($name);
        $mail->setPhoneNumber($phoneNUmber);
        $mail->setEmail($email);
        $mail->setMailType($type);
        $mail->setBrand($brand);

        $this->em->persist($mail);
        $this->em->flush();

    }
}