<?php

namespace App\Helpers;

class AlertHelper
{
    /**
     * Create an alert message.
     *
     * @param string $type
     * @param string $message
     * @return array
     */
    public static function createAlert($type, $message)
    {
        return ['type' => $type, 'message' => $message];
    }

    // /**
    //  * Store the alert message in session.
    //  *
    //  * @param array $alert
    //  */
    // public static function setAlert($alert)
    // {
    //     $alerts = session()->get('alerts', []);
    //     array_push($alerts, $alert);
    //     session()->flash('alerts', $alerts);
    // }

    /**
     * Retrieve all alert messages from the session.
     *
     * @return array
     */
    public static function getAlerts()
    {
        return session()->get('alerts', []);
    }
}
