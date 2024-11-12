<?php

namespace App\Helpers;

class SaasHelper
{
    public static function getSubscriptionActionKey($actionName): int
    {
        $actions = config('saas.SUBSCRIPTION_HISTORY_ACTION');

        // Reverse the array to use values as keys
        $reversedActions = array_flip($actions);

        // Return the key for the given action name
        return $reversedActions[$actionName] ?? null;
    }
}
