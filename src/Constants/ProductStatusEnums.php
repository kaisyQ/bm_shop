<?php

declare(strict_types=1);

namespace App\Constants;

enum ProductStatusEnums: string 
{
    case PENDING = 'pending';
    case SOLD = 'sold';
    case SALE = 'sale';
}