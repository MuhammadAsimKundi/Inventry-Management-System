<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Notifications\UserNotification;

use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = 'dashboard'; // Redirect path after login

    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
    }


    public function authenticated(Request $request, $user)
{
    $user->notify(new UserNotification('A new user has logged in.', $user->name)); // Pass both message and user name
    return redirect()->route('dashboard');
}


}

