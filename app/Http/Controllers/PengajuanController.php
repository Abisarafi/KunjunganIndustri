<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Pengajuan;
use App\Rules\ParticipantCountRule;
use App\Rules\UniqueWeekRequest;
use App\Models\User;
use App\Models\Booking;


class PengajuanController extends Controller
{
    //
    public function index()
    {

        // Get the currently logged-in user
        $user = auth()->user();

        // Retrieve the visit requests associated with the user
        $visits = $user->pengajuans;

        return view('pengajuans.index', compact('visits'));

    }

    public function create()
    {
        return view('pengajuans.create');
    }

    public function store(Request $request)
    {
        // Validation rules
        $rules = [
            'visit_date' => ['required', 'date', new UniqueWeekRequest],
            'company_name' => 'required|string',
            'contact_person_name' => 'required|string',
            'contact_person_email' => 'required|email',
            'purpose' => 'required|string',
            'class' => 'required|in:TKJ,SIJA,TJA,MM,RPL,Broadcasting',
            'participant_count' => ['required', 'integer', new ParticipantCountRule],
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = auth()->user();

        // Pengajuan::insert([
    	// 	'visit_date' => $request->visit_date,
    	// 	'company_name' => $request->company_name,
    	// 	'contact_person_name' => $request->contact_person_name,
    	// 	'contact_person_email' => $request->contact_person_email,
    	// 	'purpose' => $request->purpose,
    	// 	'class' => $request->class,
    	// 	'participant_count' => $request->participant_count,
    	// 	'user_id' => $user->id,
    	// ]);

        $visit = new Pengajuan([
            'visit_date' => $request->visit_date,
            'company_name' => $request->company_name,
            'contact_person_name' => $request->contact_person_name,
            'contact_person_email' => $request->contact_person_email,
            'purpose' => $request->purpose,
            'class' => $request->class,
            'participant_count' => $request->participant_count,
        ]);

        $user->pengajuans()->save($visit);

        // return redirect()->route('visits.index')->with('success', 'pengajuan request created successfully.');
        return redirect()->route('visits.index')->with('success', 'Pengajuan request created successfully.');
    }

    public function storePengajuan(Request $request)
{
    $request->validate([
        'title' => 'required|string',
        'company_name' => 'required|string',
        'visit_date' => 'required|string',
        'class' => 'required|string',
        'participant_count' => 'required|string',
    ]);

    $booking = Booking::create([
        'title' => $request->title,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
    ]);

    $pengajuan = Pengajuan::create([
        'company_name' => $request->company_name,
        'visit_date' => $request->visit_date,
        'class' => $request->class,
        'participant_count' => $request->participant_count,
    ]);

    $color = null;

    if ($booking->title == 'Test') {
        $color = '#924ACE';
    }

    return response()->json([
        'booking' => [
            'id' => $booking->id,
            'start' => $booking->start_date,
            'end' => $booking->end_date,
            'title' => $booking->title,
            'color' => $color ? $color : '',
        ],
        'pengajuan' => [
            'id' => $pengajuan->id,
            'company_name' => $pengajuan->company_name,
            'visit_date' => $pengajuan->visit_date,
            'class' => $pengajuan->class,
            'participant_count' => $pengajuan->participant_count,
        ],
    ]);
}


    public function edit($id)
    {
        $visit = Pengajuan::find($id);
        return view('pengajuans.edit', compact('visit'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'visit_date' => ['required', 'date', new UniqueWeekRequest],
            'company_name' => 'required|string',
            'contact_person_name' => 'required|string',
            'contact_person_email' => 'required|email',
            'purpose' => 'required|string',
            'class' => 'required|in:TKJ,SIJA,TJA,MM,RPL,Broadcasting',
            'participant_count' => ['required', 'integer', new ParticipantCountRule],
            'feedback_notes' => 'nullable|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $visit = Pengajuan::find($id);
        $visit->update($request->all());

        return redirect()->route('visits.index')->with('success', 'Visit request updated successfully.');
    }

    public function destroy($id)
    {
        $visit = Pengajuan::find($id);
        $visit->delete();

        return redirect()->route('visits.index')->with('success', 'Visit request deleted successfully.');
    }
    public function destroyPengajuan($id)
    {
        $booking = Booking::find($id);

        if (! $booking) {
            return response()->json([
                'error' => 'Unable to locate the event'
            ], 404);
        }

        // Retrieve the associated Pengajuan record
        $pengajuan = Pengajuan::where('booking_id', $booking->id)->first();

        if ($pengajuan) {
            $pengajuan->delete();
        }

        // Delete the Booking record
        $booking->delete();

        return response()->json([
            'message' => 'Event and associated data have been deleted successfully'
        ]);
    }
}
