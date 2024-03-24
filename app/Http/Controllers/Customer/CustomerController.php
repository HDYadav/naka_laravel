<?php

namespace App\Http\Controllers\Customer; 
 
use App\Http\Controllers\ApiController;
use App\Helpers\LogBuilder; 
use Illuminate\Database\QueryException as DatabaseQueryException;
use League\Config\Exception\ValidationException;
use App\Http\Requests\CustomerRequest;
use App\Repository\CustomerRepository;
use Illuminate\Support\Facades\DB;
 


class CustomerController extends ApiController
{
    public function storeCustomer(CustomerRequest $request, CustomerRepository $customerRepository){  
  
 
        try {
            DB::beginTransaction();            
            $customerRepository->insertData($request); 
            DB::commit();     
            return $this->sucessResponse('Records successfully inserted', null, true, 201);
        } catch (DatabaseQueryException $e) {
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
}
