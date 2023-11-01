<?php


namespace App\Service;

use App\Dto\ContactUsRequest;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;
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
            ->to('nafan9roma8@gmail.com')
            ->subject('A message from contact form!')
            ->text($request->getMessage())
            ->html('
                <head>
                    <meta charset="UTF-8">
                    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
                </head>
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
}
