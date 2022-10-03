<?php

namespace App\Http\Controllers;

use App\Models\Kader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DasawismaController extends Controller
{

    public function daftarWarga()
    {
        return view('dasawisma.daftar_warga.data', [
            'sesiUser' => Auth::user(),
        ]);
    }
}
