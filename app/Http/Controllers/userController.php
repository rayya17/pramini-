<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class userController extends Controller
{


    public function index()
    {
        $User = User::all();
        return view('loginregister.login', compact('User'));
    }

    public function register()
    {
        $user = User::all();
        return view('loginregister.register', compact('user'));
    }

    public function authenticate(Request $request): RedirectResponse
    {
        // dd($request->all());
        $user = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ],[
            'email.required' => 'email tidak boleh kosong',
            'email.email' => 'email tidak valid',
            'password.required' => 'password tidak boleh kosong'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($user['password'])
        ]);

        return redirect('/login');
    }

    public function authenticatelogin(Request $request)
    {
        $user = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ],[
            'email.required' => 'email tidak boleh kosong',
            'email.email' => 'email tidak valid',
            'password.required' => 'password tidak boleh kosong'
        ]);
        
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect('dashboard'); // Redirect ke dashboard admin.
            } else if ($user->role === 'user') {
                return redirect()->route('dashboardUser'); // Redirect ke dashboard pengguna.
            }
        }
        return redirect('login');
        }

    public function create()
    {
        $user = User::all();
        return view('loginregister.register', compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'konfirmpassword' => 'required|same:password',
        ],[
            'name.required' => 'Nama Wajib diisi',
            'email.required' => 'Email Wajib diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
            'konfirmpassword.required' => 'Konfirmasi Password wajib diisi',
            'konfirmpassword.same' => 'Konfirmasi Password harus sama dengan Password',
        ]);

        $user = $request->all();
        $user['password'] = Hash::make($user['password']);
        User::create($user);
        return redirect()->route('user.index');
    }

    public function logout()
{
    Auth::logout();
    return redirect()->route('user.index');
}

}
