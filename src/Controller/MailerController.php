<?php

namespace App\Controller;

use App\Dto\ContactUsRequest;
use App\Dto\SellCouchRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: "/api/v1/mailer", name: "mailer_controller")]
class MailerController extends AbstractController
{
    public function __construct()
    {
    }


    #[Route(path: "/contact_us", name: "contact_us", methods: ['POST'])]
    public function contact(#[MapRequestPayload] ContactUsRequest $request)
    {
    }



    #[Route(path: "/sell_couch", name: "sell_couch", methods: ["POST"])]
    public function sell(#[MapRequestPayload] SellCouchRequest $request)
    {
    }
}
