<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Administrator;
use  App\Models\Siswa;
use  App\Models\Guru;

class IndexController extends Controller
{
    public function home(){
        return view('home');
    }

    public function index()
    {
        return view('index');
    }

    public function loginAdmin(Request $request)
    {
        $administrator = Administrator::where('id_admin', $request->kode_admin)->where('password', $request->password)->first();

        if(!$administrator){
            return back()->with('error','Kode Admin atau Password Salah');
        }

        session([
            'role' => 'admin',
            'id_admin' => $administrator->id_admin
        ]);

        return redirect('/home');
    }

    public function loginGuru(Request $request)
    {
        $guru = Guru::where('nip', $request->nip)->where('password', $request->password)->first();

        if (!$guru) {
            return back()->with('error', 'NIP atau Password Salah');
        }

        session([
            'role' => 'guru',
            'nama_guru' => $guru->nama_guru,
            'id' => $guru->id
        ]);

        return redirect('/home');
    }

    public function loginSiswa(Request $request)
    {
        $siswa = Siswa::where('nis', $request->nis)->where('pasword', $request->pasword)->first();

        if (!$siswa) {
            return back()->with('error', 'NIS atau Password Salah');
        }

        session([
            'role' => 'siswa',
            'nama_siswa' => $siswa->nama_siswa,
            'id' => $siswa->id
        ]);

        return redirect('/home');
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();

        return redirect('/');
    }
}
