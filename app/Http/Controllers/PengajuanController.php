<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Pengajuan;
use App\Rules\ParticipantCountRule;

class PengajuanController extends Controller
{
    //
    public function index()
    {
        $visits = Pengajuan::all();
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
            'visit_date' => 'required|date',
            'company_name' => 'required|string',
            'contact_person_name' => 'required|string',
            'contact_person_email' => 'required|email',
            'contact_person_phone' => 'required|string',
            'purpose' => 'required|string',
            'class' => 'required|in:TKJ,SIJA,TJA,MM,RPL,Broadcasting',
            'participant_count' => ['required', 'integer', new ParticipantCountRule],
            'feedback_notes' => 'nullable|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Pengajuan::create($request->all());

        return redirect()->route('visits.index')->with('success', 'pengajuan request created successfully.');
    }

    public function edit($id)
    {
        $visit = Pengajuan::find($id);
        return view('pengajuans.edit', compact('visit'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'visit_date' => 'required|date',
            'company_name' => 'required|string',
            'contact_person_name' => 'required|string',
            'contact_person_email' => 'required|email',
            'contact_person_phone' => 'required|string',
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
