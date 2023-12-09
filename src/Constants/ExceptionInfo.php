<?php

namespace App\Constants;

class ExceptionInfo
{
    const ExceptionInfoArray = [

        ExceptionCode::CREATE_DATABASE_ERROR => 'An error occurred while creating a new record in the database',

        ExceptionCode::UPDATE_DATABASE_ERROR => 'An error occurred while updating a database record',

        ExceptionCode::DELETE_DATABASE_ERROR => 'An error occurred while trying to delete a record from the database',

    ];

    public static function getMessageByKey (int $key)
    {
        return self::ExceptionInfoArray[$key];
    }
    public static function getExceptionInfoArray ()
    {
        return self::ExceptionInfoArray;
    }

}