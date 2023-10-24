<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Rules\ParticipantCountRule;

class CalendarController extends Controller
{
    //
    public function index()
    {
        
        // // Get the currently logged-in user
        // $user = auth()->user();
        
        // // Retrieve the visit requests associated with the user
        // $events = $user->bookings;

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
                'class' => $booking->kelas,
                'status' => $booking->status,
                'participant_count' => $booking->participant_count,
                'start' => $booking->start_date,
                'end' => $booking->end_date,
                'color' => $color
            ];
        }
        return view('calendar.index2', ['events' => $events]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'kelas' => 'required|in:TKJ,SIJA,TJA,MM,RPL,Broadcasting',
            'participant_count' => 'required|in:1,2',
        ]);

        $booking = Booking::create([
            'title' => $request->title,
            'class' => $request->kelas,
            'participant_count' => $request->participant_count,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        // $user = auth()->user();

        // $booking = new Booking([
        //     'visit_date' => $request->visit_date,
        //     'company_name' => $request->company_name,
        //     'contact_person_name' => $request->contact_person_name,
        //     'contact_person_email' => $request->contact_person_email,
        //     'purpose' => $request->purpose,
        //     'class' => $request->class,
        //     'participant_count' => $request->participant_count,
        // ]);

        // $user->bookings()->save($booking);

        // // return redirect()->route('visits.index')->with('success', 'pengajuan request created successfully.');
        // return redirect()->route('calendar.index')->with('success', 'Booking request created successfully.');

        $color = null;

        if($booking->title == 'Test') {
            $color = '#924ACE';
        }

        return response()->json([
            'id' => $booking->id,
            'start' => $booking->start_date,
            'end' => $booking->end_date,
            'title' => $booking->title,
            'participant_count' => $booking->participant_count,
            'class' => $booking->kelas,
            'color' => $color ? $color: '',

        ]);
    }


    public function update(Request $request ,$id)
    {
        $booking = Booking::find($id);
        if(! $booking) {
            return response()->json([
                'error' => 'Unable to locate the event'
            ], 404);
        }
        $booking->update([
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
        return response()->json('Event updated');
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
}
