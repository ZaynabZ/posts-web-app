<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct () {
        
        $this->middleware(['guest']);
    }

    public function index () {
        return view('auth.login');
    }

    public function store (Request $request) {
        $this->validate($request, [
            
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        // attempt method returns a boolean
        if (!auth()->attempt($request->only('email', 'password'), $request->remember)) {

            // Redirect to last page that the user visited
            return back()->with('status', 'Invalid login details');
        }

        return redirect()->route('dashboard');
    }
}
