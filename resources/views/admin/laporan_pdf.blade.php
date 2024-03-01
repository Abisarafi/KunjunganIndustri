<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Booking Data</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <style>
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            border: 1px solid #dee2e6;
            padding: 8px;
        }
        .table th {
            background-color: #f8f9fa;
            font-weight: bold;
            text-align: center;
        }
        .btn {
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
        }
        .btn-success {
            background-color: #28a745;
            color: #fff;
            border: none;
        }
        .btn-warning {
            background-color: #ffc107;
            color: #212529;
            border: none;
        }
        .btn-danger {
            background-color: #dc3545;
            color: #fff;
            border: none;
        }
    </style>
</head>
<body>
    <div class="container mt-4">        
        <h3 class="alert alert-success">{{ $data }}</h3>
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 10%">ID</th>
                    <th>Instansi</th>
                    <th>Jurusan</th>
                    <th>Jumlah Kelas</th>
                    <th>Tanggal Pengajuan</th>
                    <th>No HP</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->title }}</td>
                    <td>{{ $data->jurusan }}</td>
                    <td>{{ $data->participant_count }}</td>
                    <td>{{ $data->start_date }}</td>
                    <td>{{ $data->user->noHP }}</td>
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
