<?php

namespace App\Http\Controllers\Chart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\DB; 
use App\Models\ChartOfAccounts; 
use App\Http\Requests\ChartsOfAccountRequest;
use App\Repository\ChartsOfAccountRepository; 
use Illuminate\Database\QueryException as DatabaseQueryException; 
use League\Config\Exception\ValidationException; 
use App\Helpers\LogBuilder;
use App\Http\Controllers\ApiController;
use App\Http\Requests\ChartsOfAccountEditRequest;


class ChartOfAccountController extends ApiController
{
            private static $parent='0';

            
            public function storeChartsAccount(ChartsOfAccountRequest $request,ChartsOfAccountRepository $chartsOfAccountRepository){ 

                try {
                    DB::beginTransaction();            
                    $chartsOfAccountRepository->insertChartOfAccount($request); 
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


            public function updateChartsAccount(ChartsOfAccountEditRequest $request, ChartsOfAccountRepository $chartsOfAccountRepository){  
                 
                try {
                    DB::beginTransaction();            
                    $chartsOfAccountRepository->updateChartOfAccount($request); 
                    DB::commit();     
                    return $this->sucessResponse('Records successfully updated', null, true, 201);
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


            public function industryByID($industry_id=null){   

                $all = ChartOfAccounts::All()->where('customer_id',$industry_id);  
                $parents = $this->getAllChartsOfAccouts($all,Self::$parent);  // Get all paret and child  
    
                return response()->json($parents); 
            }


            public function customerByID($customer_id=null){   
                 

                $all = ChartOfAccounts::All()->where('customer_id',$customer_id);   
    
                $parents = $this->getAllChartsOfAccouts($all,Self::$parent);  // Get all paret and child  
    
                // $manager = new Manager();
                // $resource = new Collection($parents, new ChartTransformer()); 
                // $data = $manager->createData($resource)->toArray();
                // return response()->json($data);
    
                return response()->json($parents); 
            }

 

   
        public function index($parent=null){    


            $all = ChartOfAccounts::All();  

            $parents = $this->getAllChartsOfAccouts($all,Self::$parent);  // Get all paret and child  

            // $manager = new Manager();
            // $resource = new Collection($parents, new ChartTransformer()); 
            // $data = $manager->createData($resource)->toArray();
            // return response()->json($data);

            return response()->json($parents); 
        }

            protected function getAllChartsOfAccouts($charts, $parentId = null){

                $result = []; 

                foreach ($charts as $chart) { 
                    if ($chart->parent_id == $parentId) {
                        $chart->children = $this->getAllChartsOfAccouts($charts, $chart->id);
                        $result[] = $chart;
                    }
                }
        
                return $result; 

            }


            public function show($id){   

                $all = ChartOfAccounts::All();  
    
                $parents = $this->getAllChartsOfAccouts($all,$id);  // Get all paret and child  
    
                // $manager = new Manager();
                // $resource = new Collection($parents, new ChartTransformer()); 
                // $data = $manager->createData($resource)->toArray();
                // return response()->json($data);
    
                return response()->json($parents); 
            }

  
         
           
}
