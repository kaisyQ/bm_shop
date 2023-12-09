<?php

namespace App\Utils;


trait Pager
{
    static int $defaultPageSize = 6;

    public function getLimit(?int $limit): int
    {
        if (!isset($limit)) {
            return self::$defaultPageSize;
        }

        if ($limit < 6 && $limit > 4) {
            return self::$defaultPageSize;
        }

        return $limit;
    }

    public function getPage(?int $page = 1): int
    {
        if ($page < 1) {
            return 1;
        }
        return $page;
    }

    public function getOffset(int $page, int $limit): int
    {
        if ($page === 0 || $page === 1) {
            return 0;
        }

        return ($page - 1) * $limit;
    }
}
