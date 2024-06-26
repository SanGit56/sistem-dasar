<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $kata_kunci = $request->cari;
        $pengguna = User::where('username', 'LIKE', '%'.$kata_kunci.'%')
                        ->orWhere('name', 'LIKE', '%'.$kata_kunci.'%')
                        ->orWhere('email', 'LIKE', '%'.$kata_kunci.'%')
                        ->paginate(7);
        
        return view('user.index', ['judul' => 'Pengguna', 'pengguna' => $pengguna]);
    }

    public function show($id)
    {
        $pengguna = User::with('roles')->findOrFail($id);
        $peran = Role::get();

        return view('user.detail', ['judul' => 'Pengguna ' . $id, 'pengguna' => $pengguna, 'peran' => $peran]);
    }

    public function create()
    {
        return view('user.add', ['judul' => 'Tambah Pengguna']);
    }

    public function store(Request $request)
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
        $pengguna->status = ($request->status == 'on') ? 1 : 0;

        if ($request->file('foto')) {
            $request->file('foto')->storeAs('', $request->foto->getClientOriginalName());
            $pengguna->profile_picture = $request->foto->getClientOriginalName();
        }

        $pengguna->remember_token = csrf_token();
        $pengguna->save();

        if ($pengguna) {
            Log::channel('data')->info(Auth::user()->username . ' menambah data pengguna ' . $request->username);
            
            Session::flash('pesan', 'berhasil menambah data');
        } else {
            Session::flash('pesan', 'gagal menambah data');
        }

        return redirect('/user');
    }

    public function edit($id)
    {
        $pengguna = User::findOrFail($id);

        return view('user.edit', ['judul' => 'Sunting Pengguna ' . $id, 'pengguna' => $pengguna]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'username' => 'required|max:16',
            'name' => 'required|max:64',
            'email' => 'required|max:64'
        ]);

        $pengguna = User::findOrFail($id);

        $pengguna->username = $request->username;
        $pengguna->name = $request->name;
        $pengguna->email = $request->email;
        $pengguna->status = ($request->status == 'on') ? 1 : 0;
        $pengguna->save();

        if ($pengguna) {
            Log::channel('data')->info(Auth::user()->username . ' menyunting data pengguna ' . $request->username);

            Session::flash('pesan', 'berhasil mengubah data');
        } else {
            Session::flash('pesan', 'gagal mengubah data');
        }

        return redirect('/user');
    }

    public function destroy($id)
    {
        $pengguna = User::findOrFail($id);

        $pengguna->delete();

        if ($pengguna) {
            Log::channel('data')->info(Auth::user()->username . ' menghapus data pengguna ' . $pengguna->username);

            Session::flash('pesan', 'berhasil menghapus data');
        } else {
            Session::flash('pesan', 'gagal menghapus data');
        }

        return redirect('/user');
    }

    public function trash()
    {
        $pengguna = User::onlyTrashed()->get();

        return view('user.deleted', ['judul' => 'Pengguna Terhapus', 'pengguna' => $pengguna]);
    }

    public function restore($id)
    {
        $pengguna = User::withTrashed()->where('id', $id)->restore();

        if ($pengguna) {
            Log::channel('data')->info(Auth::user()->username . ' mengembalikan data pengguna');

            Session::flash('pesan', 'berhasil memulihkan data');
        } else {
            Session::flash('pesan', 'gagal memulihkan data');
        }

        return redirect('/user-deleted');
    }

    public function update_picture(Request $request, $id)
    {
        $pengguna = User::findOrFail($id);

        if ($request->foto) {
            $request->file('foto')->storeAs('', $request->foto->getClientOriginalName());
            $pengguna->profile_picture = $request->foto->getClientOriginalName();

            $pengguna->save();

            if ($pengguna) {
                Log::channel('data')->info(Auth::user()->username . ' mengganti foto');

                Session::flash('pesan', 'berhasil mengganti foto');
            } else {
                Session::flash('pesan', 'gagal mengganti foto');
            }
        }

        return redirect('/user-change-pic');
    }

    public function update_password(Request $request, $id)
    {
        $validated = $request->validate([
            'sandilama' => 'required',
            'sandibaru' => 'required|min:8',
            'sandilagi' => 'required|min:8',
        ]);

        $pengguna = User::findOrFail($id);

        if (password_verify($request->sandilama, $pengguna->password)) {
            $pengguna->password = $request->sandibaru;
            $pengguna->save();

            Log::channel('data')->info(Auth::user()->username . ' mengganti kata sandi');

            Session::flash('pesan', 'berhasil mengubah sandi');

            return redirect('/user');
        } else {
            return back()
            ->withErrors('sandi lama tidak sama')
            ->onlyInput('sandilama');
        }
    }
}