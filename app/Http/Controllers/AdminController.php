<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;

class AdminController extends Controller
{
    // Display a list of client requests
    public function index()
    {
        $requests = Pengajuan::where('status', 'processed')->get(); // Retrieve processed requests
        return view('admin.requests.index', compact('requests'));
    }

    // Show the details of a specific request
    public function show($id)
    {
        $request = Pengajuan::find($id);
        return view('admin.requests.show', compact('request'));
    }

    // Accept a client's request
    public function accept(Request $request)
    {
        $id = $request->input('request_id');
        $request = Pengajuan::find($id);
        $request->status = 'accepted';
        $request->save();
        return redirect()->route('admin.requests.index')->with('success', 'Request accepted successfully');
    }

    // Reject a client's request
    public function reject(Request $request)
    {
        $id = $request->input('request_id');
        $request = Pengajuan::find($id);
        $request->status = 'rejected';
        $request->save();
        return redirect()->route('admin.requests.index')->with('success', 'Request rejected');
    }
}
