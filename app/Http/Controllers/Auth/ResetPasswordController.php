<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\DB;
use App\Helpers\LogBuilder;
use App\Http\Controllers\ApiController;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;  


class ResetPasswordController extends ApiController
{

    public function checEmail(Request $request){

      
        try {

           $user  = User::where('email', $request->email)->firstOrFail(); 

            if ($user) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
              
                $response = ['uid' => $user->id, 'email' => $user->email, 'token' => $token];

                LogBuilder::apiLog(LogBuilder::$info, [$this->sucessResponse('password reset', $response, true, 200)]);
                return $this->sucessResponse('password reset', $response, true, 200);
            } else {
                throw new Exception("user mismatch", 422);
            }
        } catch (ModelNotFoundException $e) {
            return $this->errorResponse('User does not exist', 422);
        } catch (Exception $e) {
            // dd($e->getCode());
            return $this->errorResponse($e->getMessage(), '500');
        }
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        // $response = $this->broker()->reset(
        //     $request->only('email', 'password', 'password_confirmation', 'token'),
        //     function ($user, $password) {
        //         $user->password = bcrypt($password);
        //         $user->save();
        //     }
        // );

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json(['message' => 'Unable to find a user with that email'], 404);
        }

        // Perform password reset
        $user->password = bcrypt($request->password);
        $response = $user->save();

        // dd($response);

        // return Password::PASSWORD_RESET;



      

        // Check response for potential errors
        switch ($response) {
            case Password::PASSWORD_RESET:
                return response()->json(['message' => 'Password reset successfully'], 200);
            case Password::INVALID_USER:
                return response()->json(['message' => 'Unable to find a user with that email'], 404);
            case Password::INVALID_TOKEN:
                return response()->json(['message' => 'The token provided is invalid'], 400);
            case Password::INVALID_PASSWORD:
                return response()->json(['message' => 'The new password is invalid'], 400);
            default:
                return response()->json(['message' => 'Unable to reset password'], 500);
        }
    }


    protected function broker()
    {
        return Password::broker();
    }
}
