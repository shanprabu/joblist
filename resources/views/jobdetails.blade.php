@extends('layout.page')

@section('content')
<div class="row">
    <div class="col-8">
        <h5>Description</h5>
        <p>{{ $jobApplications->description }}</p>
    </div>
    <div class="col-2">
        <h5>Location</h5>
        <p>{{ $jobApplications->location }}</p>
    </div>
    <div class="col-2">
        <h5>Posted On</h5>
        <p>{{ $jobApplications->posted_on }}</p>
    </div>
</div>
<div class="row">
    <hr>
</div>
<div class="row">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Application #</th>
                <th>Applicant</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jobApplications->applications as $application)
            <tr>
                <td>{{ $application->id }}</td>
                <td>{{ $application->applicant->name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="row">
    <div class="col-12">
        <a href="javascript:history.back();" class="btn btn-primary btn-lg" role="button">Back</a>
    </div>
</div>
@endsection