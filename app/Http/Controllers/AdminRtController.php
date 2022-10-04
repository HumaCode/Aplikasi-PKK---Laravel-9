<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Kader;
use App\Models\Rt;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminRtController extends Controller
{
    public function __construct()
    {
        $this->Rt = new Rt();
        $this->User = new User();
        $this->Dasawisma = new Kader();
    }


    public function index()
    {
        return view('super_admin.rt.data', [
            'rt' => Rt::orderBy('id', 'desc')->get(),
            'sesiUser' => Auth::user(),
        ]);
    }

    public function tambah()
    {
        return view('super_admin.rt.tambah', [
            'sesiUser' => Auth::user(),
        ]);
    }

    public function prosesTambah(Request $request)
    {
        $validatedData = $request->validate(
            [
                'nama' => 'required',
                'dusun' => 'required',
                'kelurahan' => 'required',
                'kecamatan' => 'required',
                'kota' => 'required',
                'provinsi' => 'required',
                'password' => 'required|min:6'
            ],
            [
                'nama.required' => 'Field nama tidak boleh kosong..!!',
                'dusun.required' => 'Field dusun tidak boleh kosong..!!',
                'kelurahan.required' => 'Field kelurahan tidak boleh kosong..!!',
                'kecamatan.required' => 'Field kecamatan tidak boleh kosong..!!',
                'kota.required' => 'Field kota tidak boleh kosong..!!',
                'provinsi.required' => 'Field provinsi tidak boleh kosong..!!',
                'password.required' => 'Field password tidak boleh kosong..!!',
                'password.min' => 'Password minimal 6 karakter..!!',
            ]
        );


        $validatedData['password'] = Hash::make($validatedData['password']);
        $username = Helper::UserNameGenerator(new Rt, 'username', 5, 'ADM');

        Rt::create([
            'username' => $username,
            'nama' => strtoupper($validatedData['nama']),
            'dusun' => $validatedData['dusun'],
            'kelurahan' => strtoupper($validatedData['kelurahan']),
            'kecamatan' => strtoupper($validatedData['kecamatan']),
            'kota' => strtoupper($validatedData['kota']),
            'provinsi' => strtoupper($validatedData['provinsi']),
        ]);

        User::create([
            'username' => $username,
            'nama' => strtoupper($validatedData['nama']),
            'password' => $validatedData['password'],
            'level' => 2,
        ]);

        return redirect('admin/daftar-admin')->with('success', 'Berhasil menambahkan admin.');
    }

    public function edit($username)
    {
        return view('super_admin.rt.edit', [
            'adminRt' => $this->Rt->dataByUsername($username),
            'user' => $this->User->dataByUsername($username),
            'sesiUser' => Auth::user(),
        ]);
    }

    public function prosesEdit(Request $request, $username)
    {
        // $kader = $this->Kader->dataByUsername($username);
        // $user = $this->User->dataByUsername($username);


        $validatedData = $request->validate(
            [
                'nama' => 'required',
                'dusun' => 'required',
                'kelurahan' => 'required',
                'kecamatan' => 'required',
                'kota' => 'required',
                'provinsi' => 'required',
            ],
            [
                'nama.required' => 'Field nama tidak boleh kosong..!!',
                'dusun.required' => 'Field dusun tidak boleh kosong..!!',
                'kelurahan.required' => 'Field kelurahan tidak boleh kosong..!!',
                'kecamatan.required' => 'Field kecamatan tidak boleh kosong..!!',
                'kota.required' => 'Field kota tidak boleh kosong..!!',
                'provinsi.required' => 'Field provinsi tidak boleh kosong..!!',
            ]
        );

        if ($request->password == '') {
            $pass = $request->passLama;
        } else {
            $pass = Hash::make($request['password']);
        }

        Rt::where('username', $username)->update([
            'nama' => strtoupper($validatedData['nama']),
            'dusun' => $validatedData['dusun'],
            'kelurahan' => strtoupper($validatedData['kelurahan']),
            'kecamatan' => strtoupper($validatedData['kecamatan']),
            'kota' => strtoupper($validatedData['kota']),
            'provinsi' => strtoupper($validatedData['provinsi']),
        ]);

        User::where('username', $username)->update([
            'nama' => strtoupper($validatedData['nama']),
            'password' => $pass
        ]);

        return redirect('admin/daftar-admin')->with('success', 'Berhasil mengedit admin.');
    }

    public function hapus($username)
    {
        // $kader = $this->Kader->dataByUsername($username);
        // $user = $this->User->dataByUsername($username);


        $this->Rt->DeleteData($username);
        $this->User->DeleteData($username);

        return redirect('admin/daftar-admin')->with('success', 'Berhasil dihapus.');
    }



    // untuk admin ke 2 AKun RT 
    public function dataByDukuh()
    {
        $user = Auth::user();
        $username = $user->username;
        $userRt = $this->Rt->dataByUsername($username);
        $dusun = $userRt->dusun;

        return view('admin_rt.rt.data', [
            'rt' => Rt::where('dusun', $dusun)->orderBy('id', 'desc')->get(),
            'sesiUser' => $user,
        ]);
    }

    public function tambahAdminRt()
    {
        $user = Auth::user();
        $username = $user->username;
        $userRt = $this->Rt->dataByUsername($username);


        return view('admin_rt.rt.tambah', [
            'sesiUser' => Auth::user(),
            'dataRt'    => $userRt,
        ]);
    }

    public function prosesTambahAdminRt(Request $request)
    {
        $validatedData = $request->validate(
            [
                'nama' => 'required',
                'dusun' => 'required',
                'kelurahan' => 'required',
                'kecamatan' => 'required',
                'kota' => 'required',
                'provinsi' => 'required',
                'password' => 'required|min:6'
            ],
            [
                'nama.required' => 'Field nama tidak boleh kosong..!!',
                'dusun.required' => 'Field dusun tidak boleh kosong..!!',
                'kelurahan.required' => 'Field kelurahan tidak boleh kosong..!!',
                'kecamatan.required' => 'Field kecamatan tidak boleh kosong..!!',
                'kota.required' => 'Field kota tidak boleh kosong..!!',
                'provinsi.required' => 'Field provinsi tidak boleh kosong..!!',
                'password.required' => 'Field password tidak boleh kosong..!!',
                'password.min' => 'Password minimal 6 karakter..!!',
            ]
        );


        $validatedData['password'] = Hash::make($validatedData['password']);
        $username = Helper::UserNameGenerator(new Rt, 'username', 5, 'ADM');

        Rt::create([
            'username' => $username,
            'nama' => strtoupper($validatedData['nama']),
            'dusun' => $validatedData['dusun'],
            'kelurahan' => strtoupper($validatedData['kelurahan']),
            'kecamatan' => strtoupper($validatedData['kecamatan']),
            'kota' => strtoupper($validatedData['kota']),
            'provinsi' => strtoupper($validatedData['provinsi']),
        ]);

        User::create([
            'username' => $username,
            'nama' => strtoupper($validatedData['nama']),
            'password' => $validatedData['password'],
            'level' => 2,
        ]);

        return redirect('admin2/daftar-admin')->with('success', 'Berhasil menambahkan admin.');
    }

    public function editAdminRt($username)
    {
        return view('admin_rt.rt.edit', [
            'adminRt' => $this->Rt->dataByUsername($username),
            'user' => $this->User->dataByUsername($username),
            'sesiUser' => Auth::user(),
        ]);
    }

    public function prosesEditAdminRt(Request $request, $username)
    {
        $validatedData = $request->validate(
            [
                'nama' => 'required',
                'dusun' => 'required',
                'kelurahan' => 'required',
                'kecamatan' => 'required',
                'kota' => 'required',
                'provinsi' => 'required',
            ],
            [
                'nama.required' => 'Field nama tidak boleh kosong..!!',
                'dusun.required' => 'Field dusun tidak boleh kosong..!!',
                'kelurahan.required' => 'Field kelurahan tidak boleh kosong..!!',
                'kecamatan.required' => 'Field kecamatan tidak boleh kosong..!!',
                'kota.required' => 'Field kota tidak boleh kosong..!!',
                'provinsi.required' => 'Field provinsi tidak boleh kosong..!!',
            ]
        );

        if ($request->password == '') {
            $pass = $request->passLama;
        } else {
            $pass = Hash::make($request['password']);
        }

        Rt::where('username', $username)->update([
            'nama' => strtoupper($validatedData['nama']),
            'dusun' => $validatedData['dusun'],
            'kelurahan' => strtoupper($validatedData['kelurahan']),
            'kecamatan' => strtoupper($validatedData['kecamatan']),
            'kota' => strtoupper($validatedData['kota']),
            'provinsi' => strtoupper($validatedData['provinsi']),
        ]);

        User::where('username', $username)->update([
            'nama' => strtoupper($validatedData['nama']),
            'password' => $pass
        ]);

        return redirect('admin2/daftar-admin')->with('success', 'Berhasil mengedit admin.');
    }

    public function hapusAdminRt($username)
    {
        $this->Rt->DeleteData($username);
        $this->User->DeleteData($username);

        return redirect('admin2/daftar-admin')->with('success', 'Berhasil dihapus.');
    }



    // untuk admin ke 2 AKun dasawisma 
    public function dasawismaByDukuh()
    {
        $user = Auth::user();
        $username = $user->username;
        $userRt = $this->Rt->dataByUsername($username);
        $dusun = $userRt->dusun;

        return view('admin_rt.dasawisma.data', [
            'dasawisma' => Kader::where('dusun', $dusun)->orderBy('id', 'desc')->get(),
            'sesiUser' => $user,
        ]);
    }

    public function tambahAdminDasawisma()
    {
        $user = Auth::user();
        $username = $user->username;
        $userRt = $this->Rt->dataByUsername($username);


        return view('admin_rt.dasawisma.tambah', [
            'sesiUser' => Auth::user(),
            'dataRt'    => $userRt,
        ]);
    }

    public function prosesTambahAdminDasawisma(Request $request)
    {
        $validatedData = $request->validate(
            [
                'nama' => 'required',
                'dusun' => 'required',
                'kelurahan' => 'required',
                'kecamatan' => 'required',
                'kota' => 'required',
                'provinsi' => 'required',
                'dasawisma' => 'required',
                'password' => 'required|min:6'
            ],
            [
                'nama.required' => 'Field nama tidak boleh kosong..!!',
                'dusun.required' => 'Field dusun tidak boleh kosong..!!',
                'kelurahan.required' => 'Field kelurahan tidak boleh kosong..!!',
                'kecamatan.required' => 'Field kecamatan tidak boleh kosong..!!',
                'kota.required' => 'Field kota tidak boleh kosong..!!',
                'provinsi.required' => 'Field provinsi tidak boleh kosong..!!',
                'dasawisma.required' => 'Field dasawisma tidak boleh kosong..!!',
                'password.required' => 'Field password tidak boleh kosong..!!',
                'password.min' => 'Password minimal 6 karakter..!!',
            ]
        );


        $validatedData['password'] = Hash::make($validatedData['password']);
        $username = Helper::UserNameGenerator(new Rt, 'username', 5, 'DSA');

        Kader::create([
            'username' => $username,
            'nama' => strtoupper($validatedData['nama']),
            'dusun' => $validatedData['dusun'],
            'kelurahan' => strtoupper($validatedData['kelurahan']),
            'kecamatan' => strtoupper($validatedData['kecamatan']),
            'kota' => strtoupper($validatedData['kota']),
            'provinsi' => strtoupper($validatedData['provinsi']),
            'dasawisma' => strtoupper($validatedData['dasawisma']),
        ]);

        User::create([
            'username' => $username,
            'nama' => strtoupper($validatedData['nama']),
            'password' => $validatedData['password'],
            'level' => 3,
        ]);

        return redirect('admin2/daftar-dasawisma')->with('success', 'Berhasil menambahkan akun dasawisma.');
    }

    public function editAdminDasawisma($username)
    {
        return view('admin_rt.dasawisma.edit', [
            'dasawisma' => $this->Dasawisma->dataByUsername($username),
            'user' => $this->User->dataByUsername($username),
            'sesiUser' => Auth::user(),
        ]);
    }

    public function prosesEditAdminDasawisma(Request $request, $username)
    {
        $validatedData = $request->validate(
            [
                'nama' => 'required',
                'dusun' => 'required',
                'kelurahan' => 'required',
                'kecamatan' => 'required',
                'kota' => 'required',
                'provinsi' => 'required',
                'dasawisma' => 'required',
            ],
            [
                'nama.required' => 'Field nama tidak boleh kosong..!!',
                'dusun.required' => 'Field dusun tidak boleh kosong..!!',
                'kelurahan.required' => 'Field kelurahan tidak boleh kosong..!!',
                'kecamatan.required' => 'Field kecamatan tidak boleh kosong..!!',
                'kota.required' => 'Field kota tidak boleh kosong..!!',
                'provinsi.required' => 'Field provinsi tidak boleh kosong..!!',
                'dasawisma.required' => 'Field dasawisma tidak boleh kosong..!!',
            ]
        );

        if ($request->password == '') {
            $pass = $request->passLama;
        } else {
            $pass = Hash::make($request['password']);
        }

        Kader::where('username', $username)->update([
            'nama' => strtoupper($validatedData['nama']),
            'dusun' => $validatedData['dusun'],
            'kelurahan' => strtoupper($validatedData['kelurahan']),
            'kecamatan' => strtoupper($validatedData['kecamatan']),
            'kota' => strtoupper($validatedData['kota']),
            'provinsi' => strtoupper($validatedData['provinsi']),
            'dasawisma' => strtoupper($validatedData['dasawisma']),
        ]);

        User::where('username', $username)->update([
            'nama' => strtoupper($validatedData['nama']),
            'password' => $pass
        ]);

        return redirect('admin2/daftar-dasawisma')->with('success', 'Berhasil mengedit akun dasawisma.');
    }

    public function hapusAdminDasawisma($username)
    {
        $this->Dasawisma->DeleteData($username);
        $this->User->DeleteData($username);

        return redirect('admin2/daftar-dasawisma')->with('success', 'Berhasil dihapus.');
    }


    // untuk admin ke 2 Daftar Warga tp pkk 
    public function wargaTpPkk()
    {
        $user = Auth::user();
        $username = $user->username;
        $userRt = $this->Rt->dataByUsername($username);
        $dusun = $userRt->dusun;

        return view('admin_rt.warga.data', [
            'dasawisma' => Kader::where('dusun', $dusun)->orderBy('id', 'desc')->get(),
            'sesiUser' => $user,
        ]);
    }
}
