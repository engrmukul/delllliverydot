<?php

namespace App\Http\Controllers\API\V1;

use App\User;
use App\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Validator;

class RestaurantController extends BaseController
{
    public function __construct(){

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validating title and body field
        $validator = Validator::make($request->all(), [
            'user_name' => 'required|unique:users|between:2,50',
            'email' => 'required|email|unique:users|max:50',
            'phone' => 'required|unique:users|max:14',
            'password' => 'required|same:c_password|string|min:6',
            'roles' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), Response::HTTP_UNAUTHORIZED);
        }

        $user = new User;
        $user->user_name = $request->user_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = bcrypt($request->password);
        $user->email_verification_token = bin2hex(random_bytes(32));

        if($user->save()){

            //SAVE USER PROFILE
            $userProfile = new userProfile();
            $userProfile->user_id = $user->user_id;
            $userProfile->save();

            //ASSIGN ROLE
            $user->assignRole($request->roles);

            //SEND EMAIL WITH VERIFICATION CODE
            //$this->sendVerificationEmail($user->email, $user->email_verification_token);

            //SEND OTP


            return $this->sendResponse([], 'User register successfully.');
        }
        return $this->sendError('Unable to create.', 'Internal Server Error' ,Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * @param $emailAddress
     * @param $evCode
     */
    public function sendVerificationEmail($emailAddress, $evCode)
    {

        //GENERATE VERIFICATION URL
        $verificationURL = route('verify-email', ['emailAddress' => $emailAddress, 'evCode' => $evCode,]);

        //SEND EMAIL
        $details = [
            'title' => 'Welcome',
            'body' => 'Please verify your email address by clicking on the link below',
            'verification_url' => $verificationURL
        ];
        \Mail::to($emailAddress)->send(new \App\Mail\WelcomeEmail($details));
    }

    /**
     * @param $emailAddress
     * @param $evCode
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function verifyEmail($emailAddress, $evCode)
    {
        //FIND USER DETAILS
        $user = User::where('email', $emailAddress)
            ->where('email_verification_token', $evCode)
            ->where('is_email_verified', '0')
            ->first();

        //REDIRECT TO HOME IF NO USER FOUND FOR PAYLOAD DATA
        if (!$user) {
            return redirect()->route('home');
        } else {
            //ACTIVATE USER
            $user->is_email_verified = '1';
            $user->status = 'ACTIVE';
            $user->save();

            return redirect()->route('home');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['user'] = $user = User::with('userProfile')->find($id);

        if (is_null($user)) {
            return $this->sendError('User not found.');
        }
        $data['roles'] = Role::pluck('name','name')->all();
        $data['userRole'] = $user->roles->pluck('name','name')->all();
        return $this->sendResponse($data, 'User retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request, $userid)
    {
        $userProfile = UserProfile::find($userid);
        $userProfile->first_name = $request->first_name;
        $userProfile->last_name = $request->last_name;
        $userProfile->profile_name = $request->profile_name;
        $userProfile->country_id = $request->country_id;
        $userProfile->city_id = $request->city_id;
        $userProfile->zip_code = $request->zip_code;
        $userProfile->address = $request->address;
        $userProfile->news_subscription = ($request->news_subscription == 'on') ? '1' : '0';
        $userProfile->notification_subscription = ($request->notification_subscription == 'on') ? '1' : '0';

        if($userProfile->save()){
            return $this->sendResponse($userProfile, 'User Update successfully.');
        }
        return $this->sendError('Unable to create.', 'Not Modified',Response::HTTP_NOT_MODIFIED);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function changePassword(Request $request, $userid)
    {
        $input = $request->all();
        //$userid = Auth::guard('api')->user()->id;
        $rules = array(
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        );
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $arr = array("status" => 400, "message" => $validator->errors()->first(), "data" => array());
        } else {
            try {
                if ((Hash::check(request('old_password'), auth()->user()->password)) == false) {
                    $arr = array("status" => 400, "message" => "Check your old password.", "data" => array());
                } else if ((Hash::check(request('new_password'), auth()->user()->password)) == true) {
                    $arr = array("status" => 400, "message" => "Please enter a password which is not similar then current password.", "data" => array());
                } else {
                    User::where('user_id', $userid)->update(['password' => Hash::make($input['new_password'])]);
                    $arr = array("status" => 200, "message" => "Password updated successfully.", "data" => array());
                }
            } catch (\Exception $ex) {
                if (isset($ex->errorInfo[2])) {
                    $msg = $ex->errorInfo[2];
                } else {
                    $msg = $ex->getMessage();
                }
                $arr = array("status" => 400, "message" => $msg, "data" => array());
            }
        }
        return \Response::json($arr);
    }

}
