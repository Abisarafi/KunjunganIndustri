<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Carbon;
use App\Rules\NotPastDateRule;
use App\Rules\NotToday;
use App\Models\User;
use App\Rules\WeekdayBooking;

class CalendarController extends Controller
{
    
    
    
    
    public function index()
    {
        // Get the currently logged-in user
        $user = auth()->user();

        // Retrieve the visit requests associated with the user
        $bookings = $user->bookings;

        $events = [];

        foreach ($bookings as $booking) {
            $color = null;
            if ($booking->status == 'rejected') {
                $color = '#FF3B28';
            }
            if ($booking->status == 'accepted') {
                $color = '#48EB12';
            }

            $events[] = [
                'id' => $booking->id,
                'title' => $booking->title,
                'jurusan' => $booking->jurusan,
                'status' => $booking->status,
                'participant_count' => $booking->participant_count,
                'start' => $booking->start_date,
                'end' => $booking->end_date,
                'color' => $color,
            ];
        }


        return view('calendar.index2', ['events' => $events]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'jurusan' => 'required|in:TKJ,SIJA,TJA,MM,RPL,Broadcasting',
            'participant_count' => 'required|in:1,2',
            'start_date' => 'required|date',
            'end_date' => ['required', 'date', 'after:start_date'],
        ]);

        $user = auth()->user();

        // Get the currently authenticated user
        $user = auth()->user();

        $booking = Booking::create([
            'title' => $request->title,
            'jurusan' => $request->jurusan,
            'participant_count' => $request->participant_count,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
            'user_id' => $user->id
        ]);

        
        

        return response()->json([
            'id' => $booking->id,
            'start' => $booking->start_date,
            'end' => $booking->end_date,
            'title' => $booking->title,
            'participant_count' => $booking->participant_count,
            'jurusan' => $booking->jurusan,
            'status' => $booking->status,
        ]);
        
    }


    


    
    public function destroy($id)
    {
        $booking = Booking::find($id);
        if(! $booking) {
            return response()->json([
                'error' => 'Unable to locate the event'
            ], 404);
        }
        $booking->delete();
        return $id;
    }

   

    public function checkBooking(Request $request)
    {
        $start = Carbon::parse($request->input('start'));
        $end = Carbon::parse($request->input('end'));
        $selectedStartDate = $request->input('start_date');
        $selectedWeekday = date('N', strtotime($selectedStartDate));
        // true or false isWeekend
        $isWeekend = in_array($selectedWeekday, [7]);

        $hasAcceptedBookings = Booking::where('status', 'accepted')
            ->where('start_date', '>=', $start)
            ->where('end_date', '<=', $end)
            ->exists();

        $selectedDate = Carbon::parse($selectedStartDate);

        // Check if selected date is tomorrow
        $isTomorrow = $selectedDate->isAfter(now());

        // Check if selected date is more than 7 days from today
        $daysDifference = $selectedDate->diffInDays(now());
        $isMoreThan7Days = $daysDifference > 7;

        return response()->json([
            'hasAcceptedBookings' => $hasAcceptedBookings,
            'isWeekend' => $isWeekend,
            'isTomorrow' => $isTomorrow,
            'isMoreThan7Days' => $isMoreThan7Days,
        ]);
    }

}