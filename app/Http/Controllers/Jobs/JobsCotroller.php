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
use App\Models\Model\EducationDetails;
use App\Models\Model\EmployerFavorate;
use App\Models\Model\ExperianceDetails;
use App\Models\Model\Industry;
use App\Models\Model\IndustryType;
use App\Models\Model\JobApplyed;
use App\Models\Model\Language;
use App\Models\Model\Social;
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
        $language = Language::select('id', 'name')->orderBy('id','ASC')->get();
        $industry_type = Industry::select('id', 'name')->orderBy('id', 'ASC')->get();


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
                 'workplace' => $workplace,
                 'languages' => $language,
                'industryType' => $industry_type
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
        $jobs = DB::table('jobs as j')->select('j.id', 'jp.name as jobPosiiton', 'u.company_name as company', 'j.minSalary', 'j.maxSalary','st.name as salaryType', 'wp.name as workPlace', 'et.name as employeementType', 'jc.name as city', 'u.companyLogo') 
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


    public function getAllJobsDetails($id, Request $request)
    {
        $user = UserData::getUserFrToken($request);  

        $jobs = DB::table('jobs as j')           
            ->join('job_positions as jp', 'jp.id', '=', 'j.jobPosiiton')
            ->join('salary_types as st', 'st.id', '=', 'j.salaryType')
            ->join('work_places as wp', 'wp.id', '=', 'j.workPlace')
            ->join('job_states as js', 'js.id', '=', 'j.state')
            ->join('job_cities as jc', 'jc.id', '=', 'j.city')
            ->join('employeement_types as et', 'et.id', '=', 'j.employeementType')
            ->join('experiences as ex', 'ex.id', '=', 'j.experience')
            ->join('educations as ed', 'ed.id', '=', 'j.education')
            ->join('promotes as pt', 'pt.id', '=', 'j.promote')
            ->join('users as u', 'u.id', '=', 'j.company')
            ->leftjoin('applyed_job as aj', 'aj.job_id', '=', 'j.id') // 
            ->where('j.id', '=', $id)
          //  ->where('u.id', '=', $user->id) 
            ->groupBy('j.id')
            ->select(
                'j.id',
                'j.description',
                'j.created_at as crated_date',
                'jp.id as jobPosiitonId',
                'jp.name as jobPosiiton',
                'u.company_size as employe_count',
                'u.about as about_company',
                'u.website',
                'u.email',
                'wp.id as workPlaceId',
                'wp.name as workPlace',
                'j.country',
                'js.id as stateId',
                'js.name as state',
                'jc.id as cityId',
                'jc.name as city',
                'u.id as companyId',
                 'u.company_name as company',
                'u.companyLogo',
                'u.companyBanner',
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


        if ($jobs->isEmpty()) {
            return response()->json([
                'success' => false,
                'data' => [],
            ], 200);
        } else {
            return response()->json([
                'success' => true,
                'data' => $jobs['0'],
            ], 201);
        } 
    }




    public function getEmpJobsDetails($id, Request $request)
    {
        $user = UserData::getUserFrToken($request);

        $jobs = DB::table('jobs as j')
        ->join('job_positions as jp', 'jp.id', '=', 'j.jobPosiiton')
        ->join('salary_types as st', 'st.id', '=', 'j.salaryType')
        ->join('work_places as wp', 'wp.id', '=', 'j.workPlace')
        ->join('job_states as js', 'js.id', '=', 'j.state')
        ->join('job_cities as jc', 'jc.id', '=', 'j.city')
        ->join('employeement_types as et', 'et.id', '=', 'j.employeementType')
        ->join('experiences as ex', 'ex.id', '=', 'j.experience')
        ->join('educations as ed', 'ed.id', '=', 'j.education')
        ->join('promotes as pt', 'pt.id', '=', 'j.promote')
        ->join('users as u', 'u.id', '=', 'j.company')
        ->leftJoin('applyed_job as aj', function ($join) use ($user) {
            $join->on('aj.job_id', '=', 'j.id')
            ->where('aj.user_id', '=', $user->id);
        })
            ->where('j.id', '=', $id)
            ->select(
                'j.id',
                'j.description',
                'j.created_at as crated_date',
                'jp.id as jobPosiitonId',
                'jp.name as jobPosiiton',
                'u.company_size as employe_count',
                'u.about as about_company',
                'u.website',
                'u.email',
                'wp.id as workPlaceId',
                'wp.name as workPlace',
                'j.country',
                'js.id as stateId',
                'js.name as state',
                'jc.id as cityId',
                'jc.name as city',
                'u.id as companyId',
                'u.company_name as company',
                'u.companyLogo',
                'u.companyBanner',
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
                'aj.application_status',
                'j.skills'
            )
            ->get();

        foreach ($jobs as $job) {
            $job->skills = $this->getSkills($job->skills);
        }

        if ($jobs->isEmpty()) {
            return response()->json([
                'success' => false,
                'data' => [],
            ], 404);
        } else {
            return response()->json([
                'success' => true,
                'data' => $jobs['0'],
            ], 200);
        }
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
           // ->join('experiences as ex', 'ex.id', '=', 'j.experience')
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
            'u.company_name as company',
            'jc.name as city',
            'js.name as state',
            'et.name as employeementType',
            'wp.name as workPlace',
            'j.created_at as date',
            'u.companyLogo',
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

            $data = [];

            $jobData = [
                'user_id' => $user->id,
                'job_id' => $request->job_id,
                'isFavourite' => $fav,
            ];

            //dd($jobData);

            $existingRecord = FavorateJob::where('user_id', $user->id)
                                ->where('job_id', $request->job_id)
                                ->first();


            if ($existingRecord) {
                // Delete the existing record

                if($fav == 0){
                $existingRecord->delete();
                    return response()->json(['success' => true, 'message' => 'Record deleted.']);
                }
                

            } else {
                // Insert the new record
                if ($fav == 1) {
                $data =  FavorateJob::create($jobData);
                }
             //   return $this->sucessResponse('Successfully created favorite', $data , true, 201);

               // return response()->json(['success' => true, 'message' => 'Record inserted.']);
            }



            // $data = FavorateJob::updateOrCreate(
            //     ['user_id' => $user->id, 'job_id' => $request->job_id],
            //     $jobData
            // );


         //  $data=  FavorateJob::updateOrCreate(['id' => $request->id], $jobData);  
          
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

        if ($user) {
            $jobsQuery = DB::table('jobs as j')
            ->join('job_positions as jp', 'jp.id', '=', 'j.jobPosiiton')
            ->join('employeement_types as et', 'et.id', '=', 'j.employeementType')
            ->join('job_cities as jc', 'jc.id', '=', 'j.city')
            ->join('job_states as js', 'js.id', '=', 'j.state')
            //->join('experiences as ex', 'ex.id', '=', 'j.experience')
            ->join('users as u', 'u.id', '=', 'j.company')
            ->join('work_places as wp', 'wp.id', '=', 'j.workPlace')
            ->join('favorate_job as fav', 'fav.job_id', '=', 'j.id')
            ->where('fav.user_id', $user->id)
            //->where('j.created_by',$user->id)
           // ->where('fav.isFavourite', 1)
            ->groupBy('j.id')
            ->select(
                'j.id',
                'jp.name as jobPosition',
                'u.company_name as company',
                'jc.name as city',
                'js.name as state',
                'et.name as employeementType',
                'wp.name as workPlace',
                'j.created_at as date',
                'u.companyLogo',
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

        $company = User::where('user_type', '2')->where('otp_verified', '1')->select('id', 'company_name as name')->get();

        $state =  State::select('id', 'name')->get();
        $city = City::select('id', 'name')->get();
        $emp_type =  EmployeementType::select('id', 'name')->get();
        $salaryType = SalaryType::select('id', 'name')->get();
        $promote = Promote::select('id', 'name')->get();
        $experience = Experience::select('id', 'name')->get();
        $job_position = Jobposition::select('id', 'name')->get();
        $education = Education::select('id', 'name')->get();
        $workplace = WorkPlace::select('id', 'name')->get();
        $emp_type = EmployeementType::select('id', 'name')->get(); 
        $skills =  Skill::select('id', 'name')->get();   

         $data = ['company'=> $company, 'promote'=>$promote, 'state' =>$state, 'city' => $city, 'salaryType' =>$salaryType, 'experience' =>$experience, 'job_position' =>$job_position, 'education' =>$education, 'workplace' =>$workplace, 'emp_type' =>$emp_type, 'skills' => $skills];

        return $this->sucessResponse(null, $data, true, 201);
    }




    public function eduCreateOrUpdate(Request $request)
    {


        $currentlyPursuing = ($request->currentlyPursuing) ? 1 : 0; 

        $user = UserData::getUserFrToken($request);

        $edudata = [
            'user_id' => $user->id,    
            'collageName' => $request->collageName,
            'courseName' => $request->courseName,
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
            'currentlyPursuing' => $request->currentlyPursuing 
        ];

         
        $edu = EducationDetails::updateOrCreate(['id' => $request->id], $edudata);

        return $this->sucessResponse('Education Cretaed Successfully', ['id' => $edu->id], true, 201);
    }



    public function getEducations(Request $request)
    {

        $user = UserData::getUserFrToken($request);
        $data = EducationDetails::select('id', 'collageName', 'courseName', 'startDate', 'endDate', 'currentlyPursuing')->where('user_id', $user->id)->get();

        foreach ($data as $edu) {
            $edu->currentlyPursuing = $edu->currentlyPursuing == 1 ? true : false;
        }

        return response()->json([
            'data'   =>
            $data,
        ], 201); 
    }



    public function deleteEducation($id)
    {
        $data = EducationDetails::where('id', $id)->delete();

        return $this->sucessResponse('Education sucessfylly deleted', $data, true, 201);

    }


    

    public function getExp(Request $request)
    {

        $user = UserData::getUserFrToken($request);
        $data = ExperianceDetails::select('id', 'designation', 'company', 'startDate','endDate', 'currentlyWorking')->where('user_id', $user->id)->get();

        foreach ($data as $exp) { 
            $exp->currentlyWorking = $exp->currentlyWorking == 1 ? true : false;
        }

        return response()->json([
            'data'   =>
            $data,
        ], 201); 


       // return $this->sucessResponse(null, $data, true, 201);
    }


    public function expCreateOrUpdate(Request $request)
    {


        $user = UserData::getUserFrToken($request);

         $currentlyWorking = ($request->currentlyWorking) ? 1 : 0;

      //  $experience = ($request->experience) ? 1 : 0;  


        $expData = [           
            'user_id' => $user->id,
            'designation' => $request->designation,
            'company' => $request->company,
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
            "currentlyWorking" => $currentlyWorking 
            
        ]; 

        $exp = ExperianceDetails::updateOrCreate(['id' => $request->id], $expData);

        return $this->sucessResponse('Experiance Cretaed Successfully', ['id' => $exp->id], true, 201);
    }



    public function deleteExp($id)
    {
        $data = ExperianceDetails::where('id', $id)->delete();

        return $this->sucessResponse('Experience sucessfylly deleted', $data, true, 201);
    }



    public function socialCreateOrUpdate(Request $request)
    {
        $user = UserData::getUserFrToken($request);
       // $socialMedia = ($request->socialMedia) ? 1 : 0;  

        $expData = [
            'user_id' => $user->id,
            'socialMediaType' => $request->socialMediaType,
            'link' => $request->link 
        ];
        $exp = Social::updateOrCreate(['id' => $request->id], $expData);

        return $this->sucessResponse('Social Cretaed Successfully', ['id' => $exp->id], true, 201);
    }



    public function getSocial(Request $request)
    {

        $user = UserData::getUserFrToken($request);

        $data = Social::select('id', 'socialMediaType', 'link')->where('user_id',$user->id)->get();

        return $this->sucessResponse(null, $data, true, 201);
    }


    public function deleteSocial($id)
    {
        $data = Social::where('id', $id)->delete();

        return $this->sucessResponse('Experience sucessfylly deleted', $data, true, 201);
    }



    public function applyJob(Request $request)
    {
        try {
            $user = UserData::getUserFrToken($request);

            $apply = ($request->isApplyed) ? 1 : 0;

            $data = [];

            $data = [
                'user_id' => $user->id,
                'job_id' => $request->job_id,
                'isApplyed' => $apply,
                'application_status' => 'Submited'
            ];
 

           // $data =  JobApplyed::create($data);

            $job = JobApplyed::updateOrCreate(
                ['user_id' => $user->id, 'job_id'=> $request->job_id],
                 $data); 


            return response()->json([
            'sucess'   => true,
            'message'   => 'Applied successfully',

        ], 201);


 
            // $lastId = $data->id;
            // $lastInsertedData = DB::table('applyed_job')->where('id', $lastId)->first();
            // $isApplyed = $lastInsertedData->isApplyed == 1 ? true : false;

            // return $this->sucessResponse('Applied successfully', ['id' => $lastId, 'isApplyed' => $isApplyed], true, 201);
        } catch (\Exception $e) { 
            return $this->errorResponse($e->getMessage(), 500); 
        }
    }


    public function getAppliedJob(Request $request){

        $user = UserData::getUserFrToken($request);
 

       $users = DB::table('applyed_job as aj')
                ->join('users as u', 'u.id', '=', 'aj.user_id')
                ->leftJoin('jobs as j', 'j.id', '=', 'aj.job_id')
                ->leftJoin('job_positions as jp', 'jp.id', '=', 'j.jobPosiiton')
                ->leftJoin('employer_favorates as ef', 'ef.job_id', '=', 'j.id')
                ->select('u.id as empoyee_id',  'u.name', 'u.profilePic', 'jp.name as profession', 'ef.isFavourite','aj.job_id')
                 //->where('aj.user_id', $user->id)
                ->where('j.created_by', $user->id)        	
                ->where('aj.job_id', $request->job_id)
                ->get();

                 foreach ($users as $user) { 
                     $user->isFavourite	 = $user->isFavourite	 == 1 ? true : false; 
                  }


        if ($users->isEmpty()) {
            return response()->json([
                    'success' => false,
                    'data' => [],
                ], 200);
        } else {
            return response()->json([
                    'success' => true,
                    'data' => $users,
                ], 201);
        }

     
    }




    public function addEmployerFavourite(Request $request)
    {
        try {
            // Check if all required parameters are present in the request
            $requiredParams = ['user_id', 'job_id', 'isFavourite'];
            foreach ($requiredParams as $param) {
                if (!$request->has($param)) {
                    return response()->json(['success' => false, 'message' => 'Required parameter missing: ' . $param], 400);
                }
            }

            $user = UserData::getUserFrToken($request);
            $fav = $request->isFavourite ? 1 : 0;

            $jobData = [
                'user_id' => $request->user_id,
                'employer_id' => $user->id,
                'job_id' => $request->job_id,
                'isFavourite' => $fav,
            ];

            $existingRecord = EmployerFavorate::where('employer_id', $user->id)
                            ->where('user_id', $request->user_id)
                            ->where('job_id', $request->job_id)
                            ->first();

            if ($existingRecord) {
                // Update existing record if isFavourite changed to 0
                if ($fav == 0) {
                    $existingRecord->delete();
                    return response()->json(['success' => true, 'message' => 'Record deleted.']);
                }
            } else {
                // Insert the new record if isFavourite is 1
                if ($fav == 1) {
                    
                    $data =  EmployerFavorate::create($jobData);
                    $lastId = $data->id;
                    $lastInsertedData = EmployerFavorate::find($lastId);
                    $isFavourite = $lastInsertedData->isFavourite == 1;
                    return response()->json(['success' => true, 'message' => 'Successfully created favorite', 'data' => ['id' => $lastId, 'isFavourite' => $isFavourite]], 201);
                }
            }

            return response()->json(['success' => false, 'message' => 'No action performed.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }



    public function getRecentlyAppliedJob(Request $request)
    {

        $user = UserData::getUserFrToken($request); 

        $users = DB::table('applyed_job as aj')            
            ->leftJoin('jobs as j', 'j.id', '=', 'aj.job_id')
            ->leftJoin('users as u', 'u.id', '=', 'j.created_by')
            ->leftJoin('job_positions as jp', 'jp.id', '=', 'j.jobPosiiton')
            //->leftJoin('employer_favorates as ef', 'ef.job_id', '=', 'j.id')
            ->leftJoin('employer_favorates as ef', 'ef.job_id', '=', 'aj.job_id') 
            ->select('aj.user_id as empoyee_id', 'u.name', 'u.profilePic', 'jp.name as profession', 'ef.isFavourite','j.id as job_id')
              ->where('j.created_by', $user->id)
                ->where('aj.isApplyed', 1)          
                ->get();

            foreach ($users as $user) {
                $user->isFavourite = $user->isFavourite == 1 ? true : false;
            }


        return response()->json([
            'sucess'   => true,
            'data'   => $users,

        ], 201);

        return $users;
    }




    public function jobApplicationStatus(Request $request)
    {
        try {

           $user = UserData::getUserFrToken($request);

        
            $data = [
                'application_status' => $request->status
            ];

            //JobApplyed::where('job_id', $request->job_id, 'user_id', $request->employee_id)->update($data);  
            JobApplyed::where(['job_id' => $request->job_id, 'user_id' => $request->employee_id])->update($data);


            return response()->json([
                'sucess'   => true,
                'message'   => 'Job Application Status has been changed',
                'data' => $user->id,
            ], 201);



           
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }




    public function getJobAppliyedList(Request $request)
    {

        $user = UserData::getUserFrToken($request);
        $users = DB::table('applyed_job as aj') 
        ->leftJoin('jobs as j', 'j.id', '=', 'aj.job_id')
        ->join('users as u', 'u.id', '=', 'aj.user_id')
        ->leftJoin('job_positions as jp', 'jp.id', '=', 'j.jobPosiiton')
        ->leftJoin('employer_favorates as ef', 'ef.job_id', '=', 'j.id')
        ->leftJoin('job_cities as jc', 'jc.id', '=', 'j.city')
        ->leftJoin('job_states as jobstate', 'jobstate.id', '=', 'j.state')
        ->leftJoin('employeement_types as etype', 'etype.id', '=', 'j.employeementType')
        ->leftJoin('work_places as wp', 'wp.id', '=', 'j.workPlace')
        ->select('aj.id', 'u.companyLogo', 'jp.name as jobPosiiton', 'ef.isFavourite', 'u.company_name', 'jc.name as city', 'jobstate.name as state', 'etype.name as employeementType', 'wp.name as workPlace', 'aj.application_status as status', 'aj.created_at as date','u.id as user_id')
       // ->where('aj.user_id', $user->id)
        ->where('j.created_by', $user->id)        
        ->where('aj.isApplyed', 1)
        ->get();

        foreach ($users as $user) {
            $user->isFavourite = $user->isFavourite == 1 ? true : false;
        }

        return response()->json([
            'sucess'   => true,
            'message'   => '',
            'data' => $users

        ], 201); 
 

    }



    public function getFavorateApplyedJob(Request $request)
    {

        $user = UserData::getUserFrToken($request);

       

        $users = DB::table('employer_favorates as ef')                
                ->where('ef.employer_id', $user->id)
               ->leftJoin('jobs as j', 'j.id', '=', 'ef.job_id')
               ->leftJoin('job_positions as jp', 'jp.id', '=', 'j.jobPosiiton')
               ->join('users as u', 'u.id', '=', 'ef.user_id')              
                ->select('u.id as employee_id', 'u.name', 'u.profilePic', 'ef.isFavourite', 'ef.job_id', 'ef.user_id', 'jp.name as profession',)
                ->get();

        foreach ($users as $user) {
            $user->isFavourite     = $user->isFavourite     == 1 ? true : false;
        }


        if ($users->isEmpty()) {
            return response()->json([
                'success' => false,
                'data' => [],
            ], 200);
        } else {
            return response()->json([
                'success' => true,
                'data' => $users,
            ], 201);
        }
    }



    public function getJobAppliyedJobOnStatus(Request $request)
    {
        $user = UserData::getUserFrToken($request);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid user.',
                'data' => []
            ], 401);
        } 

        $usersQuery = DB::table('applyed_job as aj')
        ->leftJoin('jobs as j', 'j.id', '=', 'aj.job_id')
        ->join('users as u', 'u.id', '=', 'j.created_by')
        ->leftJoin('job_positions as jp', 'jp.id', '=', 'j.jobPosiiton')
        ->leftJoin('employer_favorates as ef', 'ef.job_id', '=', 'j.id')
        ->leftJoin('job_cities as jc', 'jc.id', '=', 'j.city')
        ->leftJoin('job_states as jobstate', 'jobstate.id', '=', 'j.state')
        ->leftJoin('employeement_types as etype', 'etype.id', '=', 'j.employeementType')
        ->leftJoin('work_places as wp', 'wp.id', '=', 'j.workPlace')
        ->select(
            'aj.id',
            'u.companyLogo',
            'jp.name as jobPosition',
            'ef.isFavourite',
            'u.company_name',
            'jc.name as city',
            'jobstate.name as state',
            'etype.name as employeementType',
            'wp.name as workPlace',
            'aj.application_status as status',
            'aj.created_at as date',
            'u.id as user_id',
            'j.id as job_id'
        )->where('aj.user_id', $user->id);     

        if ($request->status == 'Active') {
            $usersQuery->whereIn('aj.application_status', ['Submited', 'Shortlisted', 'Interview']);            
         
        } else {
            $usersQuery->where('aj.application_status', $request->status);
        }

        $users = $usersQuery->where('aj.isApplyed', 1)
            ->get();

        foreach ($users as $user) {
            $user->isFavourite = $user->isFavourite == 1;
        }

        return response()->json([
            'success' => true,
            'message' => 'Jobs retrieved successfully.',
            'data' => $users
        ], 200);
    }








}
