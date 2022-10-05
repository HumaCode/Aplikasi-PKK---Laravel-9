<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Rt extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'nama',
        'dusun',
        'rw',
        'kelurahan',
        'kota',
        'provinsi',
        'kecamatan'
    ];

    public function dataByUsername($username)
    {
        return DB::table('rts')->where('username', $username)->first();
    }

    public function DeleteData($username)
    {
        DB::table('rts')->where('username', $username)->delete();
    }
}
