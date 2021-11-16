<?php

namespace App\Console\Commands;

use App\Models\Applicant;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\Location;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class ImportJobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'importcsv:jobs {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Jobs, Applicants and Applications from CSV.';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $fileName = $this->argument('file');
        $this->line("Opening file " . $fileName);
        if(file_exists($fileName)) {
            $file = fopen($fileName,"r");
            $row = fgetcsv($file); //Ignore CSV header
            $csvHeader = [
                'job_title',
                'job_description',
                'date',
                'applicants'
            ];
            $this->line('Starting import');
            while(($row = fgetcsv($file)) != FALSE) {
                $data = array_combine($csvHeader, $row);
                $mainValidator = Validator::make($data,[
                    'job_title' => 'required|max:100',
                    'job_description' => 'required|max:500',
                    'date' => 'required|date_format:d/m/Y',
                    'applicants' => 'required'
                ]);
                if($mainValidator->fails()) {
                    $this->line('Invalid data encountered. Continuing with next record');
                    continue;
                }

                $job = $this->saveJob([
                    'name' => $data['job_title'],
                    'description' => $data['job_description'],
                    'location' => $this->getLocationFromString($data['job_description']),
                    'posted_on' => Carbon::createFromFormat('d/m/Y',$data['date'])->toDateString()
                ]);

                foreach(explode(',', $data['applicants']) as $applicantData)
                {
                    $applicant = $this->saveApplicant([
                        'name' => trim($applicantData)
                    ]);
                    
                    $jobApplicationData = [
                        'job_id' => $job->id,
                        'applicant_id' => $applicant->id,
                    ];

                    $jobApplication = $this->saveApplication($jobApplicationData);
                    if(isset($jobApplication)) {
                        $this->line("Job application added");
                    }
                }
            }
            $this->line('Finished import');
        }
        else  {
            $this->line('Unable to open file');
        }
    }

    private function saveJob(array $data) : Job
    {
        return Job::firstOrCreate($data);
    }

    private function saveApplicant(array $data) : Applicant
    {
        return Applicant::firstOrCreate($data);
    }

    private function saveApplication(array $data) : JobApplication
    {
        return JobApplication::firstOrCreate($data);
    }

    private function getLocationFromString(string $data)
    {
        $location = Location::select('name')->whereRaw('instr(?,name)', $data)->first();
        if(isset($location)) {
            return $location->name;
        }
        else {
            return null;
        }
    }
}