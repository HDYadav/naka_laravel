<?php

namespace App\Http\Controllers\Attributes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Http\Controllers\ApiController;
use App\Helpers\LogBuilder;
use App\Helpers\UserData;
use App\Models\Model\AadharCard;
use App\Models\Model\City;
use App\Models\Model\Education;
use App\Models\Model\EmployeementType;
use App\Models\Model\Experience;
use App\Models\Model\Industry;
use App\Models\Model\IndustryType;
use App\Models\Model\Job;
use App\Models\Model\Jobposition;
use App\Models\Model\PanCard;
use App\Models\Model\Promote;
use App\Models\Model\SalaryType;
use App\Models\Model\Skill;
use App\Models\Model\State;
use App\Models\Model\StaticPage;
use App\Models\Model\WorkPlace;
use Illuminate\Support\Facades\DB;

class AttributesController extends ApiController
{
 

    public function positionAddUpdate(Request $request)
    {
        $user = UserData::getUserFrToken($request);

        $edudata = [
            'name' => $request->name_english ?? '',
            'name_hindi' => $request->name_hindi ?? '',
            'name_marathi' => $request->name_marathi ?? '',
            'name_punjabi' => $request->name_punjabi ?? ''
        ];

        

        // Check if the ID is provided in the request
        if ($request->id) {
            // Update existing record if ID is provided
            $edu = Jobposition::where('id', $request->id)->first();
            if ($edu) {
                $edu->update($edudata);
            } else {
                return $this->errorResponse('Job position not found', [], false, 404);
            }
        } else {
            // Create new record if ID is not provided
            $edu = Jobposition::where('name', $request->name_english)->first();
            if ($edu) {
                return response()->json([
                    'Job position with this name already exists',
                    'data'   =>  $edu,
                ], 201); 


              //  return $this->errorResponse('Job position with this name already exists', [], false, 400);
            } else { 
                $edu = Jobposition::create($edudata);
            }
        }
        // return response()->json([
        //     'data'   =>  $edu,
        // ], 201); 


        return $this->sucessResponse('Job position saved successfully', ['id' => $edu->id], true, 200);
    }


    // public function positionAddUpdate(Request $request)
    // { 
    //     $user = UserData::getUserFrToken($request);

    //     $edudata = [
             
    //         'name' => $request->name_english,
    //         'name_hindi' => $request->name_hindi,
    //         'name_marathi' => $request->name_marathi,
    //         'name_punjabi' => $request->name_punjabi  
    //     ];

    //     $edu = Jobposition::updateOrCreate(['id' => $request->id], $edudata);

    //     return $this->sucessResponse('Education Cretaed Successfully', ['id' => $edu->id], true, 201);
    // }


    public function getJobPosition($id, Request $request){

        return Jobposition::select('id','name','name_hindi', 'name_marathi', 'name_punjabi')->where('id',$id)->first();
        
    }



     public function empTypeAddUpdate(Request $request)
    {
        $user = UserData::getUserFrToken($request);

        $edudata = [
            'name' => $request->name,
            'emptype_hindi' => $request->emptype_hindi,
            'emptype_marathi' => $request->emptype_marathi,
            'emptype_punjabi' => $request->emptype_punjabi
        ];

        // Check if the ID is provided in the request
        if ($request->id) {
            // Update existing record if ID is provided
            $edu = EmployeementType::where('id', $request->id)->first();
            if ($edu) {
                $edu->update($edudata);
            } else {
                return $this->errorResponse('Job position not found', [], false, 404);
            }
        } else {
            // Create new record if ID is not provided
            $edu = EmployeementType::where('name', $request->name_english)->first();
            if ($edu) {
                return $this->errorResponse('Job position with this name already exists', [], false, 400);
            } else {
                $edu = EmployeementType::create($edudata);
            }
        }

        return $this->sucessResponse('Job position saved successfully', ['id' => $edu->id], true, 200);
    }



    public function getEmpType($id, Request $request)
    {

        return EmployeementType::select('id', 'name','emptype_hindi', 'emptype_marathi', 'emptype_punjabi')->where('id', $id)->first();
    }


    public function industryTypeAddUpdate(Request $request)
    {
        $user = UserData::getUserFrToken($request);

        $edudata = [
            'name' => $request->name,
            'ind_type_hindi' => $request->ind_type_hindi,
            'ind_type_marathi' => $request->ind_type_marathi,
            'ind_type_punjabi' => $request->ind_type_punjabi
        ];

        // Check if the ID is provided in the request
        if ($request->id) {
            // Update existing record if ID is provided
            $edu = Industry::where('id', $request->id)->first();
            if ($edu) {
                $edu->update($edudata);
            } else {
                return $this->errorResponse('Records not found', [], false, 404);
            }
        } else {
            // Create new record if ID is not provided
            $edu = Industry::where('name', $request->name)->first();
            if ($edu) {
                return $this->errorResponse('Records with this name already exists', [], false, 400);
            } else {
                $edu = Industry::create($edudata);
            }
        }

        return $this->sucessResponse('Records saved successfully', ['id' => $edu->id], true, 200);
    }



    public function getIndustryType($id, Request $request)
    {

        return Industry::select('id', 'name','ind_type_hindi', 'ind_type_marathi', 'ind_type_punjabi')->where('id', $id)->first();
    }





    public function skillsAddUpdate(Request $request)
    {
        $user = UserData::getUserFrToken($request);

        $edudata = [
            'name' => $request->name,
            'skills_hindi' => $request->skills_hindi,
            'skills_marathi' => $request->skills_marathi,
            'skills_punjabi' => $request->skills_punjabi
        ];

        // Check if the ID is provided in the request
        if ($request->id) {
            // Update existing record if ID is provided
            $edu = Skill::where('id', $request->id)->first();
            if ($edu) {
                $edu->update($edudata);
            } else {
                return $this->errorResponse('Records not found', [], false, 404);
            }
        } else {
            // Create new record if ID is not provided
            $edu = Skill::where('name', $request->name)->first();
            if ($edu) {
                return $this->errorResponse('Records with this name already exists', [], false, 400);
            } else {
                $edu = Skill::create($edudata);
            }
        }

        return $this->sucessResponse('Records saved successfully', ['id' => $edu->id], true, 200);
    }



    public function getSkills($id, Request $request)
    {

        return Skill::select('id', 'name', 'skills_hindi', 'skills_marathi', 'skills_punjabi')->where('id', $id)->first();
    }



    public function experianceAddUpdate(Request $request)
    {
        $user = UserData::getUserFrToken($request);

        $edudata = [
            'name' => $request->name,
            'name_hindi' => $request->name_hindi,
            'name_marathi' => $request->name_marathi,
            'name_punjabi' => $request->name_punjabi
        ];

        // Check if the ID is provided in the request
        if ($request->id) {
            // Update existing record if ID is provided
            $edu = Experience::where('id', $request->id)->first();
            if ($edu) {
                $edu->update($edudata);
            } else {
                return $this->errorResponse('Records not found', [], false, 404);
            }
        } else {
            // Create new record if ID is not provided
            $edu = Experience::where('name', $request->name)->first();
            if ($edu) {
                return $this->errorResponse('Records with this name already exists', [], false, 400);
            } else {
                $edu = Experience::create($edudata);
            }
        }

        return $this->sucessResponse('Records saved successfully', ['id' => $edu->id], true, 200);
    }



    public function getExperiance($id, Request $request)
    {

        return Experience::select('id', 'name','name_hindi', 'name_marathi', 'name_punjabi')->where('id', $id)->first();
    }



    public function educationAddUpdate(Request $request)
    {
        $user = UserData::getUserFrToken($request);

        $edudata = [
            'name' => $request->name,
            'name_hindi' => $request->name_hindi,
            'name_marathi' => $request->name_marathi,
            'name_punjabi' => $request->name_punjabi
        ];

        // Check if the ID is provided in the request
        if ($request->id) {
            // Update existing record if ID is provided
            $edu = Education::where('id', $request->id)->first();
            if ($edu) {
                $edu->update($edudata);
            } else {
                return $this->errorResponse('Records not found', [], false, 404);
            }
        } else {
            // Create new record if ID is not provided
            $edu = Education::where('name', $request->name)->first();
            if ($edu) {
                return $this->errorResponse('Records with this name already exists', [], false, 400);
            } else {
                $edu = Education::create($edudata);
            }
        }

        return $this->sucessResponse('Records saved successfully', ['id' => $edu->id], true, 200);
    }



    public function getEducation($id, Request $request)
    {

        return Education::select('id', 'name', 'name_hindi', 'name_marathi', 'name_punjabi')->where('id', $id)->first();
    }




     public function workplaceAddUpdate(Request $request)
    {
        $user = UserData::getUserFrToken($request);

        $edudata = [
            'name' => $request->name,
            'name_hindi' => $request->name_hindi,
            'name_marathi' => $request->name_marathi,
            'name_punjabi' => $request->name_punjabi
        ];

        // Check if the ID is provided in the request
        if ($request->id) {
            // Update existing record if ID is provided
            $edu = WorkPlace::where('id', $request->id)->first();
            if ($edu) {
                $edu->update($edudata);
            } else {
                return $this->errorResponse('Records not found', [], false, 404);
            }
        } else {
            // Create new record if ID is not provided
            $edu = WorkPlace::where('name', $request->name)->first();
            if ($edu) {
                return $this->errorResponse('Records with this name already exists', [], false, 400);
            } else {
                $edu = WorkPlace::create($edudata);
            }
        }

        return $this->sucessResponse('Records saved successfully', ['id' => $edu->id], true, 200);
    }



    public function getWorkPlace($id, Request $request)
    {

        return WorkPlace::select('id', 'name', 'name_hindi', 'name_marathi', 'name_punjabi')->where('id', $id)->first();
    }





    public function stateAddUpdate(Request $request)
    {
        $user = UserData::getUserFrToken($request);

        $edudata = [
            'name' => $request->name,
            'name_hindi' => $request->name_hindi,
            'name_marathi' => $request->name_marathi,
            'name_punjabi' => $request->name_punjabi
        ];

        // Check if the ID is provided in the request
        if ($request->id) {
            // Update existing record if ID is provided
            $edu = State::where('id', $request->id)->first();
            if ($edu) {
                $edu->update($edudata);
            } else {
                return $this->errorResponse('Records not found', [], false, 404);
            }
        } else {
            // Create new record if ID is not provided
            $edu = State::where('name', $request->name)->first();
            if ($edu) {
                return $this->errorResponse('Records with this name already exists', [], false, 400);
            } else {
                $edu = State::create($edudata);
            }
        }

        return $this->sucessResponse('Records saved successfully', ['id' => $edu->id], true, 200);
    }



    public function getState($id, Request $request)
    {

        return State::select('id', 'name', 'name_hindi', 'name_marathi', 'name_punjabi')->where('id', $id)->first();
    }


    public function cityAddUpdate(Request $request)
    {
        $user = UserData::getUserFrToken($request);

        $edudata = [
            'state_id' => $request->state_id,
            'name' => $request->name,
            'name_hindi' => $request->name_hindi,
            'name_marathi' => $request->name_marathi,
            'name_punjabi' => $request->name_punjabi
        ];

     //   return  $edudata;

        // Check if the ID is provided in the request
        if ($request->id) {
            // Update existing record if ID is provided
            $edu = City::where('id', $request->id)->first();
            if ($edu) {
                $edu->update($edudata);
            } else {
                return $this->errorResponse('Records not found', [], false, 404);
            }
        } else {
            // Create new record if ID is not provided
            $edu = City::where('name', $request->name)->first();
            if ($edu) {
                return $this->errorResponse('Records with this name already exists', [], false, 400);
            } else {
                $edu = City::create($edudata);
            }
        }

        return $this->sucessResponse('Records saved successfully', ['id' => $edu->id], true, 200);
    }



    public function getCity($id, Request $request)
    {

        return City::select('id', 'state_id','name', 'name_hindi', 'name_marathi', 'name_punjabi')->where('id', $id)->first();
    }

    public function getCityList(Request $request)
    {
        return DB::table('job_cities as jc')->select('jc.id', 'jc.state_id', 'jc.name', 'jc.name_hindi', 'jc.name_marathi', 'jc.name_punjabi','js.name as state_name')
        ->leftjoin('job_states as js','js.id','=','jc.state_id')
        ->get();
    }





    public function salaryTypeAddUpdate(Request $request)
    {
        $user = UserData::getUserFrToken($request);

        $edudata = [ 
            'name' => $request->name,
            'name_hindi' => $request->name_hindi,
            'name_marathi' => $request->name_marathi,
            'name_punjabi' => $request->name_punjabi
        ];

        //   return  $edudata;

        // Check if the ID is provided in the request
        if ($request->id) {
            // Update existing record if ID is provided
            $edu = SalaryType::where('id', $request->id)->first();
            if ($edu) {
                $edu->update($edudata);
            } else {
                return $this->errorResponse('Records not found', [], false, 404);
            }
        } else {
            // Create new record if ID is not provided
            $edu = SalaryType::where('name', $request->name)->first();
            if ($edu) {
                return $this->errorResponse('Records with this name already exists', [], false, 400);
            } else {
                $edu = SalaryType::create($edudata);
            }
        }

        return $this->sucessResponse('Records saved successfully', ['id' => $edu->id], true, 200);
    }



    public function getSalaryType($id, Request $request)
    {

        return SalaryType::select('id',  'name', 'name_hindi', 'name_marathi', 'name_punjabi')->where('id', $id)->first();
    }





    public function salaryPromoteAddUpdate(Request $request)
    {
        $user = UserData::getUserFrToken($request);

        $edudata = [
            'name' => $request->name,
            'name_hindi' => $request->name_hindi,
            'name_marathi' => $request->name_marathi,
            'name_punjabi' => $request->name_punjabi
        ];

        //   return  $edudata;

        // Check if the ID is provided in the request
        if ($request->id) {
            // Update existing record if ID is provided
            $edu = Promote::where('id', $request->id)->first();
            if ($edu) {
                $edu->update($edudata);
            } else {
                return $this->errorResponse('Records not found', [], false, 404);
            }
        } else {
            // Create new record if ID is not provided
            $edu = Promote::where('name', $request->name)->first();
            if ($edu) {
                return $this->errorResponse('Records with this name already exists', [], false, 400);
            } else {
                $edu = Promote::create($edudata);
            }
        }

        return $this->sucessResponse('Records saved successfully', ['id' => $edu->id], true, 200);
    }



    public function getPromote($id, Request $request)
    {

        return Promote::select('id',  'name', 'name_hindi', 'name_marathi', 'name_punjabi')->where('id', $id)->first();
    }



    public function deleteState($id)
    {
     
        $state = State::where('id', $id)->delete();
        return response()->json(['message' => 'state permanently deleted'], 200);
 
    }

    public function deletecity($id)
    {

        $state = City::where('id', $id)->delete();
        return response()->json(['message' => 'city permanently deleted'], 200);
    }

    public function deletesalarytype($id)
    {

        $state = SalaryType::where('id', $id)->delete();
        return response()->json(['message' => 'salary type permanently deleted'], 200);
    }


    public function deleteindustrytype($id)
    {

        $state = Industry::where('id', $id)->delete();
        return response()->json(['message' => 'industry permanently deleted'], 200);
    }

    public function deletejob_position($id)
    {

        $state = Jobposition::where('id', $id)->delete();
        return response()->json(['message' => 'industry permanently deleted'], 200);
    }


    public function deleteemp_type($id)
    {

        $state = EmployeementType::where('id', $id)->delete();
        return response()->json(['message' => 'industry permanently deleted'], 200);
    }


    public function deleteskill($id)
    {

        $state = Skill::where('id', $id)->delete();
        return response()->json(['message' => 'industry permanently deleted'], 200);
    }

    public function deleteexperiance($id)
    {

        $state = Experience::where('id', $id)->delete();
        return response()->json(['message' => 'industry permanently deleted'], 200);
    }

    public function deleteeducations($id)
    {

        $state = Education::where('id', $id)->delete();
        return response()->json(['message' => 'industry permanently deleted'], 200);
    }

    public function deleteworkplace($id)
    {

        $state = WorkPlace::where('id', $id)->delete();
        return response()->json(['message' => 'industry permanently deleted'], 200);
    }

    public function deletepromote($id)
    {

        $state = Promote::where('id', $id)->delete();
        return response()->json(['message' => 'industry permanently deleted'], 200);
    }

    public function deletejob($id)
    {

        $state = Job::where('id', $id)->delete();
        return response()->json(['message' => 'job permanently deleted'], 200);
    }


    public function deletePage($id)
    {

        $state = StaticPage::where('id', $id)->delete();
        return response()->json(['message' => 'job permanently deleted'], 200);
    }



    public function pagesAddUpdate(Request $request)
    {
        $user = UserData::getUserFrToken($request); 

        $edudata = [
            'page_name' => $request->page_name,
            'heading' => $request->heading,
            'descriptions' => $request->descriptions 
        ];

        // Check if the ID is provided in the request
        if ($request->id) {
            // Update existing record if ID is provided
            $edu = StaticPage::where('id', $request->id)->first();
            if ($edu) {
                $edu->update($edudata);
            } else {
                return $this->errorResponse('Records not found', [], false, 404);
            }
        } else {
            // Create new record if ID is not provided
            $edu = StaticPage::where('page_name', $request->page_name)->first();
            if ($edu) {
                return $this->errorResponse('Records with this name already exists', [], false, 400);
            } else {
                $edu = StaticPage::create($edudata);
            }
        }

        return $this->sucessResponse('Records saved successfully', ['id' => $edu->id], true, 200);
    }


    public function pagesUpdate($id,Request $request)
    {
        $user = UserData::getUserFrToken($request);

        $edudata = [
            'page_name' => $request->page_name,
            'heading' => $request->heading,
            'descriptions' => $request->descriptions
        ];

        // Check if the ID is provided in the request
        if ($id) {
            // Update existing record if ID is provided
            $edu = StaticPage::where('id', $id)->first();
            if ($edu) {
                $edu->update($edudata);
            } else {
                return $this->errorResponse('Records not found', [], false, 404);
            }
        } else {
            // Create new record if ID is not provided
            $edu = StaticPage::where('page_name', $request->page_name)->first();
            if ($edu) {
                return $this->errorResponse('Records with this name already exists', [], false, 400);
            } else {
                $edu = StaticPage::create($edudata);
            }
        }

        return $this->sucessResponse('Records saved successfully', ['id' => $edu->id], true, 200);
    }




    public function pagesList(Request $request)
    {
        return StaticPage::select('id', 'page_name', 'heading', 'descriptions')->get();
    }



    public function getPage($id, Request $request)
    {

        return StaticPage::select('id', 'page_name', 'heading', 'descriptions')->where('id', $id)->first();
    }



    public function addAadharCard(Request $request)
    {
        $user = UserData::getUserFrToken($request); 
         
        $validatedData = $request->validate([
            'aadharCardNumber' => 'required|digits:12|unique:aadhar_cards,aadharCardNumber',
            'name' => 'required|string|max:255',
            'gender' => 'required|in:male,female,other',
            'dateOfBirth' => 'required|date',
            'photo' => 'required|string', // Assuming photo is a URL or base64 encoded string
            'status' => 'VALID',
        ]);

     
        $validatedData['user_id'] = $user->id;
 
        AadharCard::create($validatedData); 

        return $this->sucessResponse('Aadhar card added successfully', true, 200);

 
    }

    public function getAadharCard(Request $request)
    {
        $user = UserData::getUserFrToken($request);
 

        $data =  AadharCard::select('aadharCardNumber', 'name', 'gender', 'dateOfBirth', 'photo', 'status')->where('user_id', $user->id)->first(); 

        return response()->json([ 
            'data'   =>  $data,
        ], 201); 
    }



    public function addPanCard(Request $request)
    {
        $user = UserData::getUserFrToken($request);

        // Validate the request data
        $validatedData = $request->validate([
            'panCardNumber' => 'required|string|max:10|unique:pan_cards,panCardNumber', // Assuming PAN card number is unique
            'name' => 'required|string|max:255',
          //  'gender' => 'required|in:male,female,other',
            // 'dateOfBirth' => 'required|date', // Uncomment and adjust if dateOfBirth is required
            // 'photo' => 'required|string', // Assuming photo is a URL or base64 encoded string
            'category' => 'required|string',
        ]);

        // Add additional fields not included in validation
        $validatedData['user_id'] = $user->id;
        $validatedData['status'] = 'VALID';

        // Save the PAN card data
        PanCard::create($validatedData); 

        return $this->sucessResponse('PAN card added successfully', true, 200);
    }


    public function getPanCard(Request $request)
    {
        $user = UserData::getUserFrToken($request);
 

        $data =  PanCard::select('panCardNumber', 'name', 'gender', 'category', 'status')->where('user_id', $user->id)->first(); 

        return response()->json([ 
            'data'   =>  $data,
        ], 201); 
    }



    
}
