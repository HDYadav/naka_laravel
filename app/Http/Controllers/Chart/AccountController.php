<?php

namespace App\Http\Controllers\Chart;


use Illuminate\Support\Facades\DB; 
use App\Http\Requests\AccountRequest;
use App\Http\Controllers\ApiController;
use App\Contracts\DataInsertionInterface;
use App\Helpers\LogBuilder; 
use Illuminate\Database\QueryException as DatabaseQueryException;
use League\Config\Exception\ValidationException;

class AccountController extends ApiController
{
    protected $dataInsertionService; 

    public function __construct(DataInsertionInterface $dataInsertionService)
    {
        $this->dataInsertionService = $dataInsertionService;
    }


    public function storeAccount(AccountRequest $request){ 

        try {
            DB::beginTransaction();            
            $this->dataInsertionService->insertData($request); 
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
