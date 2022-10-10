<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Kader;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\KlmpDasawisma;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->Kecamatan = new Kecamatan();
        $this->Kelurahan = new Kelurahan();
        $this->Kader = new Kader();
        $this->User = new User();
    }

    // admin dasawisma
    public function index()
    {
        return view('super_admin.dasawisma.data', [
            'kaders'    => $this->Kader->getData2(),
            'sesiUser'  => Auth::user(),
        ]);
    }

    public function tambah()
    {
        $klmpDasawisma      = KlmpDasawisma::orderBy('id', 'desc')->get();

        return view('super_admin.dasawisma.tambah', [
            'sesiUser'      => Auth::user(),
            'klmDasa'       => $klmpDasawisma
        ]);
    }

    public function prosesTambah(Request $request)
    {
        $validatedData = $request->validate(
            [
                'nama'      => 'required',
                'rt'        => 'required',
                'rw'        => 'required',
                'kelurahan' => 'required',
                'kecamatan' => 'required',
                'kota'      => 'required',
                'provinsi'  => 'required',
                'dasawisma' => 'required',
                'password'  => 'required|min:6'
            ],
            [
                'nama.required'         => 'Field nama tidak boleh kosong..!!',
                'rt.required'           => 'Field rt tidak boleh kosong..!!',
                'rw.required'           => 'Field rw tidak boleh kosong..!!',
                'kelurahan.required'    => 'Field kelurahan tidak boleh kosong..!!',
                'kecamatan.required'    => 'Field kecamatan tidak boleh kosong..!!',
                'kota.required'         => 'Field kota tidak boleh kosong..!!',
                'provinsi.required'     => 'Field provinsi tidak boleh kosong..!!',
                'dasawisma.required'    => 'Field dasawisma tidak boleh kosong..!!',
                'password.required'     => 'Field password tidak boleh kosong..!!',
                'password.min'          => 'Password minimal 6 karakter..!!',
            ]
        );


        $validatedData['password']  = Hash::make($validatedData['password']);
        $username                   = Helper::UserNameGenerator(new Kader, 'username', 5, 'DSA');

        Kader::create([
            'username'      => $username,
            'nama'          => strtoupper($validatedData['nama']),
            'dusun'         => $validatedData['rt'],
            'rw'            => $validatedData['rw'],
            'kelurahan'     => strtoupper($validatedData['kelurahan']),
            'kecamatan'     => strtoupper($validatedData['kecamatan']),
            'kota'          => strtoupper($validatedData['kota']),
            'provinsi'      => strtoupper($validatedData['provinsi']),
            'id_dasawisma'  => $validatedData['dasawisma'],
        ]);

        User::create([
            'username'  => $username,
            'nama'      => strtoupper($validatedData['nama']),
            'password'  => $validatedData['password'],
            'level'     => 3,
        ]);

        return redirect('admin/daftar-dasawisma')->with('success', 'Berhasil menambahkan data.');
    }

    public function edit($username)
    {
        $klmpDasawisma      = KlmpDasawisma::orderBy('id', 'desc')->get();

        return view('super_admin.dasawisma.edit', [
            'kader'     => $this->Kader->dataByUsername($username),
            'user'      => $this->User->dataByUsername($username),
            'sesiUser'  => Auth::user(),
            'klmDasa'   => $klmpDasawisma
        ]);
    }

    public function prosesEdit(Request $request, $username)
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
                'dasawisma' => 'required'
            ],
            [
                'nama.required'         => 'Field nama tidak boleh kosong..!!',
                'dusun.required'        => 'Field dusun tidak boleh kosong..!!',
                'rw.required'           => 'Field rw tidak boleh kosong..!!',
                'kelurahan.required'    => 'Field kelurahan tidak boleh kosong..!!',
                'kecamatan.required'    => 'Field kecamatan tidak boleh kosong..!!',
                'kota.required'         => 'Field kota tidak boleh kosong..!!',
                'provinsi.required'     => 'Field provinsi tidak boleh kosong..!!',
                'dasawisma.required'    => 'Field dasawisma tidak boleh kosong..!!',
            ]
        );

        if ($request->password == '') {
            $pass = $request->passLama;
        } else {
            $pass = Hash::make($request['password']);
        }

        Kader::where('username', $username)->update([
            'nama'          => strtoupper($validatedData['nama']),
            'dusun'         => $validatedData['dusun'],
            'rw'            => $validatedData['rw'],
            'kelurahan'     => strtoupper($validatedData['kelurahan']),
            'kecamatan'     => strtoupper($validatedData['kecamatan']),
            'kota'          => strtoupper($validatedData['kota']),
            'provinsi'      => strtoupper($validatedData['provinsi']),
            'id_dasawisma'  => $validatedData['dasawisma'],
        ]);

        User::where('username', $username)->update([
            'nama'      => strtoupper($validatedData['nama']),
            'password'  => $pass
        ]);

        return redirect('admin/daftar-dasawisma')->with('success', 'Berhasil diubah.');
    }

    public function hapus($username)
    {
        $this->Kader->DeleteData($username);
        $this->User->DeleteData($username);

        return redirect('/admin/daftar-dasawisma')->with('success', 'Berhasil dihapus.');
    }

    // admin kelurahan
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


    // admin kecamatan
    public function dataAdminKecamatan()
    {
        return view('super_admin.kecamatan.data', [
            'kecamatan' => Kecamatan::orderBy('id', 'desc')->get(),
            'sesiUser' => Auth::user(),
        ]);
    }

    public function tambahAdminKecamatan()
    {
        return view('super_admin.kecamatan.tambah', [
            'sesiUser' => Auth::user(),
        ]);
    }

    public function prosesTambahAdminKecamatan(Request $request)
    {
        $validatedData = $request->validate(
            [
                'nama'      => 'required',
                'kecamatan' => 'required',
                'kota'      => 'required',
                'provinsi'  => 'required',
                'password'  => 'required|min:6'
            ],
            [
                'nama.required'         => 'Field nama tidak boleh kosong..!!',
                'kecamatan.required'    => 'Field kecamatan tidak boleh kosong..!!',
                'password.required'     => 'Field password tidak boleh kosong..!!',
                'password.min'          => 'Password minimal 6 karakter..!!',
            ]
        );


        $validatedData['password'] = Hash::make($validatedData['password']);
        $username = Helper::UserNameGenerator(new Kecamatan, 'username', 5, 'KEC');

        Kecamatan::create([
            'username'      => $username,
            'nama'          => strtoupper($validatedData['nama']),
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

        return redirect('admin/daftar-admin-kecamatan')->with('success', 'Berhasil menambahkan admin kecamatan.');
    }

    public function editAdminKecamatan($username)
    {
        return view('super_admin.kecamatan.edit', [
            'kecamatan' => $this->Kecamatan->dataByUsername($username),
            'user' => $this->User->dataByUsername($username),
            'sesiUser' => Auth::user(),
        ]);
    }

    public function prosesEditAdminKecamatan(Request $request, $username)
    {
        $validatedData = $request->validate(
            [
                'nama'      => 'required',
                'kecamatan' => 'required',
                'kota'      => 'required',
                'provinsi'  => 'required',
            ],
            [
                'nama.required'         => 'Field nama tidak boleh kosong..!!',
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

        Kecamatan::where('username', $username)->update([
            'nama'      => strtoupper($validatedData['nama']),
            'kecamatan' => strtoupper($validatedData['kecamatan']),
            'kota'      => strtoupper($validatedData['kota']),
            'provinsi'  => strtoupper($validatedData['provinsi']),
        ]);

        User::where('username', $username)->update([
            'nama'      => strtoupper($validatedData['nama']),
            'password'  => $pass
        ]);

        return redirect('admin/daftar-admin-kecamatan')->with('success', 'Berhasil diubah.');
    }

    public function hapusAdminKecamatan($username)
    {
        $this->Kecamatan->DeleteData($username);
        $this->User->DeleteData($username);

        return redirect('admin/daftar-admin-kecamatan')->with('success', 'Berhasil dihapus.');
    }
}
