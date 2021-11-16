@extends('layout.page')

@section('content')
<table class="table table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Job Title</th>
            <th>Location</th>
            <th>Posted On</th>
            <th colspan="2">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($joblist as $job)
    <tr>
        <td>{{ $job->id }}</td>
        <td>{{ $job->name }}</td>
        <td>{{ $job->location }}</td>
        <td>{{ $job->posted_on }}</td>
        <td><a href="{{ route('viewjob',['id'=>$job->id]) }}">View applications</a></td>
        <td><a href="{{ route('submitApplication',['id'=>$job->id]) }}">Apply</a></td>
    </tr>
    @endforeach
    </tbody>
</table>
<div class="row">
    <div class="d-flex justify-content-center">{!! $joblist->links() !!}</div>
</div>
@endsection
