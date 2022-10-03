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
        'dusun',
        'kelurahan',
        'kota',
        'provinsi',
        'dasawisma',
        'kecamatan'
    ];

    public function dataByUsername($username)
    {
        return DB::table('kaders')->where('username', $username)->first();
    }

    public function DeleteData($username)
    {
        DB::table('kaders')->where('username', $username)->delete();
    }
}
