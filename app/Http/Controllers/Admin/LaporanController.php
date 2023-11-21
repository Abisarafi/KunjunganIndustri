<?php

namespace App\Http\Controllers\Admin;

use App\Models\Booking;
use PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LaporanController extends Controller
{
    public function index(){
        //menampilkan halaman laporan
        $bookings = Booking::all();
         return view('admin.laporan', [
            'bookings' => $bookings,
            
        ]);
    }

    public function export(){
        //mengambil data dan tampilan dari halaman laporan_pdf
        //data di bawah ini bisa kalian ganti nantinya dengan data dari database
        $bookings = Booking::all();
        $data = PDF::loadview('admin.laporan_pdf', [
            'data' => 'List Seluruh Pengajuan',
            'bookings' => $bookings
        ]);
        //mendownload laporan.pdf
    	return $data->download('laporan.pdf');
    }
}
