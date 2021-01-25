<?php

namespace App\Repositories;

use App\Contracts\SettingsContract;
use App\Models\FCM;
use App\Models\PUSHER;
use App\Models\TWILIO;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SettingsRepository implements SettingsContract
{
    /**
     * @param array $params
     * @return mixed
     */
    public function updateSettings(array $params)
    {
        $collection = collect($params)->except('_token');

        //FCM UPDATE
        $FCM = new FCM();
        $FCM->SERVER_API_KEY = $collection['SERVER_API_KEY'];

        $FCM->save();

        //PUSHER UPDATE
        $PUSHER = new PUSHER();
        $PUSHER->PUSHER_APP_ID = $collection['PUSHER_APP_ID'];
        $PUSHER->PUSHER_APP_KEY = $collection['PUSHER_APP_KEY'];
        $PUSHER->PUSHER_APP_SECRET = $collection['PUSHER_APP_SECRET'];
        $PUSHER->PUSHER_APP_CLUSTER = $collection['PUSHER_APP_CLUSTER'];

        $PUSHER->save();

        //TWILIO UPDATE
        $TWILIO = new TWILIO();
        $TWILIO->TWILIO_SID = $collection['TWILIO_SID'];
        $TWILIO->TWILIO_AUTH_TOKEN = $collection['TWILIO_AUTH_TOKEN'];
        $TWILIO->TWILIO_VERIFY_SID = $collection['TWILIO_VERIFY_SID'];

        $TWILIO->save();

        return 1;
    }
}
