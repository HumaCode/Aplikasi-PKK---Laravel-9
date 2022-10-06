<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WargaKK extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_reg',
        'no_ktp',
        'nama_kk',
        'nama',
        'dasawisma',
        'kader_pkk',
        'jabatan',
        'jk',
        'tmp_lahir',
        'tgl_lahir',
        'umur',
        'stts_perkawinan',
        'stts_dlm_keluarga',
        'agama',
        'alamat',
        'rt',
        'rw',
        'kelurahan',
        'kecamatan',
        'kabupaten',
        'kota',
        'provinsi',
        'pendidikan',
        'pekerjaan',
        'akseptor_kb',
        'aktif_kegiatan_posyandu',
        'program_bina_keluarga_balita',
        'memiliki_tabungan',
        'meengikuti_klm_bljr',
        'jenis',
        'mengikuti_paud',
        'ikut_kegiatan_koperasi',
    ];
}
