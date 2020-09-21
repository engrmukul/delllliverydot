<?php

namespace App\Http\Controllers\restaurant\API\V1;
   
use Illuminate\Http\Request;
use App\Http\Controllers\restaurant\API\V1\BaseController as BaseController;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
   
class RegisterController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {
        $validator = $request->validated();
        // $validator = Validator::make($request->all(), [
        //     'name' => 'required',
        //     'email' => 'required|email',
        //     'password' => 'required',
        //     'c_password' => 'required|same:password',
        // ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), Response::HTTP_UNAUTHORIZED);
        }
   
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        if($user){
            $success['token'] =  $user->createToken('deliverydot')->accessToken;
            $success['user'] =  $user;
       
            return $this->sendResponse($success, 'User register successfully.', Response::HTTP_OK);
        }

        return $this->sendError('Unable to create.', 'Internal Server Error' ,Response::HTTP_INTERNAL_SERVER_ERROR);
    }
   
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')-> accessToken; 
            $success['name'] =  $user->name;
   
            return $this->sendResponse($success, 'User login successfully.');
        } 
        else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        } 
    }
}
