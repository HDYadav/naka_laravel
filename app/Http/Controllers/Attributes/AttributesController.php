<?php

namespace App\Http\Controllers\Attributes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Http\Controllers\ApiController;
use App\Helpers\LogBuilder;
use App\Helpers\UserData;
use App\Models\Model\Education;
use App\Models\Model\EmployeementType;
use App\Models\Model\Experience;
use App\Models\Model\Industry;
use App\Models\Model\IndustryType;
use App\Models\Model\Jobposition;
use App\Models\Model\Skill;
use App\Models\Model\WorkPlace;

class AttributesController extends ApiController
{



    public function positionAddUpdate(Request $request)
    {
        $user = UserData::getUserFrToken($request);

        $edudata = [
            'name' => $request->name_english,
            'name_hindi' => $request->name_hindi,
            'name_marathi' => $request->name_marathi,
            'name_punjabi' => $request->name_punjabi
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
                return $this->errorResponse('Job position with this name already exists', [], false, 400);
            } else {
                $edu = Jobposition::create($edudata);
            }
        }

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


    


    
}
