<?php

namespace App\Http\Controllers;

use App\Models\Rt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LayoutController extends Controller
{
    public function __construct()
    {
        $this->Rt = new Rt();
    }

    public function index()
    {
        $user = Auth::user();
        $username = $user->username;
        $adminRt = $this->Rt->dataByUsername($username);

        if ($user->level == 1) {


            return view('layout.home', [
                'sesiUser' => $user,
                'rt'        => $adminRt,
                'jmlAdmin' => DB::table('rts')->count(),
                'jmlDasawisma' => DB::table('kaders')->count(),
            ]);
        } else  if ($user->level == 3) {

            return view('layout.home', [
                'sesiUser' => $user,
                'jmlAdmin' => DB::table('rts')->count(),
                'jmlDasawisma' => DB::table('kaders')->count(),
            ]);
        }

        $dusun = $adminRt->dusun;

        return view('layout.home', [
            'sesiUser' => $user,
            'rt'        => $adminRt,
            'jmlAdmin' => DB::table('rts')->count(),
            'jmlAdmin2' => DB::table('rts')->where('dusun', $dusun)->count(),
            'jmlDasawisma' => DB::table('kaders')->count(),
        ]);
    }
}
