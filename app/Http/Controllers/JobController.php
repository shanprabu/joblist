<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function homePage()
    {
        $data['title'] = 'Job List';
        $data['joblist'] = Job::simplePaginate(20);
        return view('joblist', $data);
    }

    public function viewJob(int $id)
    {
        $jobInfo = Job::find($id);
        $data['title'] = "Job details for " . $jobInfo->name;
        $data['jobApplications'] = Job::where('id', $id)->with('applications.applicant')->first();
        //dd($data);
        return view('jobdetails', $data);
    }

    public function applyJob(int $id)
    {
        $jobInfo = Job::find($id);
        $data['title'] = "Applying for " . $jobInfo->name;
        $data['jobId'] = $jobInfo->id;
        //$data['jobApplications'] = Job::where('id', $id)->with('applications.applicant')->first();
        return view('jobapply', $data);
    }

    public function submitApplication(Request $request)
    {
        
        $applicant = Applicant::firstOrCreate(['name'=>$request->app_name]);
        $application = JobApplication::firstOrCreate([
            'job_id' => $request->jobid,
            'applicant_id' => $applicant->id,
        ]);
        return redirect()->route('home');
    }
}
