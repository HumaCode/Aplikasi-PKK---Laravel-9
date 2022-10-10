<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class KlmpDasawisma extends Model
{
    use HasFactory;

    protected $fillable = [
        'dasawisma',
        'rt',
        'rw',
        'kelurahan',
        'kecamatan',
        'kota',
        'provinsi',
    ];


    public function dataById($id)
    {
        return DB::table('klmp_dasawismas')->where('id', $id)->first();
    }

    public function DeleteData($id)
    {
        DB::table('klmp_dasawismas')->where('id', $id)->delete();
    }
}
