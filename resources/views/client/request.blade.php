@extends('layouts.app1')

@section('content')
    <h1>Request Industrial Visit</h1>
    <!-- Create a form for submitting requests -->
    <form action="{{ route('submit.request') }}" method="POST">
        @csrf
        <label for="purpose">Purpose of Visit:</label>
        <input type="text" name="purpose" id="purpose" required>
        <!-- Add more form fields as needed -->
        <button type="submit">Submit Request</button>
    </form>
@endsection
