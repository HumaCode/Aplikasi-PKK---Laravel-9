<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kecamatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'nama',
        'kecamatan',
        'kota',
        'provinsi',
    ];


    public function dataByUsername($username)
    {
        return DB::table('kecamatans')->where('username', $username)->first();
    }

    public function DeleteData($username)
    {
        DB::table('kecamatans')->where('username', $username)->delete();
    }
}
