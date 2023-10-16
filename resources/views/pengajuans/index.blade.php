@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Industrial Visit Requests</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Company Name</th>
                    <th>Visit Date</th>
                    <th>Class</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php $rowNumber = 1 @endphp
                @foreach ($visits as $visit)
                    <tr>
                        <td>{{ $rowNumber++ }}</td>
                        <td>{{ $visit->company_name }}</td>
                        <td>{{ $visit->visit_date }}</td>
                        <td>{{ $visit->class }}</td>
                        <td>{{ $visit->status }}</td>
                        <td>
                            <a href="{{ route('visits.edit', $visit->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('visits.destroy', $visit->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this visit request?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('visits.create') }}" class="btn btn-success">Create New Visit Request</a>
    </div>
@endsection
