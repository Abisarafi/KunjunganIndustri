<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Export Laporan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-4">
        <a href="{{ route('admin.export') }}" class="btn btn-success mb-4">Export PDF</a>
        <table class="table table-striped">
             <thead>
                <tr>
                    <th style="width: 10px">ID</th>
                    <th>Instansi</th>
                    <th>Jurusan</th>
                    <th>Jumlah Kelas</th>
                    <th>Tanggal Pengajuan</th>
                    <th>No Hp</th>
                    <th>Status</th>
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
                    <td>{{ $data->noHP }}</td>
                    <td>
                        @if($data->status == 'accepted')
                            <button class="btn btn-success">Accepted</button>
                        @elseif($data->status == 'proccess')
                            <button class="btn btn-warning">Proccess</button>
                        @elseif($data->status == 'rejected')
                            <button class="btn btn-danger">Rejected</button>
                        @else
                            <span>{{ $data->status }}</span>
                        @endif

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>