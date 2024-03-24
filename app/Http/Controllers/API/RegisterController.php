<?php
     
namespace App\Http\Controllers\API;
     
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\ApiController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\RegistraionRequest;
use App\Repository\SignupRepository;
use Illuminate\Support\Facades\DB;
use App\Helpers\LogBuilder;
     
class RegisterController extends ApiController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(RegistraionRequest $request, SignupRepository $signupRepository): JsonResponse
    {   
        try { 
        DB::beginTransaction();       
         $users =  $signupRepository->create($request);
       //  return  $user->assignRole([$request->role_id]);     
         DB::commit();        
            return $this->sucessResponse('Records successfully inserted', null, true, 201);
        } catch (\Exception $e) {
            DB::rollBack();
            LogBuilder::apiLog(LogBuilder::$error, [$this->errorResponse($e->getMessage(),404)]); 
            return  $this->errorResponse($e->getMessage(),404); 
        } 
    }
     
    
}