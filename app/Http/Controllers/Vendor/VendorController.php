<?php

namespace App\Http\Controllers\Vendor;


use App\Http\Controllers\ApiController;
use App\Helpers\LogBuilder; 
use Illuminate\Database\QueryException as DatabaseQueryException;
use League\Config\Exception\ValidationException;
use App\Http\Requests\VendorRequest;
use App\Repository\VendorRepository;
use Illuminate\Support\Facades\DB;

class VendorController extends ApiController
{
    
    public function storeVendor(VendorRequest $request, VendorRepository $vendorRepository){  
        
        try {
            DB::beginTransaction();            
            $vendorRepository->insertData($request); 
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
