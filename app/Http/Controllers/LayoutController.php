<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Rt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LayoutController extends Controller
{
    public function __construct()
    {
        $this->Rt = new Rt();
        $this->Kecamatan = new Kecamatan();
        $this->Kelurahan = new Kelurahan();
    }

    public function index()
    {
        $user = Auth::user();
        $username = $user->username;
        $adminRt = $this->Rt->dataByUsername($username);

        // super admin
        if ($user->level == 1) {


            return view('layout.home', [
                'sesiUser' => $user,
                'rt'        => $adminRt,
                'jmlAdminRt' => DB::table('rts')->count(),
                'jmlAdminKec' => DB::table('kecamatans')->count(),
                'jmlAdminKel' => DB::table('kelurahans')->count(),
                'jmlDasawisma' => DB::table('kaders')->count(),
            ]);

            // admin dusun 
        } else if ($user->level == 2) {

            $dusun = $adminRt->dusun;
            $kel = $adminRt->kelurahan;

            return view('layout.home', [
                'sesiUser'  => $user,
                'rt'        => $adminRt,
                'adminRt'   => $dusun,
                'jmlAdmin'  => DB::table('rts')->count(),
                'jmlAdmin2' => DB::table('rts')->where(['dusun' => $dusun, 'kelurahan' => $kel])->count(),
                'jmlDasawisma' => DB::table('kaders')->where(['dusun' => $dusun, 'kelurahan' => $kel])->count(),
            ]);

            // admin dasawisma
        } else  if ($user->level == 3) {

            return view('layout.home', [
                'sesiUser' => $user,
                'jmlAdmin' => DB::table('rts')->count(),
                'jmlDasawisma' => DB::table('kaders')->count(),
            ]);

            // admin kelurahan
        } else if ($user->level == 4) {

            $kelurahan  = $this->Kelurahan->dataByUsername($username);
            return view('layout.home', [
                'sesiUser'      => $user,
                'jmlAdmin'      => DB::table('rts')->count(),
                'jmlDasawisma'  => DB::table('kaders')->count(),
                'kel'           => $kelurahan,
            ]);
        }

        //  akunkecamatan
        else if ($user->level == 5) {

            $kecamatan  = $this->Kecamatan->dataByUsername($username);
            // $kec        = $kecamatan->kecamatan;

            return view('layout.home', [
                'sesiUser'      => $user,
                'kec'           => $kecamatan,
                'jmlAdminKel'   => DB::table('kelurahans')->count(),
            ]);
        }
    }
}
