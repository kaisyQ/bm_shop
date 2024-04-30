<?php

namespace App\Application\UseCase\Interface;

use App\Application\Model\EmailDataModel;

interface SendEmailUseCaseInterface
{

    public function send(EmailDataModel $emailData);
}