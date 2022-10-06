<?php

namespace App\Http\Controllers;

use App\Models\Kader;
use App\Models\WargaKK;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DasawismaController extends Controller
{

    public function __construct()
    {
        $this->Kader = new Kader();
    }


    public function index()
    {
        return view('admin_dasawisma.warga_tp_pkk.data', [
            'sesiUser' => Auth::user(),
            'wargaKK' => WargaKK::orderBy('id', 'desc')->get(),

        ]);
    }

    public function tambahWargaKK()
    {
        $user               = Auth::user();
        $username           = $user->username;
        $dasawisma          = $this->Kader->dataByUsername($username);

        return view('admin_dasawisma.warga_tp_pkk.tambah', [
            'sesiUser'  => $user,
            'dasawisma' => $dasawisma,
        ]);
    }
}
