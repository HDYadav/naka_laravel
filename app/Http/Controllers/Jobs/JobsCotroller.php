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
use App\Models\Model\Job;
use App\Models\Model\Jobposition;
use App\Models\Model\Promote;
use App\Models\Model\SalaryType;
use App\Models\Model\Skill;
use App\Models\Model\State;
use App\Models\Model\WorkPlace;
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
        $promote = Promote::select('id', 'name')->get();
        $workplace = WorkPlace::select('id', 'name')->get();


        $array= ['jobPosition'=> $jobpostiong,
                'state' => $state,
                 'city' => $city, 
                'companyList'=> $companyList, 
                'employeementType'=> $emp_type,
                'skills' => $skills,
                'experience' => $experience,
                'salaryType' => $salaryType,
                'education' => $education,
                'promote' => $promote,
                 'workplace' => $workplace
                ];

        return $this->sucessResponse(null, $array, true, 201);


       

    }


    public function getCity(Request $request)
    { 

        $array = []; 
        $city = City::where('state_id', $request->state_id)->select('id', 'name')->get(); 

        $array = [ 
            'city' => $city
            ];

        return $this->sucessResponse(null, $array, true, 201);
    }

    public function jobCreateOrUpdate(Request $request)
    {
        $jobData = [
            'jobPosiiton' => $request->jobPosiiton,
            'workPlace' => $request->workPlace,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'company' => $request->company,
            'education' => $request->education,
            'employeementType' => $request->employeementType,
            'skills' => $request->skills,
            'totalVacancy' => $request->totalVacancy,
            'deadline' => $request->deadline,
            'minSalary' => $request->minSalary,
            'maxSalary' => $request->maxSalary,
            'salaryType' => $request->salaryType,
            'experience' => $request->experience,
            'promote' => $request->promote, 
            'description' => $request->description
        ];

        // Find the job if it exists, or create a new one
        $job = Job::updateOrCreate(['id' => $request->id], $jobData); 

        return $this->sucessResponse('Job Cretaed Successfully', ['id' => $job->id], true, 201);

        
    }


    public function getAllJobs()
    {

        $array = [];
        $jobs = DB::table('jobs as j')->select('j.id', 'jp.name as jobPosiiton', 'cl.name as company', 'j.minSalary', 'j.maxSalary','st.name as salaryType', 'wp.name as workPlace') 
            ->join('job_positions as jp', 'jp.id', '=', 'j.jobPosiiton')
            ->join('company_lists as cl', 'cl.id', '=', 'j.company')
            ->join('salary_types as st', 'st.id', '=', 'j.salaryType')
            ->join('work_places as wp', 'wp.id', '=', 'j.workPlace')
            ->get(); 
        
       // $array = ['jobPosition'=> $jobs  ];

        return $this->sucessResponse(null, $jobs, true, 201);
    }


    public function getAllJobsDetails($id)
    {
        $jobs = DB::table('jobs as j')
            ->where('j.id', '=', $id)
            ->select(
                'j.id',
                'jp.id as jobPosiitonId',
                'jp.name as jobPosiiton',
                'wp.id as workPlaceId',
                'wp.name as workPlace',
                'j.country',
                'js.id as stateId',
                'js.name as state',
                'jc.id as cityId',
                'jc.name as city',
                'cl.id as companyId',
                'cl.name as company',
                'et.id as employeementTypeId',
                'et.name as employeementType',
                'j.totalVacancy',
                'j.deadline',
                'st.id as salaryTypeId',
                'st.name as salaryType',
                'j.minSalary',
                'j.maxSalary',
                'ex.id as experienceId',
                'ex.name as experience',
                'ed.id as educationId',
                'ed.name as education',
                'pt.id as promoteId',
                'j.skills'
            )
            ->join('job_positions as jp', 'jp.id', '=', 'j.jobPosiiton')
            ->join('company_lists as cl', 'cl.id', '=', 'j.company')
            ->join('salary_types as st', 'st.id', '=', 'j.salaryType')
            ->join('work_places as wp', 'wp.id', '=', 'j.workPlace')
            ->join('job_states as js', 'js.id', '=', 'j.state')
            ->join('job_cities as jc', 'jc.id', '=', 'j.city')
            ->join('employeement_types as et', 'et.id', '=', 'j.employeementType')
            ->join('experiences as ex', 'ex.id', '=', 'j.experience')
            ->join('educations as ed', 'ed.id', '=', 'j.education')
            ->join('promotes as pt', 'pt.id', '=', 'j.promote')
            ->get();

        // Retrieve skills for each job
        foreach ($jobs as $job) {
            $job->skills = $this->getSkills($job->skills);
        }

        return $this->sucessResponse(null, $jobs, true, 201);
    }

    protected function getSkills($skills)
    {
        $skillIds = explode(',', $skills);
        $skills =  Skill::whereIn('id', $skillIds)->get();

        $skill = $skills->makeHidden(['created_at', 'updated_at']);

        return $skill;
    }




}
