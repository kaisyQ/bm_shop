<?php
declare(strict_types=1);
namespace App\Presentation\Controller;

use App\Dto\ContactUsRequest;
use App\Dto\SellCouchRequest;
use App\Application\Service\MailerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Attributes as OA;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

#[Route(path: "/api/v1/mailer", name: "mailer_controller")]
final class MailerController extends AbstractController
{
    public function __construct(private readonly MailerService $mailerService)
    {
    }


    #[Route(path: "/contact_us", name: "contact_us", methods: ['POST'])]
    #[OA\RequestBody(
        content: new OA\JsonContent(
            ref: new Model(type: ContactUsRequest::class)
        )
    )]
    public function contact(#[MapRequestPayload] ContactUsRequest $request): JsonResponse
    {
        $this->mailerService->sendContactMessage($request);
        return $this->json(['send' => true]);
    }

    #[Route(path: "/sell_couch", name: "sell_couch", methods: ["POST"])]
    #[OA\RequestBody(
        content: [
            new OA\MediaType(
                mediaType: 'multipart/form-data',
                schema: new OA\Schema(properties: [
                    new OA\Property(
                        property: 'uploaded_images[]',
                        type: 'array',
                        items: new OA\Items(type: 'file')
                    ),
                    new OA\Property(
                        property: 'body',
                        ref: new Model(type: SellCouchRequest::class),
                        type: 'json',

                    )
                ])
            ),
        ]
    )]
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
