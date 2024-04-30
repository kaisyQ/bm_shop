<?php declare(strict_types=1);


namespace App\Presentation\Docs;

use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use App\Presentation\Request\ContactUsRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


interface MailerControllerInterface {

    /**
     * @OA\Post(
     *   tags={"Mails"},
     *   path="/api/v1/mailer/contact_us",
     *   summary="Send contact email",
     *   description="Send email to bmfurniture.ca default receiver",
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       @OA\Property(
     *         property="name", 
     *         type="string",
     *         example="Mikahail"
     *       ),
     *       @OA\Property(
     *         property="email",
     *         type="string",
     *         example="bmfurniture.ca@gmail.com",
     *       ),
     *       @OA\Property(
     *         property="phone",
     *         type="string",
     *         example="89243230101",
     *       ),
     *       @OA\Property(
     *         property="message",
     *         type="string",
     *         example="We want to buy your couch",
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response=200, 
     *     description="OK",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(
     *         property="send", 
     *         type="boolean",
     *         example="true"
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response=401, 
     *     description="Unauthorized"
     *   ),
     *   @OA\Response(
     *     response=404, 
     *     description="Not Found"
     *   )
     * )
     */
    public function contact(#[MapRequestPayload] ContactUsRequest $request): JsonResponse;



   /**
     * @OA\Post(
     *   tags={"Mails"},
     *   path="/api/v1/mailer/sell_couch",
     *   summary="Send sell couch mail",
     *   description="Send sell couch email to bmfurniture.ca default receiver",
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\MediaType (
     *       mediaType="multipart/form-data",
     *       @OA\Property(
     *         property="uploaded_images",
     *         type="array",
     *         @OA\Items(type="file")
     *       ),
     *       @OA\Property(
     *         property="body",
     *         type="object",
     *         @OA\Property(
     *           property="name", 
     *           type="string",
     *           example="Mikahail"
     *         ),
     *         @OA\Property(
     *           property="email",
     *           type="string",
     *           example="bmfurniture.ca@gmail.com",
     *         ),
     *         @OA\Property(
     *           property="phone",
     *           type="string",
     *           example="89243230101",
     *         ),
     *         @OA\Property(
     *           property="message",
     *           type="string",
     *           example="We want to buy your couch",
     *         )
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response=200, 
     *     description="OK",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(
     *         property="send", 
     *         type="boolean",
     *         example="true"
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response=401, 
     *     description="Unauthorized"
     *   ),
     *   @OA\Response(
     *     response=404, 
     *     description="Not Found"
     *   )
     * )
     */

   public function sell(Request $request): JsonResponse;
}
