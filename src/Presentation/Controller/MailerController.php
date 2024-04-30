<?php

declare(strict_types=1);

namespace App\Presentation\Controller;

use App\Presentation\Request\ContactUsRequest;
use App\Presenstation\Request\SellCouchRequest;
use App\Application\Service\MailerService;
use App\Presentation\Docs\MailerControllerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

#[Route(path: "/api/v1/mailer", name: "mailer_controller")]
final class MailerController extends AbstractController implements MailerControllerInterface
{
    public function __construct(private readonly MailerService $mailerService)
    {
    }


    #[Route(path: "/contact_us", name: "contact_us", methods: ['POST'])]
    public function contact(#[MapRequestPayload] ContactUsRequest $request): JsonResponse
    {
        $this->mailerService->sendContactMessage($request);
        return $this->json(['send' => true]);
    }

    #[Route(path: "/sell_couch", name: "sell_couch", methods: ["POST"])]
    public function sell(Request $request): JsonResponse
    {

        $body = json_decode($request->request->get('body'));

        $this->mailerService->sendSellCouchMessage(
            $request->files->get("uploaded_images"),
            new SellCouchRequest($body->name, $body->email, $body->phone, $body->message, $body->brand)
        );

        return $this->json(['send' => true]);
    }
}
