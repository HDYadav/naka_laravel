<?php

namespace App\Http\Controllers\Auth; 

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Models\User;
use App\Http\Requests\RegistraionRequest;
use App\Repository\SignupRepository;
use Illuminate\Support\Facades\DB;
use App\Helpers\LogBuilder;
use App\Http\Requests\EmployerRegistrationRequest;
use App\Http\Requests\OtpLoginRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;  
use App\Http\Requests\UserLoginRequest;
use App\Models\UserOtp;
use App\Repository\OtpRepository;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
  

class ApiAuthController extends ApiController
{ 

public function register(RegistraionRequest $request, SignupRepository $signupRepository)
{ 
 
    try {
        DB::beginTransaction();
            $user =  $signupRepository->create($request); 
            $otpRepos = new OtpRepository; 
 
            $otp = $otpRepos->generate($user->email);

            $token = $user->createToken('Laravel Password Grant Client')->accessToken;  
            $response =  $otp; 
           
            $user['otp'] = $response['otp'];

            LogBuilder::apiLog(LogBuilder::$info, [$this->sucessResponse('your are looged in', $user, true, 200)]);  
            
        DB::commit();     
        return $this->sucessResponse('Records successfully inserted', $user, true, 201);
    } catch (QueryException $e) {
        DB::rollBack();
        LogBuilder::apiLog(LogBuilder::$error, [$this->errorResponse('Database error: ' . $e->getMessage(), 500)]);
        return $this->errorResponse('Database error: ' . $e->getMessage(), 500);
    } catch (ValidationException $e) {
        DB::rollBack();
        LogBuilder::apiLog(LogBuilder::$error, [$this->errorResponse($e->getMessage(), 422)]);
        return $this->errorResponse($e->getMessage(), 422);
    } catch (\Exception $e) {
        DB::rollBack();
        LogBuilder::apiLog(LogBuilder::$error, [$this->errorResponse($e->getMessage(), 500)]);
        return $this->errorResponse($e->getMessage(), 500);
    }
}




    public function employerRegister(EmployerRegistrationRequest $request, SignupRepository $signupRepository)
    {
        try {
            DB::beginTransaction();
            $user =  $signupRepository->employerCreate($request);
            $otpRepos = new OtpRepository;

           // dd($user);

            // Generate OTP
            $otp = $otpRepos->generate($user->email);

            $token = $user->createToken('Laravel Password Grant Client')->accessToken;
            $response =  $otp;

            $user['otp'] = $response['otp'];

            LogBuilder::apiLog(LogBuilder::$info, [$this->sucessResponse('your are looged in', $user, true, 200)]);

            DB::commit();
            return $this->sucessResponse('Records successfully inserted', $user, true, 200);
        } catch (QueryException $e) {
            DB::rollBack();
            LogBuilder::apiLog(LogBuilder::$error, [$this->errorResponse('Database error: ' . $e->getMessage(), 500)]);
            return $this->errorResponse('Database error: ' . $e->getMessage(), 500);
        } catch (ValidationException $e) {
            DB::rollBack();
            LogBuilder::apiLog(LogBuilder::$error, [$this->errorResponse($e->getMessage(), 422)]);
            return $this->errorResponse($e->getMessage(), 422);
        } catch (\Exception $e) {
            DB::rollBack();
            LogBuilder::apiLog(LogBuilder::$error, [$this->errorResponse($e->getMessage(), 500)]);
            return $this->errorResponse($e->getMessage(), 500);
        }
    }



    public function loginWithOtp(OtpLoginRequest $request)
    {

        /* Validation Logic */
        $userOtp   = UserOtp::where('user_id', $request->user_id)->where('otp', $request->otp)->orderBy('id','desc')->first();

        $now = now(); 

      // dd($userOtp->expire_at);
      
        if (!$userOtp) {
            return $this->errorResponse('Your Otp is not correct', 422);
        } else if ($userOtp && $now->isAfter($userOtp->expire_at)) {
            return $this->errorResponse('Your OTP has been expired', 401);
        }

       
 

        $user = User::whereId($request->user_id)->first();


        if ($user->user_type == '1') {
            $user->makeHidden(['email_verified_at', 'updated_at', 'created_at', 'company_name', 'company_size']);
        } else {
            $user->makeHidden(['email_verified_at', 'updated_at', 'created_at', 'dob']);
        }    



        if ($user) {

            $userOtp->update([
                'expire_at' => now()
            ]);

            
             User::where('id', $user->id)->update(['otp_verified' => 1]);          

            $token = $user->createToken('Login with Otp')->accessToken;

            $user->makeHidden(['email_verified_at', 'updated_at', 'created_at']);  
            $user['token'] = $token;  
            $user['otp_verified'] = 1;
            $user['otp'] = $userOtp ->otp;

            return $this->sucessResponse('OTP verified successfully', $user, true, 201);
        }

        return $this->errorResponse('Your Otp is not correct', 401);
    }

 

    public function login (UserLoginRequest $request) {

        try { 
        
            $user = User::where('email', $request->email)->firstOrFail();
            $otpRepos = new OtpRepository;

            if (Hash::check($request->password, $user->password)) {

                if ($user->user_type == '1') {
                    $user->makeHidden(['email_verified_at', 'updated_at', 'created_at', 'company_name', 'company_size']);
                } else {
                    $user->makeHidden(['email_verified_at', 'updated_at', 'created_at', 'dob']);
                }


                $userOtp = $otpRepos->generate($user->email);


                $user['otp'] = $userOtp->otp;
                

                if ($user->otp_verified != '1') {
                   return $this->sucessResponse('OTP not verified',$user, false, 200); 
                }

                 $token = $user->createToken('Laravel Password Grant Client')->accessToken;

                //$userOtp   = UserOtp::where('user_id', $request->user_id)->where('otp', $request->otp)->orderBy('id','desc')->first();
               
                
                $user['token'] =   $token; 
               
                LogBuilder::apiLog(LogBuilder::$info, [$this->sucessResponse('your are looged in', $user, true, 200)]); 
                return $this->sucessResponse('Login Sucessfully', $user, true, 200); 
               
            } else {
                throw new Exception("Password mismatch", 422);
            }
        } catch (ModelNotFoundException $e) {
            //  return $this->errorResponse('User does not exist or not verified', 422);
           return $this->sucessResponse('User does not exist or not verified', $e, false, 422);

        } catch (Exception $e) { 
         // dd($e->getCode());
          return $this->errorResponse($e->getMessage(), '500');
           
        }
    }

    public function logout(Request $request)
    {
        try {
            $user = $request->user();
            $token = $user->token();

            // Invalidate the token by setting its expires_at to the current time
            $token->expires_at = now();
            $token->save();

            // Revoke the token
            $token->revoke();

            return $this->sucessResponse('You have been successfully logged out!', null, true, 200);
        } catch (Exception $e) {
            return $this->errorResponse('An error occurred while logging out. Please try again later.', 500);
        }
    }


    public function resendOtp(Request $request)
    {
        $user = User::find($request->user_id);

        if (!$user) {
            return $this->errorResponse('User not found', 404);
        }

        // Generate a new OTP
       // $otp = mt_rand(100000, 999999);

       $otp = 123456;
        // Save the new OTP to the user's record
        UserOtp::updateOrCreate(
            ['user_id' => $user->id],
            ['otp' => $otp, 'expire_at' => now()->addMinutes(5)]
        );

        // Send the OTP to the user via email
     //   Mail::to($user->email)->send(new OTPMail($otp));

        return $this->sucessResponse('OTP resent successfully', $otp, true, 200);
    }


}
