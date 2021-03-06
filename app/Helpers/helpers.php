<?php

use App\Models\TWILIO;
use App\Models\User;
use Twilio\Rest\Client;

/**
 * @param $phoneNumber
 * @return bool
 * @throws \Twilio\Exceptions\ConfigurationException
 * @throws \Twilio\Exceptions\TwilioException
 */
function sendOtpByTWILIO($phoneNumber){

    try {
        if(getenv('SEND_OTP') == 'TRUE'){
            return TRUE;
        }else{
            $twilo = TWILIO::where('TWILIO_AUTH_TOKEN','!=','')
                ->where('TWILIO_SID','!=','')
                ->where('TWILIO_VERIFY_SID','!=','')
                ->first();

            $token = $twilo->TWILIO_AUTH_TOKEN;
            $twilio_sid = $twilo->TWILIO_SID;
            $twilio_verify_sid = $twilo->TWILIO_VERIFY_SID;

            $twilio = new Client($twilio_sid, $token);
            $sendOtp = $twilio->verify->v2->services($twilio_verify_sid)
                ->verifications
                ->create($phoneNumber, "sms");

            if($sendOtp){
                return TRUE;
            }else{
                return FALSE;
            }
        }

    } catch (ErrorException $e) {
        return FALSE;
    }
}

/**
 * @param $phoneNumber
 * @param $verificationCode
 * @return bool
 * @throws \Twilio\Exceptions\ConfigurationException
 * @throws \Twilio\Exceptions\TwilioException
 */
function verifyOtpByTWILIO($phoneNumber, $verificationCode){
    try {
        if(getenv('SEND_OTP') == 'TRUE'){
            return TRUE;
        }else {
            $twilo = TWILIO::where('TWILIO_AUTH_TOKEN', '!=', '')
                ->where('TWILIO_SID', '!=', '')
                ->where('TWILIO_VERIFY_SID', '!=', '')
                ->first();

            $token = $twilo->TWILIO_AUTH_TOKEN;
            $twilio_sid = $twilo->TWILIO_SID;
            $twilio_verify_sid = $twilo->TWILIO_VERIFY_SID;

            $twilio = new Client($twilio_sid, $token);
            $verification = $twilio->verify->v2->services($twilio_verify_sid)
                ->verificationChecks
                ->create($verificationCode, array('to' => $phoneNumber));

            if ($verification->valid) {
                return TRUE;
            } else {
                return FALSE;
            }
        }

    } catch (ErrorException $e) {
        return FALSE;
    }
}

/**
 * @param $deviceToken
 * @param $orderId
 * @param $foodName
 * @return int
 */
function sendNotificationFCM($deviceToken, $orderId, $foodName, $orderFrom, $clickAction)
{
    $accesstoken = "key=AAAA6DftdWk:APA91bEwkeR1wHImQVk_ryC5Nfk8O1GK2E1dDamgTN-nzTStibnK2SFj5n2qkuXYIr8ZhU7hJlfLADmsq_HctdmEo_r4RJYNHot60RUo-Vmt2_ovvZUfKd3bCDqu-Q1OadOGa-VEisQZ";

    $URL = 'https://fcm.googleapis.com/fcm/send';

    $post_data = '{
            "to" : "' . $deviceToken . '",
            "data" : {
              "order_id" : "' . $orderId . '",
              "food_name" : "' . $foodName . '",
            },
            "notification" : {
                 "title": "New order",
                "body": "New order from  '.$orderFrom.' ",
                "click_action": "'.$clickAction.'"
               },

          }';

    $crl = curl_init();

    $headr = array();
    $headr[] = 'Content-type: application/json';
    $headr[] = 'Authorization: ' . $accesstoken;
    curl_setopt($crl, CURLOPT_SSL_VERIFYPEER, false);

    curl_setopt($crl, CURLOPT_URL, $URL);
    curl_setopt($crl, CURLOPT_HTTPHEADER, $headr);

    curl_setopt($crl, CURLOPT_POST, true);
    curl_setopt($crl, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);

    $rest = curl_exec($crl);

    if ($rest === false) {
        $result_noti = 0;
    } else {
        $result_noti = 1;
    }

    return $result_noti;
}


/**
 * @param $deviceToken
 * @param $orderId
 * @param $foodName
 * @return int
 */
function sendStatusNotificationFCM($deviceToken, $message)
{
    $accesstoken = "key=AAAA6DftdWk:APA91bEwkeR1wHImQVk_ryC5Nfk8O1GK2E1dDamgTN-nzTStibnK2SFj5n2qkuXYIr8ZhU7hJlfLADmsq_HctdmEo_r4RJYNHot60RUo-Vmt2_ovvZUfKd3bCDqu-Q1OadOGa-VEisQZ";

    $URL = 'https://fcm.googleapis.com/fcm/send';

    $post_data = '{
            "to" : "' . $deviceToken . '",
            "data" : {
              "order_id" : "",
              "food_name" : "",
            },
            "notification" : {
                 "title": "DD Notification",
                "body": " '.$message.' ",
               },

          }';

    $crl = curl_init();

    $headr = array();
    $headr[] = 'Content-type: application/json';
    $headr[] = 'Authorization: ' . $accesstoken;
    curl_setopt($crl, CURLOPT_SSL_VERIFYPEER, false);

    curl_setopt($crl, CURLOPT_URL, $URL);
    curl_setopt($crl, CURLOPT_HTTPHEADER, $headr);

    curl_setopt($crl, CURLOPT_POST, true);
    curl_setopt($crl, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);

    $rest = curl_exec($crl);


    if ($rest === false) {
        $result_noti = 0;
    } else {
        $result_noti = 1;
    }

    return $result_noti;
}

function sendPushNotification($notificationData)
{
    //SEND PUSH NOTIFICATION
    $firebaseToken = User::whereNotNull('device_token')->pluck('device_token')->all();

    $SERVER_API_KEY = 'AAAAETK6JGQ:APA91bGE6LufLmq71PcXiG1WqaC9JnR560cknnuvzCqauJC2gDQiNpJa7Pj4yKqEmiQwE4UcUMRpBK45RHPxrm5n9q0gUkKIpiSTdmNXkglB7jsTEjTV3blwZtsnMKTab97Ju2qrq_ya';

    $data = [
        "registration_ids" => $firebaseToken,
        "notification" => [
            "title" => "New registration",
            "body" => "test",
        ]
    ];
    $dataString = json_encode($data);

    $headers = [
        'Authorization: key=' . $SERVER_API_KEY,
        'Content-Type: application/json',
    ];

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

    $response = curl_exec($ch);

    return 1;
   // dd($response);
}


function getAddress($id, $type)
{
    if($type == 'customer'){
       $addresss =  \App\Models\CustomerProfile::where('customer_id', $id)->first();
    }
    if($type == 'restaurant'){
        $addresss =  \App\Models\RestaurantProfile::where('restaurant_id', $id)->first();
    }
    if($type == 'rider'){
        $addresss =  \App\Models\RiderProfile::where('rider_id', $id)->first();
    }

    return $addresss->address ? $addresss->address : "-";
}


function latLongByAddress($address): array
{
    //$address = "Chaitankhila, Bangladesh";

    $prepAddr = str_replace(' ','+',$address);
    $prepAddr1 = str_replace(',','+',$prepAddr);
    $apiKey = 'AIzaSyCYxxv5F_j31DkVZnhIzkvXlCAL6gv8uPg'; // Google maps now requires an API key.

    $geocode=file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($prepAddr1).'&sensor=false&key='.$apiKey);

    //print_r($geocode);

    $output= json_decode($geocode);
    $latitude = $output->results[0]->geometry->location->lat;
    $longitude = $output->results[0]->geometry->location->lng;

    return array('latitude'=>$latitude, 'longitude'=>$longitude);

}


function getLatLong($address, $tableName, $id)
{

    $latLong = latLongByAddress($address);

    if($tableName == 'customers'){
        \App\Models\Customer::where('id', $id)->update(
            array(
                'latitude'=>$latLong['latitude'],
                'longitude'=>$latLong['longitude'],
            )
        );
    }

    if($tableName == 'restaurants'){
        \App\Models\Restaurant::where('id', $id)->update(
            array(
                'latitude'=>$latLong['latitude'],
                'longitude'=>$latLong['longitude'],
            )
        );
    }

    if($tableName == 'riders'){
        \App\Models\Rider::where('id', $id)->update(
            array(
                'latitude'=>$latLong['latitude'],
                'longitude'=>$latLong['longitude'],
            )
        );
    }

}


/**
 * @param $address
 * @param $distance in Kilometer
 * @return array
 */
function distanceLatLong($address='', $distance=0): array
{
    $distance = $distance ? $distance : 0;
    $earthRadius = 6371;

    $latLong = latLongByAddress($address);

    $currentLat = deg2rad($latLong['latitude']);
    $currentLon = deg2rad($latLong['longitude']);

    $bearing = deg2rad(0);

    $distanceLat = asin(sin($currentLat) * cos($distance / $earthRadius) + cos($currentLat) * sin($distance / $earthRadius) * cos($bearing));
    $distanceLon = $currentLon + atan2(sin($bearing) * sin($distance / $earthRadius) * cos($currentLat), cos($distance / $earthRadius) - sin($currentLat) * sin($distanceLat));

    //echo 'LAT: ' . rad2deg($distanceLat) . '<br >';
    //echo 'LNG: ' . rad2deg($distanceLon);

    return array('distanceLat'=>rad2deg($distanceLat), 'distanceLon'=>rad2deg($distanceLon));


}

function getDistance(){
    return \App\Models\GOOGLE::get()->first()->distance;
}

