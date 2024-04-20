<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Token;
use App\Mail\KirimSurel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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

                Log::channel('data')->info(Auth::user()->username . ' masuk');
    
                return redirect()->intended('/');
            }
        }

        Log::channel('data')->info($request->username . ' upaya masuk');

        return back()
            ->withErrors('username atau password salah')
            ->onlyInput('username');
    }

    protected function send_email($data_email)
    {
        Mail::to($data_email['surel_penerima'])->send(new KirimSurel($data_email));
    
        return "Surel berhasil dikirim";
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

        // tambah data pengguna (belum aktif)
        $pengguna = new User;
        $pengguna->username = $request->username;
        $pengguna->name = $request->name;
        $pengguna->email = $request->email;
        $pengguna->password = $request->password;
        $pengguna->status = 0;
        $pengguna->remember_token = csrf_token();
        $pengguna->save();

        // tambah data token untuk aktivasi
        $no_token = rand();
        $token = new Token;
        $token->email = $request->email;
        $token->token = $no_token;
        $token->save();

        $data_email = [
            'surel_penerima' => $request->email,
            'nama_penerima' => $request->name,
            'surel_pengirim' => 'memeforacookie@gmail.com',
            'nama_pengirim' =>'mKlinik',
            'subyek' => 'Verifikasi Akun',
        ];

        // $this->send_email($data_email);

        if ($pengguna) {
            Log::channel('data')->info($request->username . ' mendaftar');
            
            Session::flash('pesan', 'berhasil daftar akun');
        } else {
            Session::flash('pesan', 'gagal daftar akun');
        }

        return redirect('/');
    }

    public function logout(Request $request)
    {
        Log::channel('data')->info(Auth::user()->username . ' keluar');

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect('/login');
    }
}