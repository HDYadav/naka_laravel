<?php

namespace App\Http\Controllers;

use App\Models\Model\Job;
use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class Dashboard extends ApiController
{


    public function getDashboardCount()
    {
        $jobCount = Job::count();  
        $active = Job::select('id')->where('status', '1')->get()->count();
        $employer = User::select('id')->where('user_type', '1')->get()->count();
        $ActiveEmployer = User::select('id')->where('user_type', '1')->where('status', '1')->get()->count();
        $candidate = User::select('id')->where('user_type', '2')->get()->count();
        $ActiveCandidate = User::select('id')->where('user_type', '2')->where('status', '1')->get()->count(); 


        $collection = collect(['all_jobs' => $jobCount,'active_job'=> $active,'employer'=> $employer,'active_employer'=>$ActiveEmployer, 'candidate' => $candidate, 'active_candidate' => $ActiveCandidate]); 
        return response()->json($collection);
    }

    
    
}
