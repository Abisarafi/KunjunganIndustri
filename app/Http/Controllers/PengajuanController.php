<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Pengajuan;
use App\Rules\ParticipantCountRule;
use App\Rules\UniqueWeekRequest;
use App\Models\User;


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
}
