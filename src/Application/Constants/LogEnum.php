<?php

declare(strict_types=1);

namespace App\Application\Constants;

enum LogEnum: string
{
    case ERROR = 'error';
    case ALERT = 'alert';
    case NOTICE = 'notice';
    case WARNING = 'warning';
    case INFO = 'info';
}
