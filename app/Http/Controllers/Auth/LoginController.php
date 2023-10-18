<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Auth\Events\PasswordReset;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::all();
        return view('loginregister.login', compact('user'));
    }

    public function authenticate(Request $request): RedirectResponse
    {
        // dd($request->all());
        $user = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ],[
            'email.required' => 'email tidak boleh kosong',
            'email.email' => 'email tidak valid',
            'password.required' => 'password tidak boleh kosong'
        ]);
       
        // if (Auth::attempt($user)) {
        //     $user = auth()->user();
        
        //     if ($user->role === 'admin') {
        //         return redirect()->route('dashboardAdmin'); // Redirect ke dashboard admin.
        //     } elseif ($user->role === 'user') {
        //         return redirect()->route('dashboardUser'); // Redirect ke dashboard pengguna.
        //     }
        // }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);

        return redirect('/register');
    }

   
}