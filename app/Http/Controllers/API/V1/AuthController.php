<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Validator;

class AuthController extends BaseController
{
    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if (! $token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        }

        $data['token'] = $this->createNewToken($token);
        $data['user'] = auth()->user();
        return $this->sendResponse($data, 'User login successfully.', Response::HTTP_OK);

    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        auth()->logout();

        return $this->sendResponse([], 'User successfully signed out.', Response::HTTP_OK);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        $data['token'] =  $this->createNewToken(auth()->refresh());
        $data['user'] = auth()->user();
        return $this->sendResponse( $data, 'User token.', Response::HTTP_OK);

    }
}
