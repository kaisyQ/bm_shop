<?php


namespace App;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

final class ExceptionHandler
{

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        $response = new JsonResponse([
            'error_message' => $exception->getMessage()
        ], Response::HTTP_INTERNAL_SERVER_ERROR);

        $event->setResponse($response);
    }
}