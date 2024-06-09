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
        $skills =  Skill::whereIn('id', $skillIds)->get();

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

     //   dd($request->user_id);


       // $user = UserData::getUserFrToken($request);

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
            'u.skills',
            'u.languages',
            'ap.job_id'
            )
            ->leftJoin('job_positions as jp', 'jp.id', '=', 'u.professionId')
            ->leftJoin('applyed_job as ap', 'ap.user_id', '=', 'u.id')       
            ->where('u.id', $request->user_id)
            ->get();

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
                'data' => $users[0],
            ], 201);
        }
    }


    protected function getExp($user_id){
       $expers =  ExperianceDetails::select('id', 'designation', 'company', 'startDate', 'endDate', 'currentlyWorking')->where('user_id', $user_id)->get();

        foreach ($expers as $exp) { 
            $exp->basicProfile = $exp->basicProfile == 1 ? true : false; 
        } 

    return $expers;

    }

    protected function getEdu($user_id)
    {
        $educations = EducationDetails::select('id', 'collageName', 'courseName', 'startDate', 'endDate', 'currentlyPursuing', 'education')->where('user_id', $user_id)->get();

        foreach ($educations as $exp) {
            $exp->basicProfile = $exp->basicProfile == 1 ? true : false;
        }

        return $educations;

    }

    
}
