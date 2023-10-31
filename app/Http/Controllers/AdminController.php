<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;
use App\Models\Booking;

class AdminController extends Controller
{
    // Display a list of client requests
    // public function index()
    // {
    //     $requests = Pengajuan::where('status', 'processed')->get(); // Retrieve processed requests
    //     return view('admin.requests.index', compact('requests'));
    // }
    public function index()
    {
        $events = array();
        $bookings = Booking::all();
        foreach($bookings as $booking) {
            $color = null;
            if($booking->title == 'Test') {
                $color = '#924ACE';
            }
            if($booking->title == 'Test 1') {
                $color = '#68B01A';
            }

            $events[] = [
                'id'   => $booking->id,
                'title' => $booking->title,
                'jurusan' => $booking->jurusan,
                'participant_count' => $booking->participant_count,
                'start' => $booking->start_date,
                'end' => $booking->end_date,
                'color' => $color
            ];
        }
        return view('admin.index2', ['events' => $events]);
    }

    // mengubah status pengajuan 2
    // public function updateBookingStatus(Request $request)
    //     {
    //         $bookingId = $request->input('booking_id');
    //         $status = $request->input('status');

    //         $booking = Booking::find($bookingId);
            
    //         if (!$booking) {
    //             return response()->json(['error' => 'Booking not found'], 404);
    //         }

    //         $booking->status = $status;
    //         $booking->save();

    //         return response()->json(['message' => 'Booking status updated successfully']);
    //     }

    public function updateBookingStatus(Request $request)
    {
        $bookingId = $request->input('booking_id');
        $status = $request->input('status');

        $booking = Booking::find($bookingId);

        if (!$booking) {
            return response()->json(['error' => 'Booking not found'], 404);
        }

        $booking->status = $status;
        $booking->save();

        return response()->json(['status' => $status]);
    }

    // Show the details of a specific request
    public function show($id)
    {
        $request = Pengajuan::find($id);
        return view('admin.requests.show', compact('request'));
    }

    public function accept(Request $request)
    {
        $bookingId = $request->input('booking_id');
        $status = 'accepted'; // You can set the status directly

        $booking = Booking::find($bookingId);

        if (!$booking) {
            return response()->json(['error' => 'Booking not found'], 404);
        }

        $booking->status = $status;
        $booking->save();

        return response()->json(['status' => $status]);
    }

    public function reject(Request $request)
    {
        $bookingId = $request->input('booking_id');
        $status = 'rejected'; // You can set the status directly

        $booking = Booking::find($bookingId);

        if (!$booking) {
            return response()->json(['error' => 'Booking not found'], 404);
        }

        $booking->status = $status;
        $booking->save();

        return response()->json(['status' => $status]);
    }
}
