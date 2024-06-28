<?php

namespace App\Repository;

use App\Contracts\UserRepositoryInterface;
use App\Models\User; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Auth;
use App\Models\UserDetail;
use Illuminate\Support\Str;

class SignupRepository implements UserRepositoryInterface
{ 


    private static $role_id = 7;  // role id 7 is for memeber 

    public function create($request)
    {
        $user =  User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'dob' => $request->date_of_birth,
            'user_type' => 1,
            'password' => Hash::make($request->password) 
        ]);
        $user->makeHidden(['updated_at', 'created_at']);

        return $user;
    }
 


    public function employerCreate($request)
    {

        //dd($request);
        $user =  User::create([
            'name' => $request->name,
            'company_name' => $request->company_name,
            'company_size' => $request->company_size,
            'mobile' => $request->mobile,
            'email' => $request->email,          
            'user_type' => '2',
            'password' => Hash::make($request->password) 

        ]);

        $user->makeHidden(['updated_at', 'created_at']);

        return $user;
 
    }



    public function employerCreateAdmin($request)
    {

        

        $companyLogo = '';
        if ($request->hasFile('companyLogo')) {
            $companyLogo = $this->image_upload($request->file('companyLogo'));
        }


        $user =  User::create([
            'name' => $request->name,
            'company_name' => $request->company_name,
            'email' => $request->email,
            'mobile' => $request->mobile,  
            'company_size' => $request->company_size,           
            'organizationType' => $request->organizationType,
            'industryTypeId' => $request->industryTypeId, 
            'website' => $request->website,
            'establishmentYear' => $request->establishmentYear,
            'companyLogo' => $companyLogo,
            'about' => $request->about,                      
            'user_type' => '2',
            'password' => Hash::make($request->password)

        ]);

        $user->makeHidden(['updated_at', 'created_at']);

        return $user;
    }


    public function employerUpdateAdmin($id, Request $request)
    { 
        // Validate the incoming request data
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $id,
            'mobile' => 'required|unique:users,mobile,' . $id,
            // 'name' => 'required|string|max:255',
            // 'company_name' => 'required|string|max:255',
            // 'company_size' => 'required|string|max:255',
            // 'organizationType' => 'required|string|max:255',
            // 'industryTypeId' => 'required|integer',
            // 'website' => 'required|url|max:255',
            // 'establishmentYear' => 'required|integer',
            // 'about' => 'required|string|max:500',
            // 'password' => 'nullable|string|min:6|confirmed',
            // 'companyLogo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        // Find the existing user record by $id
        $user = User::findOrFail($id);

        // Handle the optional file upload
        if ($request->hasFile('companyLogo')) {
            $companyLogo = $this->image_upload($request->file('companyLogo'));
            $user->companyLogo = $companyLogo;
        }

        // Update the user record with new data from $request
        $user->name = $request->name;
        $user->company_name = $request->company_name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->company_size = $request->company_size;
        $user->organizationType = $request->organizationType;
        $user->industryTypeId = $request->industryTypeId;
        $user->website = $request->website;
        $user->establishmentYear = $request->establishmentYear;
        $user->about = $request->about;
        $user->user_type = '2'; // Assuming user_type should always be '2' for employers

        // Update the password only if a new password is provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Save the updated user record
        $user->save();

        // Optionally hide updated_at and created_at if necessary
        $user->makeHidden(['updated_at', 'created_at']);

        return response()->json([
            'success' => true,
            'message' => 'Employer updated successfully',
            'data' => $user
        ], 200);
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

     
}
