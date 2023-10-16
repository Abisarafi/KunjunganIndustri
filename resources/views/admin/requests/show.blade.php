@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Request Details</h1>
        <h3>Company: {{ $request->company_name }}</h3>
        <p>Class: {{ $request->class }}</p>
        <p>Class count: {{ $request->class_count }}</p>
        <p>Requested Date: {{ $request->visit_date }}</p>
        <p>Additional Details: {{ $request->additional_details }}</p>

        <form method="POST" action="{{ route('admin.requests.accept') }}">
            @csrf
            <input type="hidden" name="request_id" value="{{ $request->id }}">
            <button type="submit" class="btn btn-success">Accept Request</button>
        </form>

        <form method="POST" action="{{ route('admin.requests.reject') }}">
            @csrf
            <input type="hidden" name="request_id" value="{{ $request->id }}">
            <button type="submit" class="btn btn-danger">Reject Request</button>
        </form>
    </div>
@endsection
