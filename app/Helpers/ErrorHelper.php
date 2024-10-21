<?php

namespace App\Helpers;

class ErrorHelper
{
    // Define all your errors here
    private static $errors = [
        'GENERIC_ERROR' => [
            'code' => 1001,
            'text' => 'There is something errors happen',
            'http_status' => 500
        ],
        'WRONG_CURRENT_PASSWORD' => [
            'code' => 1100,
            'text' => 'Ooops Your current password is incorrect!',
            'http_status' => 400
        ],
        // Add other errors here...
    ];

    /**
     * Get error text by its name.
     *
     * @param string $errorName
     * @return string
     */
    public static function makeErrorsText(string $errorName): string
    {
        if (isset(self::$errors[$errorName])) {
            $error = self::$errors[$errorName];
            return "ERROR {$error['code']} : {$error['text']}";
        }
        return 'ERROR: Undefined error!';
    }

    /**
     * Get the full error details for REST API response.
     *
     * @param string $errorName
     * @return array
     */
    // public static function makeErrorDetails(string $errorName): array
    // {
    //     if (isset(self::$errors[$errorName])) {
    //         return self::$errors[$errorName];
    //     }
    //     return ['code' => 0, 'text' => 'Undefined error', 'http_status' => 500];
    // }
}
