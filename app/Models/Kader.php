<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kader extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'nama',
        'id_dasawisma',
        'dusun',
        'rw',
        'kelurahan',
        'kota',
        'provinsi',
        'kecamatan'
    ];

    public function getData($dusun, $kel)
    {
        return DB::table('kaders')
            ->join('klmp_dasawismas', 'klmp_dasawismas.id', '=', 'kaders.id_dasawisma')
            ->where(['dusun' => $dusun, 'kaders.kelurahan' => $kel])
            ->orderBy('kaders.id', 'desc')
            ->get();
    }

    public function getData2()
    {
        return DB::table('kaders')
            ->join('klmp_dasawismas', 'klmp_dasawismas.id', '=', 'kaders.id_dasawisma')
            ->orderBy('kaders.id', 'desc')
            ->get();
    }

    public function dataByUsername($username)
    {
        return DB::table('kaders')->where('username', $username)->first();
    }

    public function DeleteData($username)
    {
        DB::table('kaders')->where('username', $username)->delete();
    }
}
