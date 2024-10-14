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
        $credentials = $request->only('email', 'password');

        // Retrieve the user by the provided email
        $user = User::where('email', $credentials['email'])->first();

        // Check if the user exists and the provided password matches (using bcrypt)
        if ($user && Hash::check($credentials['password'], $user->password)) {
            // User is authenticated, log them in
            auth()->login($user);

            // You can access user's role like this if you have a relationship or a direct role attribute
            // dd(Auth::user(), $user, $credentials);
            // dd($user->role->jenis_role); // Or adapt this to your needs

            // Redirect the user to the desired location after login
            return redirect('/home');
        } else {
            // Authentication failed, redirect back to the login page with an error message.
            return redirect()->route('login')->with('error', 'Invalid email or password.');
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
