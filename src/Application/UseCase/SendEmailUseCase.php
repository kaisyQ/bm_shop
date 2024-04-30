<?php declare(strict_types=1);

namespace App\Application\UseCase;

use App\Application\Model\EmailDataModel;
use App\Application\UseCase\Interface\SendEmailUseCaseInterface;
use App\Application\Utils\MailTemplateInserter;
use App\Infrastructure\Repository\MailTemplateRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;

final class SendEmailUseCase implements SendEmailUseCaseInterface
{
    use MailTemplateInserter;
    private MailTemplateRepository $mailTemplateRepository;
    public function __construct(MailTemplateRepository $mailTemplateRepository)
    {
        $this->mailTemplateRepository = $mailTemplateRepository;
    }

    /**
     * @throws TransportExceptionInterface
     * @throws \Exception
     */
    public function send(EmailDataModel $emailData): void
    {

        $template = $this->mailTemplateRepository->findOneBy([
            'type' => $emailData->getTemplateType()
        ]);

        if ($template === null) {
            throw new \Exception('Error! Email template not found');
        }

        $transport = Transport::fromDsn("smtp://bmshopcanada@gmail.com:njdnpalbdtzfveah@smtp.gmail.com:587");

        $mailer = new Mailer($transport);

        $mail = (new TemplatedEmail())
            ->from('bmshopcanada@gmail.com')
            ->html($this->insertValuesToTemplate($template->getTemplate(), $emailData->getParams()))
            ->to('nafan9roma8@gmail.com')
            ->subject($emailData->getSubject());

        $mailer->send($mail);

    }
}