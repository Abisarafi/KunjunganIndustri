<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    //
    public function dashboard()
    {
        return view('client.dashboard');
    }

    public function companyInformation()
    {
        return view('client.company');
    }

    public function requestIndustrialVisit()
    {
        return view('client.request');
    }

    public function requestHistory()
    {
        // Fetch and pass the client's request history data to the view
        $requests = auth()->user()->requests;

        return view('client.history', compact('requests'));
    }
}
