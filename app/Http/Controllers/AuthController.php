<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login', ['judul' => 'Masuk']);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            if (Auth::user()->status == 0) {
                Auth::logout();
                return back()->withErrors('pengguna belum diaktivasi');
            } else {
                $request->session()->regenerate();

                $pengguna = User::find(Auth::user()->id);
                $menu = [];
                foreach ($pengguna->roles as $peran) {
                    $menu = array_merge($menu, $peran->menus()->with('submenus')->get()->toArray());
                }
    
                return redirect()->intended('/');
            }
        }

        return back()
            ->withErrors('username atau password salah')
            ->onlyInput('username');
    }

    public function signup()
    {
        return view('auth.signup', ['judul' => 'Daftar']);
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|unique:users|max:16',
            'name' => 'required|max:64',
            'email' => 'required|unique:users|max:64',
            'password' => 'required|min:8'
        ]);

        $pengguna = new User;
        $pengguna->username = $request->username;
        $pengguna->name = $request->name;
        $pengguna->email = $request->email;
        $pengguna->password = $request->password;
        $pengguna->status = 0;
        $pengguna->remember_token = csrf_token();
        $pengguna->save();

        if ($pengguna) {
            Session::flash('pesan', 'berhasil daftar akun');
        } else {
            Session::flash('pesan', 'gagal daftar akun');
        }

        return redirect('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect('/login');
    }
}