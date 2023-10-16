@extends('layouts.app')

@section('content')
    <h1>Client Requests</h1>
    @if(count($requests) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Instansi</th>
                    <th>Kelas</th>
                    <th>Jumlah kelas</th>
                    <th>Requested Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($requests as $request)
                    <tr>
                        <td>{{ $request->company_name }}</td>
                        <td>{{ $request->class }}</td>
                        <td>{{ $request->participant_count }}</td>
                        <td>{{ $request->visit_date }}</td>
                        <td>
                            <a href="{{ route('admin.requests.show', $request->id) }}" class="btn btn-primary">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No pending requests.</p>
    @endif
@endsection
