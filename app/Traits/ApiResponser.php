<?php

namespace app\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator; 


trait ApiResponser{

    public function sucessResponse($message, $data=null, $status, $code=null){

        return response()->json([
            'sucess'   => $status,
            'message'   => $message,
            'data'      => $data
        ], $code);
    }


    private function sucess($data,$code){
        return response()->json([$data,$code]);
    }

    protected function errorResponse($message,$code){
        return response()->json(['error'=>$message], $code);
    }

    protected function showAll(Collection $colletion,$code=200  ){
        $colletion = $this->sortData($colletion);
       // $colletion = $this->paginate($colletion);
       // $colletion = $this->cacheResponse($colletion);
        return response()->json(['data'=>$colletion, 'code' => $code]);
    }
    protected function showOne(Model $model,$code=200  ){
        return response()->json(['data'=>$model, 'code' => $code]);
    }

    protected function showMessage($message, $code=200  ){
        return $this->sucess(['data'=>$message],  $code);
    }

    protected function sortData(Collection $colletion){

        if(request()->has('sort_by')){
            $attributes = request()->sort_by;
            $colletion = $colletion->sortBy->$attributes;
        }
        return $colletion;

    }

    protected function paginate(Collection $collection){       

        Validator::make(request()->all(), [
            'per_page' => 'integer|min:2|max:50',
            ]);

        $page= LengthAwarePaginator::resolveCurrentPage();

        $perPage=15;
        if(request()->has('per_page')){
            $perPage = (int) request()->per_page;
        }
        
        $result= $collection->slice(($page - 1) * $perPage, $perPage)->values();

        $paginated = new LengthAwarePaginator($result, $collection->count(),$perPage, $page,[
            'path' =>LengthAwarePaginator::resolveCurrentPage(),
        ]);

        $paginated->appends(request()->all());
        return $paginated;

    }


    protected function cacheResponse($data){        
        $url = request()->url();
        
        Cache::remember($url,30/60, function() use($data){
            return $data;
        });
    }

    // protected function transformData($data, $transformer){
    //     $transformermation = Fractal($data, new $transformer);
    //     return $transformermation->toArray();
    // }

}