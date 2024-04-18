<?php

namespace App\Repository;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserOtp;
use App\Http\Requests\OtpLoginRequest; 

class OtpRepository
{

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function generate($email)
    {
         

        /* Generate An OTP */
        $userOtp = $this->generateOtp($email);
      //  $userOtp->sendSMS($email);         // send otp on twillo 

      return $userOtp;

       // return $this->sucessResponse('OTP has been sent on Your Email Address', $userOtp, true, 201);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function generateOtp($email)
    {

        // $user = User::where('mobile', '=', $mobile)->first();

        $user = User::where('email', '=', $email)->first();


        //  dd($user->id);

        /* User Does not Have Any Existing OTP */
        $userOtp = UserOtp::where('user_id', $user->id)->select('user_id', 'otp', 'expire_at')->latest()->first();

        $now = now();

      //  dd($userOtp->expire_at);

        if ($userOtp && $now->isBefore($userOtp->expire_at)) {
            return $userOtp;
        }

        /* Create a New OTP */
        // return UserOtp::create([
        //     'user_id' =>$user->id,
        //     'otp' => rand(1231, 7879),
        //     'expire_at' => $now->addMinutes(10)
        // ]);

        return UserOtp::create([
            'user_id' => $user->id,
            'otp' => 123456,
            'expire_at' => $now->addMinutes(10)
        ]);

    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function verification($user_id)
    {
        return view('auth.otpVerification')->with([
            'user_id' => $user_id
        ]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    // public function loginWithOtp(OtpLoginRequest $request)
    // {

    //     /* Validation Logic */
    //     $userOtp   = UserOtp::where('user_id', $request->user_id)->where('otp', $request->otp)->first();

    //     $now = now();
    //     if (!$userOtp) {
    //         return $this->errorResponse('Your Otp is not correct', 422);
    //     } else if ($userOtp && $now->isAfter($userOtp->expire_at)) {
    //         return $this->errorResponse('Your OTP has been expired', 402);
    //     }

    //     $user = User::whereId($request->user_id)->first();

    //     if ($user) {

    //         $userOtp->update([
    //             'expire_at' => now()
    //         ]);

    //         // Auth::login($user);

    //         // $token = $this->tokenHeader($user->createToken('MyApp')->accessToken);

    //         $token = $user->createToken('MyApp')->accessToken;

    //         return $this->sucessResponse('OTP has been sucessfully verified', $token, true, 201);
    //     }

    //     return $this->errorResponse('Your Otp is not correct', 402);
    // }


    public function sucessResponse($message, $data = null, $status, $code = null)
    {

        return response()->json([
            'status'   => $status,
            'message'   => $message,
            'data'      => $data
        ], $code);
    }

    protected function errorResponse($message, $code)
    {
        return response()->json(['error' => $message], $code);
    }

}