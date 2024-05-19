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
use App\Helpers\UserData;
use App\Models\FavorateJob;
use App\Models\User;

class JobsCotroller extends ApiController
{
    public function getAll(Request $request){ 
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




    public function empFilter(Request $request)
    {
        $array = [];

        $state =  State::select('id', 'name')->get();
      //  $city = City::where('state_id', $request->state_id)->select('id', 'name')->get();
        $emp_type =  EmployeementType::select('id', 'name')->get();
        $experience = Experience::select('id', 'name')->get();
        $workplace = WorkPlace::select('id', 'name')->get();

        // $companyList =  CompanyList::select('id', 'name')->get();
        //   $jobpostiong =  Jobposition::select('id', 'name')->get();
        //  $skills =  Skill::select('id', 'name')->get();       
        // $salaryType = SalaryType::select('id', 'name')->get();
        // $education = Education::select('id', 'name')->get();
        // $promote = Promote::select('id', 'name')->get();

        $city= $this->getAllCities();

        $array = [
            'employeementType' => $emp_type,
            'jobLocation' => $city,
            'experience' => $experience,
            'workplace' => $workplace, 
        ];

        return $this->sucessResponse(null, $array, true, 201);
    }


    protected function getAllCities()
    {
         
        $cities =  City::select('id','name as cityName')->get();

       // $skill = $skills->makeHidden(['created_at', 'updated_at']);

        return $cities;
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
      // dd($request);
        $skills = str_replace(['[', ']'], '', $request->skills);
        $user = UserData::getUserFrToken($request); 
       
       
        $jobData = [
            'jobPosiiton' => $request->jobPosiiton,
            'workPlace' => $request->workPlace,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'company' => $request->company,
            'education' => $request->education,
            'employeementType' => $request->employeementType,
            'skills' => $skills,
            'totalVacancy' => $request->totalVacancy,
            'deadline' => $request->deadline,
            'minSalary' => $request->minSalary,
            'maxSalary' => $request->maxSalary,
            'salaryType' => $request->salaryType,
            'experience' => $request->experience,
            'promote' => $request->promote, 
            'description' => $request->description,
            'created_by' =>  $user->id
        ];

        // Find the job if it exists, or create a new one
        $job = Job::updateOrCreate(['id' => $request->id], $jobData); 

        return $this->sucessResponse('Job Cretaed Successfully', ['id' => $job->id], true, 201);

        
    }


    public function getAllJobs(Request $request)
    {
        $user = UserData::getUserFrToken($request);  
      //  dd($user->id);
        $jobs = DB::table('jobs as j')->select('j.id', 'jp.name as jobPosiiton', 'u.name as company', 'j.minSalary', 'j.maxSalary','st.name as salaryType', 'wp.name as workPlace', 'et.name as employeementType', 'jc.name as city') 
            ->join('job_positions as jp', 'jp.id', '=', 'j.jobPosiiton')
            ->join('users as u', 'u.id', '=', 'j.company')
           // ->join('company_lists as cl', 'cl.id', '=', 'j.company')
            ->join('salary_types as st', 'st.id', '=', 'j.salaryType')
            ->join('work_places as wp', 'wp.id', '=', 'j.workPlace')
            ->join('employeement_types as et', 'et.id', '=', 'j.employeementType')
            ->join('job_cities as jc', 'jc.id', '=', 'j.city')
            ->where('j.created_by', $user->id)
            ->get(); 

         return $this->sucessResponse(null, $jobs, true, 201); 

    }


    public function getAllJobsDetails($id)
    {
        $jobs = DB::table('jobs as j')           
            ->join('job_positions as jp', 'jp.id', '=', 'j.jobPosiiton')
            // ->join('company_lists as cl', 'cl.id', '=', 'j.company')
           // ->join('users as u', 'u.id', '=', 'j.company')
            ->join('salary_types as st', 'st.id', '=', 'j.salaryType')
            ->join('work_places as wp', 'wp.id', '=', 'j.workPlace')
            ->join('job_states as js', 'js.id', '=', 'j.state')
            ->join('job_cities as jc', 'jc.id', '=', 'j.city')
            ->join('employeement_types as et', 'et.id', '=', 'j.employeementType')
            ->join('experiences as ex', 'ex.id', '=', 'j.experience')
            ->join('educations as ed', 'ed.id', '=', 'j.education')
            ->join('promotes as pt', 'pt.id', '=', 'j.promote')
            ->join('users as u', 'u.id', '=', 'j.created_by')
            ->where('j.id', '=', $id)
            ->select(
                'j.id',
                'j.description',
                'j.created_at as crated_date',
                'jp.id as jobPosiitonId',
                'jp.name as jobPosiiton',
                'u.company_size as employe_count',
                'u.about as about_company',
                'u.email',
                'wp.id as workPlaceId',
                'wp.name as workPlace',
                'j.country',
                'js.id as stateId',
                'js.name as state',
                'jc.id as cityId',
                'jc.name as city',
                'u.id as companyId',
                'u.name as company',
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
            ->get();  
         
         
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



    public function jobOpenings(Request $request)
    {
 
        $jobsQuery = DB::table('jobs as j')
            ->groupBy('j.id')
            ->join('job_positions as jp', 'jp.id', '=', 'j.jobPosiiton')
            ->join('employeement_types as et', 'et.id', '=', 'j.employeementType')
            ->join('job_cities as jc', 'jc.id', '=', 'j.city')
            ->join('job_states as js', 'js.id', '=', 'j.state')
            ->join('experiences as ex', 'ex.id', '=', 'j.experience')
            ->join('users as u', 'u.id', '=', 'j.company')
            ->join('work_places as wp', 'wp.id', '=', 'j.workPlace')
            ->leftjoin('favorate_job as fav', 'fav.job_id', '=', 'j.id');
 
        if (!empty($request->search) ) {
            $searchTerm = '%' . $request->search . '%';
            $jobsQuery->where('jp.name', 'like',
                $searchTerm
            );
        }


        if (!empty($request->datePosted) && is_string($request->datePosted)) {
            $currentDate = now();
            if ($request->datePosted === 'Past 24 Hour') {
                $jobsQuery->where('j.created_at', '>=', $currentDate->subDay());
            } elseif ($request->datePosted === 'Past Week') {
                $jobsQuery->where('j.created_at', '>=', $currentDate->subWeek());
            } elseif ($request->datePosted === 'Past Month') {
                $jobsQuery->where('j.created_at', '>=', $currentDate->subMonth());
            }
        }



        // Check if sortBy parameter exists and is a string
        if (!empty($request->sortBy) && is_string($request->sortBy)) {
            if ($request->sortBy === 'Most Recent') {
                // Add logic to sort by most recent
                $jobsQuery->orderBy('j.created_at', 'desc');
            } elseif ($request->sortBy === 'Most Relevant') {
                // Add logic to sort by most relevant
                // You may adjust this according to your relevance criteria
                // For example, you might order by a relevance score
                // $jobsQuery->orderBy('relevance_score', 'desc');
                // Or by a rank based on relevance algorithms
                // $jobsQuery->orderBy('relevance_rank', 'desc');
            }
        }

        if (!empty($request->employmentType) && is_array($request->employmentType)) {
            $jobsQuery->whereIn('j.employeementType', $request->employmentType);
        }

        if (!empty($request->jobLocation) && is_array($request->jobLocation)) {
            $jobsQuery->whereIn('j.city', $request->jobLocation);
        }

        if (!empty($request->experience) && is_array($request->experience)) {
            $jobsQuery->whereIn('j.experience', $request->experience);
        }


        $jobs = $jobsQuery->select(
            'j.id',
            'jp.name as jobPosition',
            'u.name as company',
            'jc.name as city',
            'js.name as state',
            'et.name as employeementType',
            'wp.name as workPlace',
            'j.created_at as date',
            'fav.isFavourite' // Include the isFavourite field
        )->get();

        foreach ($jobs as $job) {
            // Convert isFavourite to boolean
            $job->isFavourite = $job->isFavourite == 1 ? true : false;
        }
             

        return $this->sucessResponse(null, $jobs, true, 201);
    }




    public function addFavourite(Request $request)
    {
        try {
            $user = UserData::getUserFrToken($request);
            $fav = ($request->isFavourite) ? 1 : 0; 
       

            $jobData = [
                'user_id' => $user->id,
                'job_id' => $request->job_id,
                'isFavourite' => $fav,
            ]; 

           $data=  FavorateJob::updateOrCreate(['id' => $request->id], $jobData);  
          
            $lastId = $data->id;
            $lastInsertedData = DB::table('favorate_job')->where('id', $lastId)->first();
            $isFavourite = $lastInsertedData->isFavourite == 1 ? true : false;

            return $this->sucessResponse('Successfully created favorite', ['id' => $lastId, 'isFavourite' => $isFavourite], true, 201);
        } catch (\Exception $e) {
           // dd($e->getMessage());

            return $this->errorResponse($e->getMessage(), 500);

           // return $this->errorResponse($e->getMessage(), [], 500); // Handle the error gracefully
        }


    }




    public function getFavourite(Request $request)
    {
        $user = UserData::getUserFrToken($request); 
        
//dd($user->id);

        if ($user) {
            $jobsQuery = DB::table('jobs as j')
            ->join('job_positions as jp', 'jp.id', '=', 'j.jobPosiiton')
            ->join('employeement_types as et', 'et.id', '=', 'j.employeementType')
            ->join('job_cities as jc', 'jc.id', '=', 'j.city')
            ->join('job_states as js', 'js.id', '=', 'j.state')
            ->join('experiences as ex', 'ex.id', '=', 'j.experience')
            ->join('users as u', 'u.id', '=', 'j.company')
            ->join('work_places as wp', 'wp.id', '=', 'j.workPlace')
            ->join('favorate_job as fav', 'fav.job_id', '=', 'j.id') 
            ->where('j.created_by',$user->id)
            //->where('fav.isFavourite', $user->id)
            ->groupBy('j.id')
            ->select(
                'j.id',
                'jp.name as jobPosition',
                'u.name as company',
                'jc.name as city',
                'js.name as state',
                'et.name as employeementType',
                'wp.name as workPlace',
                'j.created_at as date',
                'fav.isFavourite'                
            )
            ->get();

            foreach ($jobsQuery as $job) {
                // Convert isFavourite to boolean
                $job->isFavourite = $job->isFavourite == 1 ? true : false;
            } 


            return $this->sucessResponse(null, $jobsQuery, true, 201);
        } else {
            // Handle case when user is not found
            return $this->errorResponse("User not found", [], false, 404);
        }

    }

    public function getCompany(Request $request)
    {

         
        $data = User::where('user_type', '2')->where('otp_verified', '1')->select('id', 'name')->get();  
        return $this->sucessResponse(null, $data, true, 201);
    }



}
