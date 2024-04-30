<?php

namespace App\Application\Utils;

trait MailTemplateInserter
{
    public function insertValuesToTemplate(string $template, array $params): string
    {
        $pattern = '/{{[ \t\n\r]*([a-zA-Z0-9_]+)[ \t\n\r]*}}/';

        return preg_replace_callback($pattern, function($matches) use ($params) {
            $key = $matches[1];
            return $params[$key] ?? '';
        }, $template);
    }
}