<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Validator;

class AuthController extends Controller
{
    /**
     * login function
     */
    public function login(Request $request)
    {
        $data = $request->all();
        $errorMessages = config('constants.user.validations');
        $successMessages = config('constants.user.success');

        $validation = \Validator::make($data, [
                'email' => array(
                    'required',
                    'regex:' . config('constants.patterns.email'),
                ),
                "password" => "required|min:8|regex:" . config('constants.patterns.password'),
            ], [
                "email.required" => $errorMessages['emailRequired'],
                "email.regex" => $errorMessages['emailInvalid'],
                "password.required" => $errorMessages['passwordRequired'],
                "password.min" => $errorMessages['passwordLengthNotMatch'],
                "password.regex" => $errorMessages['invalidPassword'],
            ]);

        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validation->errors()->toArray()
            ], 200);
        }


        try{
            $user = User::whereRaw('LOWER(email) = ?', [strtolower($data['email'])])->first();

            // Authenticate the User
            if (!isset($user->email) || !Auth::attempt(['email' => $user->email, 'password' => $data['password']])) {
                return response()->json([
                    'success' => false,
                    'message' => $errorMessages['invalidEmailOrPassword']
                ], 200);
                return response()->json(['message' => 'Email or Password incorrect'], 422);
            }

            // Generate token for one hour expire time
            $tokenResult = $user->createToken(config('constants.user.userAccessToken'));
            $token = $tokenResult->token;
            $token->expires_at = Carbon::now()->addHour(1);
            $token->save();
        }catch(Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $errorMessages['invalidEmailOrPassword']
            ], 200);
        }
        
        return response()->json([
            'success' => true,
            'access_token' => $tokenResult->accessToken,
            'user_details' => $user,
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }

    /** Logout function */
    public function logout(Request $request) {
        $request->user()->token()->revoke();
        return response()->json([
            'success' => true,
        ]);
    }
}
