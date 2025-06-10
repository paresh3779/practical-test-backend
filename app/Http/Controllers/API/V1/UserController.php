<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Validator;

class UserController extends Controller
{
    /**
     * Regitser user
     */
    public function regitser(Request $request){

        $data = $request->all();
        $errorMessages = config('constants.user.validations');
        $successMessages = config('constants.user.success');

        $validation = \Validator::make($data, [
                "first_name" => "required",
                "last_name" => "required",
                'email' => array(
                    'required',
                    'regex:' . config('constants.patterns.email'),
                    'unique:users'
                ),
                'phone_number' => array(
                    'required',
                    'regex:' . config('constants.patterns.mobile'),
                ),
                "password" => "required|min:8|regex:" . config('constants.patterns.password'),
                "repeat_password" => "same:password",
            ], [
                "first_name.required" => $errorMessages['firstNameRequired'],
                "last_name.required" => $errorMessages['lastNameRequired'],
                "email.required" => $errorMessages['emailRequired'],
                "email.regex" => $errorMessages['emailInvalid'],
                "email.unique" => $errorMessages['emailExists'],
                "phone_number.required" => $errorMessages['phoneRequired'],
                "phone_number.regex" => $errorMessages['phoneInvalid'],
                "password.required" => $errorMessages['passwordRequired'],
                "password.min" => $errorMessages['passwordLengthNotMatch'],
                "password.regex" => $errorMessages['invalidPassword'],
                'repeat_password.same' => $errorMessages['passwordNotMatch'],
            ]);

        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validation->errors()->toArray()
            ], 200);
        }

        try {
            $user = new User();
            $user->first_name = $data['first_name'];
            $user->last_name = $data['last_name'];
            $user->name = $data['first_name'].' '.$data['last_name'];
            $user->email = $data['email'];
            $user->phone_number = $data['phone_number'];
            $user->password = Hash::make($data['password']);
            $user->save();

        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $errorMessages['insertDataExceptionError'], 
                'exception' => $exception->getMessage()
            ], 200);
        }
        return response()->json([
            'success' => true,
            'message' => $successMessages['userCreated'], 
        ], 200);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }
}
