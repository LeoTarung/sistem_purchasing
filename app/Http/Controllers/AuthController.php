<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request)
    {
        $credentials = $request->only('NRP', 'password');
        // dd 
        // Retrieve the user by the provided npk
        $user = User::where('nrp', $credentials['NRP'])->first();

        // Check if the user exists and the provided password matches
        if ($user && $user->password === $credentials['password']) {
            // User is authenticated, log them in
            auth()->login($user);
            // dd(Auth::user(), $user, $credentials);
            // dd($user->role->jenis_role);
            if ($user->role === '5' && $user->departement === 'HC & GA') { // Kepala Departement HRD
                return "Bu Dian";
            } else if ($user->role === '4' && $user->seksi === 'HRD') { //Kepala Seksi HRD
                return "Pak Wahyu";
            } else if ($user->role === '3' && $user->seksi === 'HRD') {
                return "Admin HRD";
            } else if ($user->role === '4') { // Section HEAD  Role
                return "SECTION HEAD";
                // return redirect('/Menu-skill-map');
            } else if ($user->role === '5') { // Departemen HEAD  Role
                return "DEPARTEMEN HEAD";
                // return redirect('/Menu-skill-map');
            } else {
                return "Basic Account";
                // return redirect('/Menu-skill-map');
            }
            // Redirect the user to the desired location after login
            return redirect('/dashboard');
        } else {
            // Authentication failed, redirect back to the login page with an error message.
            return redirect()->route('login')->with('error', 'Invalid NRP or password.');
        }
    }

    public function login()
    {
        // $title = 'Dashboard';
        // $role = 'user';
        return view('auth.login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }

    public function indexReset()
    {
        Auth::logout();
        return view('auth.passwordReset');
    }


    public function reset(Request $request)
    {
        // Validate the request
        $request->validate([
            'nrp' => 'required',
            'password' => 'required|min:6|confirmed', // requires 'password' and 'password_confirmation' fields
        ]);

        // dd($request);
        // Find the user by email
        $user = user::where('nrp', $request->nrp)->first();

        if ($user) {
            // Update the user's password
            $user->password = Hash::make($request->password);
            $user->save();

            // Return a response or redirect as needed
            return response()->json(['message' => 'Password has been updated successfully.']);
        }

        return response()->json(['error' => 'User not found.'], 404);
    }
}
