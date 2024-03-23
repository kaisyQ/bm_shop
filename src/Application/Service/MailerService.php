<?php


namespace App\Application\Service;

use App\Presenstation\Dto\ContactUsRequest;
use App\Presenstation\Dto\SellCouchRequest;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;


final class MailerService
{
    public function __construct(
        private readonly EmailCreator $emailCreator,
        private readonly MailHistoryService $mailHistoryService
    ){}

    public function sendContactMessage(ContactUsRequest $request): void
    {
        $transport = Transport::fromDsn("smtp://bmshopcanada@gmail.com:njdnpalbdtzfveah@smtp.gmail.com:587");

        $mailer = new Mailer($transport);

        $email = $this->emailCreator->create($request->getMessage());

        $email->html('
            <body>
                <div class="container">
                    <h3 class="alert alert-primary d-flex justify-content-center">A message from user!</h3>
                    <p class="alert alert-primary"><strong>User phonenumber:</strong> '. $request->getPhone() . '</p>
                    <p class="alert alert-primary"><strong>User email:</strong> ' . $request->getEmail() . ' </p>
                    <p class="alert alert-primary"><strong>User message:</strong> ' . $request->getMessage() . ' </p>
                </div>
            </body>
            '
        );


        try {

            $mailer->send($email);

            $this->mailHistoryService->write(
                $request->getMessage(),
                $request->getName(),
                $request->getPhone(),
                $request->getEmail(),
                1
            );

        } catch (\Throwable $e) {
            /**
             * @TODO
             * Здесь должно быть логирование ошибки отправки письма
             */
        }
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function sendSellCouchMessage (array $files, SellCouchRequest $request): void
    {
        $transport = Transport::fromDsn("smtp://bmshopcanada@gmail.com:njdnpalbdtzfveah@smtp.gmail.com:587");
        $mailer = new Mailer($transport);
        $email = $this->emailCreator->create($request->getMessage())
            ->html('
                <body>
                    <div class="container">
                        <h3 class="alert alert-primary d-flex justify-content-center">A message from user!</h3>
                        <p class="alert alert-primary"><strong>User phonenumber:</strong> '. $request->getPhone() . '</p>
                        <p class="alert alert-primary"><strong>User email:</strong> ' . $request->getEmail() . ' </p>
                        <p class="alert alert-primary"><strong>Brand of sofa:</strong> ' . $request->getBrand() . ' </p>
                        <p class="alert alert-primary"><strong>User message:</strong> ' . $request->getMessage() . ' </p>
                    </div>
                </body>
            '
        );
        
        foreach($files as $file) {
            $email->attachFromPath($file->getPathname(), $file->getClientOriginalName());
        }
            
        $mailer->send($email);
    }
}
