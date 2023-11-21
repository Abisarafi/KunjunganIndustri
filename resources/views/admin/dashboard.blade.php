@extends('layouts.app1')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>List All Pengajuan</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">ID</th>
                                    <th>Instansi</th>
                                    <th>Jurusan</th>
                                    <th>Jumlah Kelas</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Status</th>
                                    <th style="width: 40px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bookings as $data)
                                <tr>
                                    <td>1</td>
                                    <td>{{ $data->title }}</td>
                                    <td>{{ $data->jurusan }}</td>
                                    <td>{{ $data->participant_count }}</td>
                                    <td>{{ $data->start_date }}</td>
                                    <td>
                                        @if($data->status == 'accepted')
                                            <button class="btn btn-success">Accepted</button>
                                        @elseif($data->status == 'proccess')
                                            <button class="btn btn-warning">Proccess</button>
                                        @elseif($data->status == 'rejected')
                                            <button class="btn btn-danger">Rejected</button>
                                        @else
                                            <!-- Handle other cases or provide a default -->
                                            <span>{{ $data->status }}</span>
                                        @endif

                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="" class="btn btn-success">Accept</a>
                                            <a href="" class="btn btn-danger">Reject</a>
                                             {{-- <form action="{{ route('admin.calendar.accept') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="booking_id" value="{{ $data->id }}">
                                                <button type="submit" class="btn btn-success">Accept</button>
                                            </form>
                                           <form action="{{ route('admin.calendar.reject') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="booking_id" value="{{ $data->id }}">
                                                <button type="submit" class="btn btn-danger">Reject</button>
                                            </form> --}}
                                        </div>
                                    </td>
                                  </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    
@endsection