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
            'languages' => $request->languages
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

        $users =  User::where('id', $user->id)
            ->update([
                'name' => $request->name,
                'companyLogo' => $request->companyLogo,
                'companyBanner' => $request->companyBanner,
                'company_name' => $request->company_name,
                'company_size' => $request->company_size,
                'mobile' => $request->mobile,
                'email' => $request->email
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

        return response()->json($users);
    }




    public function updateFoundingInfo(Request $request)
    {

        $user = UserData::getUserFrToken($request);

        $users =  User::where('id', $user->id)
            ->update([
                'establishmentYear' => $request->establishmentYear,
                'organizationType' => $request->organizationType,
                'industryTypeId' => $request->industryTypeId,
                'website' => $request->website,
                'about' => $request->about 
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

        return response()->json($users);
    }
    
}
