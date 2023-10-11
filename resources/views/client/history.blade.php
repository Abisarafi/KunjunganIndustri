@extends('layouts.app1')

@section('content')
    <h1>Request History</h1>
    <!-- Display the list of past requests here -->
    <ul>
        @foreach ($requests as $request)
            <li>{{ $request->purpose }} ({{ $request->status }})</li>
        @endforeach
    </ul>
@endsection
