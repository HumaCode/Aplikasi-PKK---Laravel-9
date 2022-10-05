<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Kelurahan;
use App\Models\Rt;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminKelurahanController extends Controller
{
    public function __construct()
    {
        $this->Kelurahan    = new Kelurahan();
        $this->Rt           = new Rt();
        $this->User         = new User();
    }

    public function index()
    {
        $user       = Auth::user();
        $username   = $user->username;
        $kelurahan  = $this->Kelurahan->dataByUsername($username);
        $kel        = $kelurahan->kelurahan;
        $kec        = $kelurahan->kecamatan;


        return view('admin_kelurahan.rt.data', [
            'rt'        => Rt::where(['kelurahan' => $kel, 'kecamatan' => $kec])->orderBy('id', 'desc')->get(),
            'sesiUser'  => $user,
            'kel'       => $kelurahan
        ]);
    }

    public function tambahAdminRt()
    {
        $user       = Auth::user();
        $username   = $user->username;
        $userRt     = $this->Rt->dataByUsername($username);
        $kelurahan  = $this->Kelurahan->dataByUsername($username);



        return view('admin_kelurahan.rt.tambah', [
            'sesiUser'  => $user,
            'dataRt'    => $userRt,
            'kel'       => $kelurahan
        ]);
    }

    public function prosesTambahAdminRt(Request $request)
    {
        $validatedData = $request->validate(
            [
                'nama'      => 'required',
                'dusun'     => 'required',
                'rw'        => 'required',
                'kelurahan' => 'required',
                'kecamatan' => 'required',
                'kota'      => 'required',
                'provinsi'  => 'required',
                'password'  => 'required|min:6'
            ],
            [
                'nama.required'         => 'Field nama tidak boleh kosong..!!',
                'dusun.required'        => 'Field dusun tidak boleh kosong..!!',
                'rw.required'           => 'Field rw tidak boleh kosong..!!',
                'kelurahan.required'    => 'Field kelurahan tidak boleh kosong..!!',
                'kecamatan.required'    => 'Field kecamatan tidak boleh kosong..!!',
                'kota.required'         => 'Field kota tidak boleh kosong..!!',
                'provinsi.required'     => 'Field provinsi tidak boleh kosong..!!',
                'password.required'     => 'Field password tidak boleh kosong..!!',
                'password.min'          => 'Password minimal 6 karakter..!!',
            ]
        );


        $validatedData['password']  = Hash::make($validatedData['password']);
        $username                   = Helper::UserNameGenerator(new Rt, 'username', 5, 'DSN');

        Rt::create([
            'username'      => $username,
            'nama'          => strtoupper($validatedData['nama']),
            'dusun'         => $validatedData['dusun'],
            'rw'            => $validatedData['rw'],
            'kelurahan'     => strtoupper($validatedData['kelurahan']),
            'kecamatan'     => strtoupper($validatedData['kecamatan']),
            'kota'          => strtoupper($validatedData['kota']),
            'provinsi'      => strtoupper($validatedData['provinsi']),
        ]);

        User::create([
            'username'  => $username,
            'nama'      => strtoupper($validatedData['nama']),
            'password'  => $validatedData['password'],
            'level'     => 2,
        ]);

        return redirect('admin-kelurahan/daftar-admin-rt')->with('success', 'Berhasil menambahkan data.');
    }

    public function editAdminRt($username)
    {

        $user       = Auth::user();
        $username2   = $user->username;
        $kelurahan  = $this->Kelurahan->dataByUsername($username2);


        return view('admin_kelurahan.rt.edit', [
            'adminRt'   => $this->Rt->dataByUsername($username),
            'user'      => $this->User->dataByUsername($username),
            'kel'       => $kelurahan,
            'sesiUser'  => Auth::user(),
        ]);
    }

    public function prosesEditAdminRt(Request $request, $username)
    {
        $validatedData = $request->validate(
            [
                'nama'      => 'required',
                'dusun'     => 'required',
                'rw'        => 'required',
                'kelurahan' => 'required',
                'kecamatan' => 'required',
                'kota'      => 'required',
                'provinsi'  => 'required',
            ],
            [
                'nama.required'         => 'Field nama tidak boleh kosong..!!',
                'dusun.required'        => 'Field dusun tidak boleh kosong..!!',
                'rw.required'           => 'Field dusun tidak boleh kosong..!!',
                'kelurahan.required'    => 'Field kelurahan tidak boleh kosong..!!',
                'kecamatan.required'    => 'Field kecamatan tidak boleh kosong..!!',
                'kota.required'         => 'Field kota tidak boleh kosong..!!',
                'provinsi.required'     => 'Field provinsi tidak boleh kosong..!!',
            ]
        );

        if ($request->password == '') {
            $pass = $request->passLama;
        } else {
            $pass = Hash::make($request['password']);
        }

        Rt::where('username', $username)->update([
            'nama'      => strtoupper($validatedData['nama']),
            'dusun'     => $validatedData['dusun'],
            'rw'        => $validatedData['rw'],
            'kelurahan' => strtoupper($validatedData['kelurahan']),
            'kecamatan' => strtoupper($validatedData['kecamatan']),
            'kota'      => strtoupper($validatedData['kota']),
            'provinsi'  => strtoupper($validatedData['provinsi']),
        ]);

        User::where('username', $username)->update([
            'nama'      => strtoupper($validatedData['nama']),
            'password'  => $pass
        ]);

        return redirect('admin-kelurahan/daftar-admin-rt')->with('success', 'Berhasil mengedit data.');
    }

    public function hapusAdminRt($username)
    {
        $this->Rt->DeleteData($username);
        $this->User->DeleteData($username);

        return redirect('admin-kelurahan/daftar-admin-rt')->with('success', 'Berhasil dihapus.');
    }
}
