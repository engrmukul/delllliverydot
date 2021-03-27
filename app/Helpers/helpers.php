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

