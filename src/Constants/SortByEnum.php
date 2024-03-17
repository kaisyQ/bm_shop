<?php
declare(strict_types=1);
namespace App\Constants;

enum SortByEnum: string
{
    case NEWEST = 'newest';
    case OLDEST = 'oldest';
    case ALPHABETICALLY = 'alphabetically';
    case REVERSE_ALPHABETICALLY = 'reverse_alphabetically';
    case LOW_TO_HIGH_PRICE = 'low_to_high_price';
    case HIGH_TO_LOW_PRICE = 'high_to_low_price';
}
