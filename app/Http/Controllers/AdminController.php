<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Kader;
use App\Models\Kelurahan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->Kelurahan = new Kelurahan();
        $this->Kader = new Kader();
        $this->User = new User();
    }

    public function index()
    {
        return view('super_admin.dasawisma.data', [
            'kaders' => Kader::orderBy('id', 'desc')->get(),
            'sesiUser' => Auth::user(),
        ]);
    }

    public function tambah()
    {
        return view('super_admin.dasawisma.tambah', [
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
        $username = Helper::UserNameGenerator(new Kader, 'username', 5, 'DSA');

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

        return redirect('admin/daftar-dasawisma')->with('success', 'Berhasil menambahkan kader.');
    }

    public function edit($username)
    {
        return view('super_admin.dasawisma.edit', [
            'kader' => $this->Kader->dataByUsername($username),
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
                'dasawisma' => 'required'
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
            'dasawisma' => $validatedData['dasawisma'],
        ]);

        User::where('username', $username)->update([
            'nama' => strtoupper($validatedData['nama']),
            'password' => $pass
        ]);

        return redirect('admin/daftar-dasawisma')->with('success', 'Berhasil diubah.');
    }


    public function hapus($username)
    {
        $this->Kader->DeleteData($username);
        $this->User->DeleteData($username);

        return redirect('/admin/daftar-dasawisma')->with('success', 'Berhasil dihapus.');
    }


    public function dataAdminKelurahan()
    {
        return view('super_admin.kelurahan.data', [
            'kelurahan' => Kelurahan::orderBy('id', 'desc')->get(),
            'sesiUser' => Auth::user(),
        ]);
    }

    public function tambahAdminKelurahan()
    {
        return view('super_admin.kelurahan.tambah', [
            'sesiUser' => Auth::user(),
        ]);
    }

    public function prosesTambahAdminKelurahan(Request $request)
    {
        $validatedData = $request->validate(
            [
                'nama' => 'required',
                'kelurahan' => 'required',
                'kecamatan' => 'required',
                'kota' => 'required',
                'provinsi' => 'required',
                'password' => 'required|min:6'
            ],
            [
                'nama.required' => 'Field nama tidak boleh kosong..!!',
                'kelurahan.required' => 'Field kelurahan tidak boleh kosong..!!',
                'kecamatan.required' => 'Field kecamatan tidak boleh kosong..!!',
                'password.required' => 'Field password tidak boleh kosong..!!',
                'password.min' => 'Password minimal 6 karakter..!!',
            ]
        );


        $validatedData['password'] = Hash::make($validatedData['password']);
        $username = Helper::UserNameGenerator(new Kelurahan, 'username', 5, 'KEL');

        Kelurahan::create([
            'username' => $username,
            'nama' => strtoupper($validatedData['nama']),
            'kelurahan' => strtoupper($validatedData['kelurahan']),
            'kecamatan' => strtoupper($validatedData['kecamatan']),
            'kota' => $validatedData['kota'],
            'provinsi' => $validatedData['provinsi'],
        ]);

        User::create([
            'username' => $username,
            'nama' => strtoupper($validatedData['nama']),
            'password' => $validatedData['password'],
            'level' => 4,
        ]);

        return redirect('admin/daftar-admin-kelurahan')->with('success', 'Berhasil menambahkan admin kelurahan.');
    }

    public function editAdminKelurahan($username)
    {
        return view('super_admin.kelurahan.edit', [
            'kelurahan' => $this->Kelurahan->dataByUsername($username),
            'user' => $this->User->dataByUsername($username),
            'sesiUser' => Auth::user(),
        ]);
    }

    public function prosesEditAdminKelurahan(Request $request, $username)
    {
        $validatedData = $request->validate(
            [
                'nama' => 'required',
                'kelurahan' => 'required',
                'kecamatan' => 'required',
                'kota' => 'required',
                'provinsi' => 'required',
            ],
            [
                'nama.required' => 'Field nama tidak boleh kosong..!!',
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

        Kelurahan::where('username', $username)->update([
            'nama' => strtoupper($validatedData['nama']),
            'kelurahan' => strtoupper($validatedData['kelurahan']),
            'kecamatan' => strtoupper($validatedData['kecamatan']),
            'kota' => strtoupper($validatedData['kota']),
            'provinsi' => strtoupper($validatedData['provinsi']),
        ]);

        User::where('username', $username)->update([
            'nama' => strtoupper($validatedData['nama']),
            'password' => $pass
        ]);

        return redirect('admin/daftar-admin-kelurahan')->with('success', 'Berhasil diubah.');
    }

    public function hapusAdminKelurahan($username)
    {
        $this->Kelurahan->DeleteData($username);
        $this->User->DeleteData($username);

        return redirect('admin/daftar-admin-kelurahan')->with('success', 'Berhasil dihapus.');
    }
}
