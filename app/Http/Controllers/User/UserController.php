<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\ApiController;
use App\Helpers\UserData;
use App\Models\Model\Language;
use App\Models\Model\Skill;
use Symfony\Component\HttpFoundation\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Models\Model\EducationDetails; 
use App\Models\Model\ExperianceDetails;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class UserController extends ApiController
{

    public function getUserData(Request $request){
        $user = UserData::getUserFrToken($request);  
        return $user ;
    }


    public function getAllUsers(Request $request)
    {
        $users = User::select('id', 'name', 'email','mobile')->get();
        return response()->json($users);
    }


    public function restore($id)
    {
        $user = User::withTrashed()->find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->restore();

        return response()->json(['message' => 'User restored successfully']);
    }
    

    public function softDelete($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'User soft deleted successfully']);
    }


    public function uploadImage(Request $request)
    {

        $path = self::img_upload($request, $request->image);
        return $this->sucessResponse('Image successfully uploaded', $path, true, 201);
    }

    public function img_upload($request, $imageName = null)
    {
        $extension = $imageName->getClientOriginalName() . '-' . time() . '.' . $imageName->extension();
        $imageName->move('uploads/images/', $extension);
        return URL::to('/uploads/images/')."/".$extension;
    }



    public function updateProfile(Request $request){
        
        $user = UserData::getUserFrToken($request);
        //  $basicProfile = ($request->basicProfile) ? 1 : 0; 

        $basicProfile =  1;  


        $users =  User::where('id', $user->id)
        ->update([
            'profilePic' => $request->profilePic,
            'name' => $request->fullName,
            'dob' => $request->dateOfBirth,
            'gender' => $request->gender,
            'maritalStatus' => $request->maritalStatus,
            'professionId' => $request->professionId,
            'experienced' => $request->experienced,
            'educationId' => $request->educationId,
            'skills' => $request->skills,
            'languages' => $request->languages,
            'basicProfile' => $basicProfile
        ]);


        return response()->json([
           "message" => "Basic profile updated successfully"
        ], 201); 


        // return $users;
    }



    public function getEmployeBasicDetails(Request $request)
    {

        $user = UserData::getUserFrToken($request);

        $users = DB::table('users as u')
        ->select(
            'u.id',
            'u.profilePic',
            'u.name as fullName',
            'u.mobile as mobileNumber',
            'u.email as emailId',
            'u.dob as dateOfBirth',
            'u.gender',
            'u.maritalStatus',
            'u.professionId',
            'jp.name as profession',
            'e.id as experienceId',
            'e.name as experience',
            'edu.id as educationId',
            'edu.name as education',
            'u.skills',
            'u.languages'
        )
        ->leftJoin('job_positions as jp', 'jp.id', '=', 'u.professionId')
        ->leftJoin('experiences as e', 'e.id', '=', 'u.experienced')
        ->leftJoin('educations as edu', 'edu.id', '=', 'u.educationId')
        ->where('u.id', $user->id)
        ->get();

        // Process the skills and languages fields
        $users->transform(function ($user) {
            $user->skills = $this->getSkills($user->skills);
            $user->languages = $this->getLanguages($user->languages);
            return $user;
        }); 

        return response()->json([ 
            'data'   =>  $users['0'],
        ], 201); 
        
    }


    protected function getSkills($skills)
    {
        $skillIds = explode(',', $skills);
        $skills =  Skill::whereIn('id', $skillIds)->select('name','skills_hindi as name_hindi', 'skills_marathi as name_marathi', 'skills_punjabi as name_punjabi')->get();

        $skill = $skills->makeHidden(['created_at', 'updated_at']);

        return json_decode($skills, true);

       // return $skill;
    }


    protected function getLanguages($languages)
    {
        $ids = explode(',', $languages);
        $languages =  Language::whereIn('id', $ids)->get();

        $lag = $languages->makeHidden(['created_at', 'updated_at']);

        return json_decode($lag, true);

       // return $lag;
    }




    public function updateCompanyInfo(Request $request)
    {

        $user = UserData::getUserFrToken($request);
        //$basicProfile = ($request->basicProfile) ? 1 : 0; 

        $companyInfo = 1 ; 


        $users =  User::where('id', $user->id)
            ->update([
                'name' => $request->name,
                'companyLogo' => $request->companyLogo,
                'companyBanner' => $request->companyBanner,
                'company_name' => $request->company_name,
                'company_size' => $request->company_size,
                 "companyInfo" => $companyInfo
                // 'mobile' => $request->mobile,
                // 'email' => $request->email
            ]);


        return response()->json([
            "message" => "Comapny info updated successfully"
        ], 201);


        // return $users;
    }



    public function getCompanyInfo(Request $request)
    {
        $user = UserData::getUserFrToken($request);

        $users = User::select('id', 'name', 'companyLogo', 'companyBanner', 'company_name', 'company_size', 'email', 'mobile')->where('id', $user->id)->get();

        if ($users->count() == 0) {
            $users = "Records not matching";
        }

         return response()->json([
            'sucess'   => true,
            'data'   => $users[0],

        ], 201);

        //return response()->json($users);
    }




    public function updateFoundingInfo(Request $request)
    {

        $user = UserData::getUserFrToken($request);

        $foundingInfo = 1;

        $users =  User::where('id', $user->id)
            ->update([
                'establishmentYear' => $request->establishmentYear,
                'organizationType' => $request->organizationType,
                'industryTypeId' => $request->industryTypeId,
                'website' => $request->website,
                'about' => $request->about,
                 "foundingInfo" => $foundingInfo
            ]);


        return response()->json([
            "message" => "Founding info updated successfully"
        ], 201);


        // return $users;
    }

    public function getFoundingInfo(Request $request)
    {
        $user = UserData::getUserFrToken($request);

        $users = DB::table('users as u')
        ->join('industries as i','i.id','=', 'u.industryTypeId')
        ->select('u.id', 'u.establishmentYear', 'u.organizationType', 'u.industryTypeId', 'i.name as industryType', 'u.website', 'u.company_size', 'about')->where('u.id', $user->id)->get();

        if ($users->count() == 0) {
            $users = "Records not matching";
        }

        return response()->json([
            'sucess'   => true,
            'data'   => $users[0],

        ], 201);
      //  return response()->json($users);
    }


   

    public function getProfileInfo(Request $request)
    {
        $user = UserData::getUserFrToken($request);

        $users = DB::table('users as u')
        ->leftJoin('education_details as ed', 'ed.user_id', '=', 'u.id')
        ->leftJoin('experiance_details as expd', 'expd.user_id', '=', 'u.id')
        ->leftJoin('socials as so', 'so.user_id', '=', 'u.id')
        ->select('u.basicProfile','u.companyInfo','u.foundingInfo', 'u.foundingInfo', 'expd.experience', 'ed.education', 'so.socialMedia')->where('u.id', $user->id)->get();

        foreach ($users as $user) {
            // Convert isFavourite to boolean
            $user->basicProfile = $user->basicProfile == 1 ? true : false;
            $user->companyInfo = $user->companyInfo == 1 ? true : false;
            $user->foundingInfo = $user->foundingInfo == 1 ? true : false;
            $user->experience = $user->experience == 1 ? true : false;
            $user->education = $user->education == 1 ? true : false;
            $user->socialMedia = $user->socialMedia == 1 ? true : false;
        } 


        if ($users->count() == 0) {
            $users = "Records not matching";
        }

        return response()->json([
            'sucess'   => true,
            'data'   => $users[0],

        ], 201);
        //  return response()->json($users);
    }


    public function getUserProfile(Request $request)
    { 

        $users = DB::table('applyed_job as aj')
                ->select(
                'u.id',
                'u.profilePic',
                'u.name as fullName',
                'u.mobile as mobileNumber',
                'u.email as emailId',
                'u.dob as dateOfBirth',
                'u.gender',
                'u.maritalStatus',
                'u.professionId',
                 'aj.job_id', 'aj.user_id','aj.isApplyed', 'aj.application_status', 
                 'jp.name as profession',
                'jp.name_hindi as profession_hindi',
                'jp.name_marathi as profession_marathi',
                'jp.name_punjabi as profession_punjabi',     
                'u.skills',
                'u.languages'
                 )
                ->leftJoin('jobs as j', 'j.id', '=', 'aj.job_id')
                ->leftJoin('users as u', 'u.id', '=', 'aj.user_id')
                ->leftJoin('job_positions as jp', 'jp.id', '=', 'j.jobPosiiton')
                ->where('u.id', $request->user_id)
                ->where('j.id', $request->job_id)
                ->get();
                
                 
        //    return $users;
            

        // Process the skills and languages fields
        $users->transform(function ($user) {
            $user->skills = $this->getSkills($user->skills);
            $user->languages = $this->getLanguages($user->languages);
            $user->experiance = $this->getExp($user->id);
              $user->education = $this->getEdu($user->id);
            return $user;
        });


        if ($users->isEmpty()) {
            return response()->json([
                'data' => false,
                'message' =>'records not found'
            ], 404);
        } else {
            return response()->json([
                'data' => $users['0'],
            ], 201);
        }
    }


    protected function getExp($user_id){
       $expers =  ExperianceDetails::select('id', 'designation', 'company', 'startDate', 'endDate', 'currentlyWorking')->where('user_id', $user_id)->get();

        foreach ($expers as $exp) { 
            $exp->currentlyWorking = $exp->currentlyWorking == 1 ? true : false; 
        } 

    return $expers;

    }

    protected function getEdu($user_id)
    {
        $educations = EducationDetails::select('id', 'collageName', 'courseName', 'startDate', 'endDate', 'currentlyPursuing')->where('user_id', $user_id)->get();

        foreach ($educations as $exp) {
            $exp->currentlyPursuing = $exp->currentlyPursuing == 1 ? true : false;
        }

        return $educations;

    }



    public function getCandidates(Request $request)
    {
       $users = DB::table('users as u')
    ->leftJoin('job_positions as jp', 'jp.id', '=', 'u.professionId')
    ->leftJoin('applyed_job as aj', 'aj.user_id', '=', 'u.id')
    ->select('u.id',
        'u.name','u.email',
            'u.profilePic',
        'jp.name as jobposition',
        DB::raw('COUNT(aj.id) as jobsApplied'),
        DB::raw('CASE WHEN u.status = 1 THEN "activated" ELSE "deactivated" END as status'),
        DB::raw('CASE WHEN u.otp_verified = 1 THEN "activated" ELSE "deactivated" END as otp_verified'), 
        'u.profilePic',
        DB::raw('DATE_FORMAT(u.created_at, "%m-%d-%Y") as created_at')
    )
    ->where('u.user_type', '1')
    ->groupBy('u.id', 'u.name', 'jp.name', 'status', 'u.otp_verified', 'u.profilePic', 'u.created_at')
    ->get();

    return response()->json($users); 


    }


    public function candidateDetails($id, Request $request)
    {
        $users = DB::table('users as u')
                ->leftJoin('job_positions as jp', 'jp.id', '=', 'u.professionId')
                ->leftjoin('experiences as ex', 'ex.id', '=', 'u.experienced')
                 ->leftjoin('educations as ed', 'ed.id', '=', 'u.educationId')
                ->where('u.id', $id) 
                ->select('u.id',
            'u.name as user_name','u.email',
            'jp.name as jobposition',
            'u.profilePic','ex.name as experience','ed.name as education',
            'u.gender',
            'u.maritalStatus',
            'u.dob',
            'u.skills',
            'u.resume',
            'u.languages','u.maritalStatus',
            DB::raw('CASE WHEN u.otp_verified = 1 THEN "activated" ELSE "deactivated" END as otp_verified'),
            DB::raw('CASE WHEN u.status = 1 THEN "activated" ELSE "deactivated" END as status'),
        )->get();

        foreach ($users as $job) {
            $job->skills = $this->getSkills($job->skills);
        }

        foreach ($users as $job) {
            $job->languages = $this->languages($job->languages);
        }

        

        if ($users->isEmpty()) {
            return response()->json([
                'success' => false,
                'data' => [],
            ], 404);
        } else {
            return response()->json([
                'success' => true,
                'data' => $users['0'],
            ], 200);
        }
    }


    protected function getSkillsUser($skills)
    {
        $skillIds = explode(',', $skills);
        $skills =  Skill::whereIn('id', $skillIds)->get();

        $skill = $skills->makeHidden(['created_at', 'updated_at']);

        return $skill;
    }


    protected function languages($laguages)
    {
        $ids = explode(',', $laguages);
        $laguages =  Language::whereIn('id', $ids)->get();

        $lang = $laguages->makeHidden(['created_at', 'updated_at']);

        return $lang;
    }


    private function image_upload($file)
    {

        if ($file->isValid()) {
            $fileName = $file->getClientOriginalName();
            $directory = public_path('uploads/images/' . date('Y/m/d'));
            $relativePath = 'uploads/images/' . date('Y/m/d');

            if (!file_exists($directory)) {
                mkdir($directory, 0777, true);
            }
            if ($file->move($directory, $fileName)) {
                return $relativePath . '/' . $fileName;
            } else {
                throw new \Exception('Error uploading file');
            }
        } else {
            throw new \Exception('Invalid file uploaded');
        }
    }

    public function createOrUpdateCandidate(Request $request)
    {
        // Determine if it's a create or update operation
        $isUpdate = $request->has('id'); 

        // Validate the request
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'mobile' => 'required|string',
           // 'password' => 'required|string',
        ];

        if (!$isUpdate) {
            // For create operation, ensure email and mobile are unique
            $rules['email'] .= '|unique:users';
            $rules['mobile'] .= '|unique:users';
        }

        $validator = Validator::make($request->all(), $rules);

        // If validation fails, return a response with errors
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        // Handle file uploads
        $profilePicture = '';
        if ($request->hasFile('profilePicture')) {
            $profilePicture = $this->image_upload($request->file('profilePicture'));
        }

        $resume = '';
        if ($request->hasFile('resume')) {
            $resume = $this->image_upload($request->file('resume'));
        }

        // Prepare data for create/update
        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => Hash::make($request->password),
            'experienced' => $request->experience,
            'professionId' => $request->jobPosiiton,
            'educationId' => $request->education,
            'skills' => $request->skills,
            'languages' => $request->languages,
            'maritalStatus' => $request->maritalStatus,
            'gender' => $request->gender,
        ];

        if (!empty($profilePicture)) {
            $userData['profilePic'] = $profilePicture;
        }

        if (!empty($resume)) {
            $userData['resume'] = $resume;
        }
 
     

        // Update existing user or create new user
        if ($isUpdate) {
            // Update existing user
            $userData['dob'] = $request->date_of_birth;
            $user = User::findOrFail($request->id);
            $user->update($userData);
        } else {
            // Create new user
            $userData['dob'] = $request->date_of_birth; // Assuming 'dob' is date of birth
            $userData['user_type'] = 1; // Assuming 'user_type' for candidate is 1
            $user = User::create($userData);
        }

        // Hide timestamps
        $user->makeHidden(['updated_at', 'created_at']);

        // Return the user with appropriate status code
        return response()->json($user, $isUpdate ? 200 : 201);
    }



    public function getEditCandidate($user_id)
    {

       
    return  $users = User::where('id', $user_id)->select(
            'name',
            'email',
            'mobile',
            'user_type',
            'otp_verified',
            'dob',
            'company_name',
            'company_size',
            'basicProfile',
            'companyInfo',
            'foundingInfo',
            'password',
            'experienced',
            'professionId',
            'educationId',
            'skills',
            'languages',
            'profilePic',
            'resume',
            'maritalStatus',
            'gender')->first(); 
    }




    public function deleteUser($id)
    {
        try {
            $user = User::withTrashed()->find($id);            

            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }

            if ($user->trashed()) {
                $user->forceDelete(); // Permanently delete if soft deleted
                return response()->json(['message' => 'User permanently deleted'], 200);
            } else {
                $user->forceDelete(); 
             //   $user->delete(); // Soft delete if not already deleted
                return response()->json(['message' => 'User deleted successfully'], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete user: ' . $e->getMessage()], 500);
        }
    }




    public function getEmployer(Request $request)
    {
        $users = DB::table('users as u')
  
        ->leftJoin('jobs as j', 'j.created_by', '=', 'u.id')
        ->select(
            'u.id',
            'u.name',
            'u.email',
            'u.companyLogo',
            'u.status',
            'u.establishmentYear',
            'u.profile_status',
            DB::raw('COUNT(j.id) as activeJob'),
            DB::raw('CASE WHEN u.profile_status = 1 THEN "verified" ELSE "unverified" END as profile_status'),
            DB::raw('CASE WHEN u.status = 1 THEN "activated" ELSE "deactivated" END as status'),
            DB::raw('CASE WHEN u.otp_verified = 1 THEN "verified" ELSE "unverified" END as otp_verified'),
            'u.companyLogo',
            DB::raw('DATE_FORMAT(u.created_at, "%m-%d-%Y") as created_at')
        )
            ->where('u.user_type', '2')
            ->groupBy('u.id', 'u.name', 'u.status', 'u.otp_verified', 'u.companyLogo', 'u.created_at')
            ->get();

        return response()->json($users);
    }


    public function employerDetails($id)
    {
        $users = DB::table('users as u')

        ->leftJoin('jobs as j', 'j.created_by', '=', 'u.id')
        ->leftJoin('industries as i', 'i.id','=','u.industryTypeId')
        ->select(
            'u.id',
            'u.company_name',
            'u.email',
            'u.companyLogo',
            'u.status',
            'u.establishmentYear',
            'u.profile_status',
            'i.name as industry_type',
            'u.company_size as team_size',
            'u.company_size as descriptions',
            DB::raw('COUNT(j.id) as activeJob'),
            DB::raw('CASE WHEN u.profile_status = 1 THEN "verified" ELSE "unverified" END as profile_status'),
            DB::raw('CASE WHEN u.status = 1 THEN "activated" ELSE "deactivated" END as status'),
            DB::raw('CASE WHEN u.otp_verified = 1 THEN "verified" ELSE "unverified" END as otp_verified'),
            'u.companyLogo',
            DB::raw('DATE_FORMAT(u.created_at, "%m-%d-%Y") as created_at')
        )
            ->where('u.user_type', '2') 
            ->groupBy('u.id', 'u.name', 'u.status', 'u.otp_verified', 'u.companyLogo', 'u.created_at')
            ->first();

        return response()->json($users);
    }



}
