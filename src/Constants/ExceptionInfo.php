<?php
declare(strict_types=1);
namespace App\Constants;

final class ExceptionInfo
{
    const ExceptionInfoArray = [

        ExceptionCode::CREATE_DATABASE_ERROR => 'An error occurred while creating a new record in the database',

        ExceptionCode::UPDATE_DATABASE_ERROR => 'An error occurred while updating a database record',

        ExceptionCode::DELETE_DATABASE_ERROR => 'An error occurred while trying to delete a record from the database',

    ];

    public static function getMessageByKey (int $key): string
    {
        return self::ExceptionInfoArray[$key];
    }
    public static function getExceptionInfoArray (): array
    {
        return self::ExceptionInfoArray;
    }

}