<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kelurahan extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'nama',
        'kelurahan',
        'kota',
        'provinsi',
        'kecamatan'
    ];

    public function dataByUsername($username)
    {
        return DB::table('kelurahans')->where('username', $username)->first();
    }

    public function DeleteData($username)
    {
        DB::table('kelurahans')->where('username', $username)->delete();
    }
}
