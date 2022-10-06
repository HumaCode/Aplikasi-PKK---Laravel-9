<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warga_k_k_s', function (Blueprint $table) {
            $table->id();
            $table->string('no_reg');
            $table->string('no_ktp');
            $table->string('nama_kk');
            $table->string('nama');
            $table->string('dasawisma');
            $table->string('kader_pkk');
            $table->string('jabatan');
            $table->string('jk');
            $table->string('tmp_lahir');
            $table->string('tgl_lahir');
            $table->string('umur');
            $table->string('stts_perkawinan');
            $table->string('stts_dlm_keluarga');
            $table->string('agama');
            $table->string('alamat');
            $table->string('rt');
            $table->string('rw');
            $table->string('kelurahan');
            $table->string('kecamatan');
            $table->string('kabupaten');
            $table->string('kota');
            $table->string('provinsi');
            $table->string('pendidikan');
            $table->string('pekerjaan');
            $table->string('akseptor_kb');
            $table->string('aktif_kegiatan_posyandu');
            $table->string('program_bina_keluarga_balita');
            $table->string('memiliki_tabungan');
            $table->string('meengikuti_klm_bljr');
            $table->string('jenis');
            $table->string('mengikuti_paud');
            $table->string('ikut_kegiatan_koperasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('warga_k_k_s');
    }
};
