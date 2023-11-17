<?php


namespace App\Service;

use App\Dto\ContactUsRequest;
use App\Dto\SellCouchRequest;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;


class MailerService
{
    public function __construct()
    {
    }

    public function sendContactMessage(ContactUsRequest $request)
    {
        $transport = Transport::fromDsn("smtp://bmshopcanada@gmail.com:njdnpalbdtzfveah@smtp.gmail.com:587");

        $mailer = new Mailer($transport);

        $email = (new TemplatedEmail())
            ->from('bmshopcanada@gmail.com')
            ->to('BM.unique.furniture.finds@gmail.com')
            ->subject('A message from contact form!')
            ->text($request->getMessage())
            ->html('
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

            
        $mailer->send($email);
    }

    public function sendSellCouchMessage (array $files, SellCouchRequest $request) {
        $transport = Transport::fromDsn("smtp://bmshopcanada@gmail.com:njdnpalbdtzfveah@smtp.gmail.com:587");
        $mailer = new Mailer($transport);
        $email = (new TemplatedEmail())
            ->from('bmshopcanada@gmail.com')
            ->to('BM.unique.furniture.finds@gmail.com')
            ->subject('A message from sell couch form!')
            ->text($request->getMessage())
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
