@extends('layout.page')

@section('content')
<div class="form">
<div class="row">
    <div class="col-8">
        <h5>Applying for</h5>
        <p>{{ $title }}</p>
    </div>
</div>
<div class="row">
    <hr>
</div>
<div class="row">
        <form method="POST" action="{{ route('submitApplication') }}">
            <div class="row">
                <div class="form-control">
                    <label>Enter applicant name</label>
                    <input type="hidden" name="jobid" value="{{ $jobId }}">
                    <input type="text" name="app_name" required>
                </div>
            </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <a href="javascript:history.back();" class="btn btn-primary btn-lg" role="button">Back</a>
        <input class="btn btn-primary btn-lg" type="submit" value="Submit">
    </div>
</div>
</form>
@endsection