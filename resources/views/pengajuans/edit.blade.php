@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Industrial Visit Request</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('visits.update', $visit->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="visit_date">Visit Date</label>
                <input type="date" class="form-control" id="visit_date" name="visit_date" value="{{ old('visit_date', $visit->visit_date) }}" required>
            </div>
            <div class="form-group">
                <label for="company_name">Company Name</label>
                <input type="text" class="form-control" id="company_name" name="company_name" value="{{ old('company_name', $visit->company_name) }}" required>
            </div>
            <div class="form-group">
                <label for="contact_person_name">Contact Person Name</label>
                <input type="text" class="form-control" id="contact_person_name" name="contact_person_name" value="{{ old('contact_person_name', $visit->contact_person_name) }}" required>
            </div>
            <div class="form-group">
                <label for="contact_person_email">Contact Person Email</label>
                <input type="email" class="form-control" id="contact_person_email" name="contact_person_email" value="{{ old('contact_person_email', $visit->contact_person_email) }}" required>
            </div>
            <div class="form-group">
                <label for="purpose">Purpose</label>
                <textarea class="form-control" id="purpose" name="purpose" rows="4" required>{{ old('purpose', $visit->purpose) }}</textarea>
            </div>
            <div class="form-group">
                <label for="class">Class/Group</label>
                <select class="form-control" id="class" name="class" required>
                    <option value="TKJ" {{ old('class', $visit->class) == 'TKJ' ? 'selected' : '' }}>TKJ</option>
                    <option value="SIJA" {{ old('class', $visit->class) == 'SIJA' ? 'selected' : '' }}>SIJA</option>
                    <option value="TJA" {{ old('class', $visit->class) == 'TJA' ? 'selected' : '' }}>TJA</option>
                    <option value="MM" {{ old('class', $visit->class) == 'MM' ? 'selected' : '' }}>MM</option>
                    <option value="RPL" {{ old('class', $visit->class) == 'RPL' ? 'selected' : '' }}>RPL</option>
                    <option value="Broadcasting" {{ old('class', $visit->class) == 'Broadcasting' ? 'selected' : '' }}>Broadcasting</option>
                </select>
            </div>
            <div class="form-group">
                <label for="participant_count">Participant Count</label>
                <input type="number" class="form-control" id="participant_count" name="participant_count" value="{{ old('participant_count', $visit->participant_count) }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
