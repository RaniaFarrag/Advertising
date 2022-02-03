<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    use ResponseTrait;

    public function login(Request $request){
        $credentials = $request->only('email', 'password');
        //Validate data
        $validate = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|string|min:8|max:50'
        ]);

        //Send failed response if request is not valid
        if ($validate->fails()){
            return response()->json(['error' => $validate->messages()], 200);
        }

        try {
            if (! $token = JWTAuth::attempt($credentials)){
                return $this->failure('credentials are invalid', 400);
            }
        }
        catch (JWTException $e){
            return $this->failure('Could not create token', 500);
        }
        $user = Auth::user();
        $user['token'] = $token;
        return $this->success($user, 200);

    }
}
