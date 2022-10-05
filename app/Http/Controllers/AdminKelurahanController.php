<?php

namespace App\Http\Controllers;

use App\Models\Kelurahan;
use App\Models\Rt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminKelurahanController extends Controller
{
    public function __construct()
    {
        $this->Kelurahan = new Kelurahan();
    }

    public function index()
    {
        $user       = Auth::user();
        $username   = $user->username;
        $kelurahan  = $this->Kelurahan->dataByUsername($username);
        $kel        = $kelurahan->kelurahan;


        return view('admin_kelurahan.kelurahan.data', [
            'rt' => Rt::where('kelurahan', $kel)->orderBy('id', 'desc')->get(),
            'sesiUser' => $user,
        ]);
    }
}
