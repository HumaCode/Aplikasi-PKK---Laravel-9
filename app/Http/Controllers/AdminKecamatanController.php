<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminKecamatanController extends Controller
{
    public function __construct()
    {
        $this->Kecamatan    = new Kecamatan();
        $this->Kelurahan    = new Kelurahan();
        $this->User         = new User();
    }

    public function index()
    {
        $user       = Auth::user();
        $username   = $user->username;
        $kecamatan  = $this->Kecamatan->dataByUsername($username);
        $kec        = $kecamatan->kecamatan;


        return view('admin_kecamatan.kelurahan.data', [
            'kelurahan' => Kelurahan::where('kecamatan', $kec)->orderBy('id', 'desc')->get(),
            'sesiUser'  => $user,
            'kec'       => $kecamatan
        ]);
    }

    public function tambahAdminKelurahan()
    {
        $user       = Auth::user();
        $username   = $user->username;
        $kecamatan  = $this->Kecamatan->dataByUsername($username);

        return view('admin_kecamatan.kelurahan.tambah', [
            'sesiUser'  => $user,
            'kec' => $kecamatan,
        ]);
    }

    public function prosesTambahAdminKelurahan(Request $request)
    {
        $validatedData = $request->validate(
            [
                'nama'      => 'required',
                'kelurahan' => 'required',
                'kecamatan' => 'required',
                'kota'      => 'required',
                'provinsi'  => 'required',
                'password'  => 'required|min:6'
            ],
            [
                'nama.required'         => 'Field nama tidak boleh kosong..!!',
                'kecamatan.required'    => 'Field kecamatan tidak boleh kosong..!!',
                'kelurahan.required'    => 'Field kelurahan tidak boleh kosong..!!',
                'password.required'     => 'Field password tidak boleh kosong..!!',
                'password.min'          => 'Password minimal 6 karakter..!!',
            ]
        );


        $validatedData['password'] = Hash::make($validatedData['password']);
        $username = Helper::UserNameGenerator(new Kelurahan, 'username', 5, 'KEL');

        Kelurahan::create([
            'username'      => $username,
            'nama'          => strtoupper($validatedData['nama']),
            'kelurahan'     => strtoupper($validatedData['kelurahan']),
            'kecamatan'     => strtoupper($validatedData['kecamatan']),
            'kota'          => $validatedData['kota'],
            'provinsi'      => $validatedData['provinsi'],
        ]);

        User::create([
            'username' => $username,
            'nama' => strtoupper($validatedData['nama']),
            'password' => $validatedData['password'],
            'level' => 5,
        ]);

        return redirect('admin-kecamatan/daftar-admin-kelurahan')->with('success', 'Berhasil menambahkan admin kecamatan.');
    }

    public function editAdminKelurahan($username)
    {
        $user       = Auth::user();
        $username2   = $user->username;
        $kecamatan  = $this->Kecamatan->dataByUsername($username2);

        return view('admin_kecamatan.kelurahan.edit', [
            'kelurahan' => $this->Kelurahan->dataByUsername($username),
            'user'      => $this->User->dataByUsername($username),
            'sesiUser'  => $user,
            'kec'       => $kecamatan,
        ]);
    }

    public function prosesEditAdminKelurahan(Request $request, $username)
    {
        $validatedData = $request->validate(
            [
                'nama'      => 'required',
                'kecamatan' => 'required',
                'kelurahan' => 'required',
                'kota'      => 'required',
                'provinsi'  => 'required',
            ],
            [
                'nama.required'         => 'Field nama tidak boleh kosong..!!',
                'kecamatan.required'    => 'Field kecamatan tidak boleh kosong..!!',
                'kelurahan.required'    => 'Field kelurahan tidak boleh kosong..!!',
                'kota.required'         => 'Field kota tidak boleh kosong..!!',
                'provinsi.required'     => 'Field provinsi tidak boleh kosong..!!',
            ]
        );

        if ($request->password == '') {
            $pass = $request->passLama;
        } else {
            $pass = Hash::make($request['password']);
        }

        Kelurahan::where('username', $username)->update([
            'nama'      => strtoupper($validatedData['nama']),
            'kelurahan' => strtoupper($validatedData['kelurahan']),
            'kecamatan' => strtoupper($validatedData['kecamatan']),
            'kota'      => strtoupper($validatedData['kota']),
            'provinsi'  => strtoupper($validatedData['provinsi']),
        ]);

        User::where('username', $username)->update([
            'nama'      => strtoupper($validatedData['nama']),
            'password'  => $pass
        ]);

        return redirect('admin-kecamatan/daftar-admin-kelurahan')->with('success', 'Berhasil diubah.');
    }

    public function hapusAdminKelurahan($username)
    {
        $this->Kelurahan->DeleteData($username);
        $this->User->DeleteData($username);

        return redirect('admin-kecamatan/daftar-admin-kelurahan')->with('success', 'Berhasil dihapus.');
    }
}
