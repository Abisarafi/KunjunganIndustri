<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        // $bookings = Booking::all();
        $bookings = Booking::join('user_id', 'bookings.user_id', '=', 'users.id')
              		->get(['bookings.id','bookings.title', 'bookings.jurusan', 'bookings.status', 
                    'bookings.participant_count', 'bookings.start_date', 'bookings.end_date', 'bookings.color', 'users.noHP']);
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
                'color' => $color,
            ];

            // // Check if this booking was accepted and update other bookings in the same week
            // if ($booking->status === 'accepted') {
            //     $this->rejectOtherBookingsInSameWeek($booking);
            // }
        }
        return view('admin.index2', ['events' => $events]);
    }


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

    // // Show the details of a specific request
    // public function show($id)
    // {
    //     $request = Pengajuan::find($id);
    //     return view('admin.requests.show', compact('request'));
    // }

    public function rejectOtherBookingsInSameWeek(Booking $acceptedBooking)
    {
        // Find other bookings in the same week with status 'processed' or 'accepted'
        $otherBookings = Booking::whereIn('status', ['processed', 'accepted'])
            ->where(function ($query) use ($acceptedBooking) {
                $query->whereBetween('start_date', [$acceptedBooking->start_date, $acceptedBooking->end_date])
                    ->orWhereBetween('end_date', [$acceptedBooking->start_date, $acceptedBooking->end_date]);
            })
            ->where('id', '!=', $acceptedBooking->id)
            ->get();

        // Update the status of other bookings to 'rejected'
        foreach ($otherBookings as $booking) {
            $booking->status = 'rejected';
            $booking->save();
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

        // Update the status of other bookings in the same week to 'rejected'
        $this->rejectOtherBookingsInSameWeek($booking);

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