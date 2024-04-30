<?php

declare(strict_types=1);

namespace App\Application\Service;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;

final class EmailCreator
{
    public function create(string $message): TemplatedEmail
    {

        return (new TemplatedEmail())
            ->from('bmshopcanada@gmail.com')
            ->to('BM.unique.furniture.finds@gmail.com')
            ->subject('A message from sell couch form!')
            ->text($message);
    }

}