<?php

namespace App\Controller;

use App\Dto\ContactUsRequest;
use App\Dto\SellCouchRequest;
use App\Service\MailerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Attributes as OA;
use Nelmio\ApiDocBundle\Annotation\Model;

#[Route(path: "/api/v1/mailer", name: "mailer_controller")]
class MailerController extends AbstractController
{
    public function __construct(private MailerService $mailerService)
    {
    }


    #[Route(path: "/contact_us", name: "contact_us", methods: ['POST'])]
    #[OA\RequestBody(
        content: new OA\JsonContent(
            ref: new Model(type: ContactUsRequest::class)
        )
    )]
    public function contact(#[MapRequestPayload] ContactUsRequest $request)
    {
        $this->mailerService->sendContactMessage($request);
        return $this->json(['send' => true]);
    }

    #[Route(path: "/sell_couch", name: "sell_couch", methods: ["POST"])]
    #[OA\RequestBody(
        content: new OA\JsonContent(
            ref: new Model(type: SellCouchRequest::class)
        )
    )]
    public function sell(#[MapRequestPayload] SellCouchRequest $request)
    {
        $this->mailerService->sendSellCouchMessage($request);
        return $this->json(['send' => true]);
    }
}
