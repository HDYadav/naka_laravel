<?php

namespace App\Repository;
use Illuminate\Validation\Rule;
use App\Contracts\UserRepositoryInterface;
use App\Models\User; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

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



    public function employerUpdateAdmin($request)
    { 
     
        
        $user = User::findOrFail($request->id);  
        $request->validate([
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($request->id),
            ],
            'mobile' => [
                'required',
                Rule::unique('users')->ignore($request->id),
            ],
            // Other validation rules...
        ]);

        // Handle the optional file upload
        $companyLogo = $user->companyLogo; // Retain the existing companyLogo
        if ($request->hasFile('companyLogo')) {
            $companyLogo = $this->image_upload($request->file('companyLogo'));
        }

        


        // Prepare the user data for updating
        $userData = [
            'name' => $request->name,
            'company_name' => $request->company_name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'company_size' => $request->company_size,
            'organizationType' => $request->organizationType,
            'industryTypeId' => $request->industryTypeId,
            'website' => $request->website,
            'establishmentYear' => $request->establishmentYear,
            'about' => $request->about,
            'user_type' => '2', // Assuming user_type should always be '2' for employers
            'companyLogo' => $companyLogo,
        ];

        // Update the password only if a new password is provided
        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

      

       

      $res =   User::updateOrCreate(['id' => $request->id], $userData);

        

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
                //  return $relativePath . '/' . $fileName;
                return URL::to($relativePath) . "/" . $fileName;
            } else {
                throw new \Exception('Error uploading file');
            }
        } else {
            throw new \Exception('Invalid file uploaded');
        }
    }

     
}
