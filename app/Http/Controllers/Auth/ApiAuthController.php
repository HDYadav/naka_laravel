<?php

namespace App\Http\Controllers\Auth; 

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\ApiController;
use App\Models\User;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Http\JsonResponse;
use App\Http\Requests\RegistraionRequest;
use App\Repository\SignupRepository;
use Illuminate\Support\Facades\DB;
use App\Helpers\LogBuilder;
use App\Http\Requests\EmployerRegistrationRequest;
use App\Http\Requests\OtpLoginRequest;
use Illuminate\Support\Str;
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

            // Generate OTP
            $otp = $otpRepos->generate($user->email);

            $token = $user->createToken('Laravel Password Grant Client')->accessToken;  
            $response =  $otp;

           // $response = ['uid' => $user->id, 'otp' => $otp, 'name' => $user->name, 'email' => $user->email, 'token' => $token]; 

            LogBuilder::apiLog(LogBuilder::$info, [$this->sucessResponse('your are looged in', $response, true, 200)]);  
            
        DB::commit();     
        return $this->sucessResponse('Records successfully inserted', $response, true, 201);
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

            // Generate OTP
            $otp = $otpRepos->generate($user->email);

            $token = $user->createToken('Laravel Password Grant Client')->accessToken;
            $response =  $otp;

            // $response = ['uid' => $user->id, 'otp' => $otp, 'name' => $user->name, 'email' => $user->email, 'token' => $token]; 

            LogBuilder::apiLog(LogBuilder::$info, [$this->sucessResponse('your are looged in', $response, true, 200)]);

            DB::commit();
            return $this->sucessResponse('Records successfully inserted', $response, true, 201);
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
        $userOtp   = UserOtp::where('user_id', $request->user_id)->where('otp', $request->otp)->first();

        $now = now();
        if (!$userOtp) {
            return $this->errorResponse('Your Otp is not correct', 422);
        } else if ($userOtp && $now->isAfter($userOtp->expire_at)) {
            return $this->errorResponse('Your OTP has been expired', 402);
        }

        $user = User::whereId($request->user_id)->first();

        if ($user) {

            $userOtp->update([
                'expire_at' => now()
            ]);

            // Auth::login($user);

            // $token = $this->tokenHeader($user->createToken('MyApp')->accessToken);

            $token = $user->createToken('MyApp')->accessToken;

            return $this->sucessResponse('OTP has been sucessfully verified', $token, true, 201);
        }

        return $this->errorResponse('Your Otp is not correct', 402);
    }




    public function login (UserLoginRequest $request) {

        try { 
        
            $user = User::where('email', $request->email)->firstOrFail();

          //  dd($user);
            
        
            if (Hash::check($request->password, $user->password)) {
                 $token = $user->createToken('Laravel Password Grant Client')->accessToken;

             // dd($token);
               // $token = $user->createToken('Laravel Password Grant Client',['read'],true);
               // $newAccessToken = $user->refreshToken;
                $response = ['uid'=>$user->id, 'name' => $user->name,'email' => $user->email, 'token' => $token]; 
                LogBuilder::apiLog(LogBuilder::$info, [$this->sucessResponse('your are looged in', $response, true, 200)]); 
                return $this->sucessResponse('your are looged in', $response, true, 200); 
               
            } else {
                throw new Exception("Password mismatch", 422);
            }
        } catch (ModelNotFoundException $e) { 
            return $this->errorResponse('User does not exist', 422);

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


}
