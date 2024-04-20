<?php

namespace App\Http\Controllers\Jobs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\ApiController;
use App\Helpers\LogBuilder;
use App\Models\Model\City;
use App\Models\Model\CompanyList;
use App\Models\Model\Education;
use App\Models\Model\EmployeementType;
use App\Models\Model\Experience;
use App\Models\Model\Jobposition;
use App\Models\Model\SalaryType;
use App\Models\Model\Skill;
use App\Models\Model\State;
use EmptyIterator;
use Illuminate\Database\QueryException as DatabaseQueryException;
use League\Config\Exception\ValidationException;
use Illuminate\Support\Facades\DB;


class JobsCotroller extends ApiController
{
    public function getAll(Request $request){

 //  dd($request->state_id);

        $array = [];
        $jobpostiong =  Jobposition::select('id','name')->get();
        $state =  State::select('id', 'name')->get();
        $city = City::where('state_id', $request->state_id)->select('id', 'name')->get();


        $companyList =  CompanyList::select('id', 'name')->get();
        $emp_type =  EmployeementType::select('id', 'name')->get();
        $skills =  Skill::select('id', 'name')->get();
        $experience = Experience::select('id', 'name')->get();
        $salaryType = SalaryType::select('id', 'name')->get();
        $education = Education::select('id', 'name')->get();


        $array= ['jobPosition'=> $jobpostiong,
                'state' => $state,
                 'city' => $city, 
                'companyList'=> $companyList, 
                'employeementType'=> $emp_type,
                'skills' => $skills,
                'experience' => $experience,
                'salaryType' => $salaryType,
                'education' => $education
                ];

        return $this->sucessResponse(null, $array, true, 201);


       

    }
}
