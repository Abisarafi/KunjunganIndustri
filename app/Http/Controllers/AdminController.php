<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{

    public function index()
    {
        $events = array();
        // $bookings = Booking::all();
        $bookings = Booking::join('users', 'bookings.user_id', '=', 'users.id')
        ->get([
            'bookings.id',
            'bookings.title',
            'bookings.jurusan',
            'bookings.status',
            'bookings.participant_count',
            'bookings.start_date',
            'bookings.end_date',
            'bookings.color',
            'users.noHP'
        ]);
        foreach($bookings as $booking) {

            $color = null;
            if ($booking->status == 'rejected') {
                $color = '#FF3B28';
            }
            if ($booking->status == 'accepted') {
                $color = '#48EB12';
            }

            
            
            $events[] = [
                'id'   => $booking->id,
                'title' => $booking->title,
                'jurusan' => $booking->jurusan,
                'status' => $booking->status,
                'participant_count' => $booking->participant_count,
                'start' => $booking->start_date,
                'end' => $booking->end_date,
                'noHP' => $booking->noHP,
                'color' => $color,
            ];

        }
        return view('admin.index2', ['events' => $events]);
        // return view('admin.calendarPengajuan', ['events' => $events]);
    }

    public function downloadFile($bookingId)
    {
        $booking = Booking::find($bookingId);

        if (!$booking) {
            return response()->json(['error' => 'Booking not found'], 404);
        }

        $filePath = storage_path('app/public/documents/' . $booking->document);

        // Check if the file exists
        if (file_exists($filePath)) {
            return response()->download($filePath, $booking->document_original_name);
        } else {
            return response()->json(['error' => 'File not found'], 404);
        }
    }

  
    public function accept(Request $request)
    {
        $bookingId = $request->input('booking_id');
        $status = 'accepted';
        $color = '#48EB12';

        $booking = Booking::find($bookingId);

        if (!$booking) {
            return response()->json(['error' => 'Booking not found'], 404);
        }

        // Update the status of the accepted booking to 'accepted'
        $booking->status = $status;
        $booking->color = $color;
        $booking->save();

        return response()->json(['status' => $status, 'color' => $color]);
    }
    

    public function reject(Request $request)
    {
        $bookingId = $request->input('booking_id');
        $status = 'rejected'; // You can set the status directly
        $color = '#FF3B28';

        $booking = Booking::find($bookingId);

        if (!$booking) {
            return response()->json(['error' => 'Booking not found'], 404);
        }

        $booking->status = $status;
        $booking->color = $color;
        $booking->save();

        return response()->json(['status' => $status, 'color' => $color]);
    }
}