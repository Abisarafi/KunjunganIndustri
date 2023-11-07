<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        // Check the user's role and redirect accordingly
        if ($user->role === 'admin') {
            return redirect()->route('admin.calendar.index');
        } elseif ($user->role === 'client') {
            return redirect()->route('calendar.index');
        }

        return redirect('/'); // Redirect to a default route for other roles or handle this case as needed.
    }
}
