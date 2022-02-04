<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\ResponseTrait;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    use ResponseTrait;

    public function __construct(){
        $this->middleware('jwt.verify', ['except'=> ['login', 'register']]);
    }

    public function register(Request $request){
        //Validate data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()){
            return response()->json(['error' => $validator->messages()], 200);
        }
        // Create The User
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $user->assignRole('Advertiser');

        return $this->success($user, 200);
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');
        //Validate data
        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|string|min:8|max:50'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()){
            return response()->json(['error' => $validator->messages()], 200);
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

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'User successfully logged out.'],  200);
    }
}
