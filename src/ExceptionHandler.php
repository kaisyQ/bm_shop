<?php

namespace App;

use App\Constants\LogEnum;
use App\Exception\DatabaseException;
use App\Exception\ValidateException;
use App\Model\LogModel;
use App\Service\Logger\LoggerService;
use App\Service\Logger\LoggerServiceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

final class ExceptionHandler
{

    private readonly LoggerServiceInterface $loggerService;
    public function __construct(LoggerService $loggerService)
    {
        $this->loggerService = $loggerService;
    }

    /**
     * @throws ValidateException
     */
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        if ($exception instanceof DatabaseException)
        {
            $logModel = new LogModel($exception->getMessage(), LogEnum::ERROR->value);
            $this->loggerService->log($logModel);
        }

        $response = new JsonResponse([
            'error_message' => $exception->getMessage()
        ], Response::HTTP_INTERNAL_SERVER_ERROR);

        $event->setResponse($response);
    }
}