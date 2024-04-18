<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\DB;
use App\Helpers\LogBuilder;
use App\Http\Controllers\ApiController;
use App\Http\Requests\OtpLoginRequest;
use App\Models\User;
use App\Models\UserOtp;
use App\Repository\OtpRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;  


class ResetPasswordController extends ApiController
{

    public function checEmail(Request $request){

      
        try {

           $user  = User::where('email', $request->email)->firstOrFail(); 

            if ($user) {
                $otpRepos = new OtpRepository;

                $otp = $otpRepos->generate($user->email);

                $token = $user->createToken('Laravel Password Grant Client')->accessToken;

                // $response = ['uid' => $user->id, 'email' => $user->email, 'token' => $token];
                $user['otp'] = $otp->otp;

                if ($user->user_type == '1') {
                    $user->makeHidden(['email_verified_at', 'updated_at', 'created_at', 'company_name', 'company_size']);
                } else {
                    $user->makeHidden(['email_verified_at', 'updated_at', 'created_at', 'dob']);
                }
               // $user['token'] = $token;  

                LogBuilder::apiLog(LogBuilder::$info, [$this->sucessResponse('OTP send on your EmailId', $user, true, 200)]);
                return $this->sucessResponse('OTP send on your EmailId', $user, true, 200);
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
            'email' => 'required|email',            
            'password' => 'required|min:8',
        ]);

        // $response = $this->broker()->reset(
        //     $request->only('email', 'password', 'password_confirmation', 'token'),
        //     function ($user, $password) {
        //         $user->password = bcrypt($password);
        //         $user->save();
        //     }
        // );

        $user = User::where('email', $request->email)->first();

       // dd($user);

        if (!$user) {
            return response()->json(['message' => 'Unable to find a user with that email'], 404);
        }


        // $userOtp   = UserOtp::where('user_id', $user->id)->where('otp', $request->otp)->first(); 
        // $now = now();
        // if (!$userOtp) {
        //     return $this->errorResponse('Your Otp is not correct', 422);
        // } else if ($userOtp && $now->isAfter($userOtp->expire_at)) {
        //     return $this->errorResponse('Your OTP has been expired', 401);
        // }

        $otpRepos = new OtpRepository;

        $generated = $otpRepos->generate($user->email); 
        

        // Perform password reset
        $user->password = bcrypt($request->password);
        $response = $user->save();

        $user['otp'] = $generated->otp;


        if ($user->user_type == '1') {
            $user->makeHidden(['email_verified_at', 'updated_at', 'created_at', 'company_name', 'company_size']);
        } else {
            $user->makeHidden(['email_verified_at', 'updated_at', 'created_at', 'dob']);
        }
        

        // Check response for potential errors
        switch ($response) {
            case Password::PASSWORD_RESET:
               return  $this->sucessResponse('Password updated successfully', $user, true, 200);
               // return response()->json(['message' => 'Password updated successfully'], 200);
            case Password::INVALID_USER:
                return response()->json(['message' => 'Unable to find a user with that email'], 404);
            case Password::INVALID_TOKEN:
                return response()->json(['message' => 'The token provided is invalid'], 400);           
            default:
                return response()->json(['message' => 'Unable to reset password'], 500);
        }
    }




    // public function loginWithOtp(OtpLoginRequest $request)
    // {

    //     /* Validation Logic */
    //     $userOtp   = UserOtp::where('user_id', $request->user_id)->where('otp', $request->otp)->first();

    //     $now = now();
    //     if (!$userOtp) {
    //         return $this->errorResponse('Your Otp is not correct', 422);
    //     } else if ($userOtp && $now->isAfter($userOtp->expire_at)) {
    //         return $this->errorResponse('Your OTP has been expired', 401);
    //     }

    //     $user = User::whereId($request->user_id)->first();

    //     if ($user) {

    //         $userOtp->update([
    //             'expire_at' => now()
    //         ]);
    //         User::where('id', $user->id)->update(['otp_verified' => 1]);

    //         $token = $user->createToken('MyApp')->accessToken;

    //         $user->makeHidden(['email_verified_at', 'updated_at', 'created_at']);
    //         $user['token'] = $token;
    //         $user['otp_verified'] = 1;

    //         return $this->sucessResponse('OTP has been sucessfully verified', $user, true, 201);
    //     }

    //     return $this->errorResponse('Your Otp is not correct', 401);
    // }



    protected function broker()
    {
        return Password::broker();
    }
}
