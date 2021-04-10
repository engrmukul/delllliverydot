<?php

namespace App\Repositories;

use App\Contracts\SettingsContract;
use App\Models\FCM;
use App\Models\GeneralSetting;
use App\Models\GOOGLE;
use App\Models\PUSHER;
use App\Models\TWILIO;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class SettingsRepository implements SettingsContract
{
    /**
     * @param array $params
     * @return mixed
     */
    public function updateSettings(array $params)
    {
        try {
            DB::beginTransaction();

            $collection = collect($params)->except('_token');


            //GOOGLE GEOCODE API KEY UPDATE
            $GOOGLE = GOOGLE::findOrNew($collection['googleId']);
            $GOOGLE->API_KEY = $collection['API_KEY'];
            $GOOGLE->distance = $collection['distance'];
            $GOOGLE->save();

            //FCM UPDATE

            $FCM = FCM::findOrNew($collection['fcmId']);
            $FCM->SERVER_API_KEY = $collection['SERVER_API_KEY'];
            $FCM->save();

/*            $FCM = new FCM();
            $FCM->SERVER_API_KEY = $collection['SERVER_API_KEY'];
            $FCM->save();*/

            //PUSHER UPDATE
            //$PUSHER = new PUSHER();
            $PUSHER = PUSHER::findOrNew($collection['pusherId']);
            $PUSHER->PUSHER_APP_ID = $collection['PUSHER_APP_ID'];
            $PUSHER->PUSHER_APP_KEY = $collection['PUSHER_APP_KEY'];
            $PUSHER->PUSHER_APP_SECRET = $collection['PUSHER_APP_SECRET'];
            $PUSHER->PUSHER_APP_CLUSTER = $collection['PUSHER_APP_CLUSTER'];

            $PUSHER->save();

            //TWILIO UPDATE
            //$TWILIO = new TWILIO();
            $TWILIO = TWILIO::findOrNew($collection['twilioId']);
            $TWILIO->TWILIO_SID = $collection['TWILIO_SID'];
            $TWILIO->TWILIO_AUTH_TOKEN = $collection['TWILIO_AUTH_TOKEN'];
            $TWILIO->TWILIO_VERIFY_SID = $collection['TWILIO_VERIFY_SID'];

            $TWILIO->save();

            //SET POINT VALUE
            //$GeneralSetting = new GeneralSetting();
            $GeneralSetting = GeneralSetting::findOrNew($collection['generalSettingId']);
            $GeneralSetting->point_value = $collection['point_value'];

            $GeneralSetting->save();

            DB::commit();

            return 1;

        } catch (QueryException $exception) {
            DB::rollback();
            return false;
        }
    }
}
