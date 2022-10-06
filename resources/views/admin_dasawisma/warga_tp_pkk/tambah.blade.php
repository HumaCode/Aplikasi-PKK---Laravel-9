@extends('layout.main')


@section('judul')
Tambah Warga TP PKK
@endsection



@section('content')
<div class="col-md-12">

    <div class="card card-cyan card-outline">
        <div class="card-body">

            <form action="{{ url('/admin-kecamatan/proses-tambah-admin-kelurahan') }}" method="post">
                @csrf

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="rt">RT</label>
                            <input type="text" class="form-control @error('rt') is-invalid @enderror" name="rt" id="rt"
                                placeholder="Masukan Rt" value="{{ $dasawisma->dusun }}" readonly>
                            @error('rt')
                            <div class="invalid-feedback">
                                <div class="ml-1">{{ $message }}</div>
                            </div>
                            @enderror
                        </div>

                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="rw">RW</label>
                            <input type="text" class="form-control @error('rw') is-invalid @enderror" name="rw" id="rw"
                                placeholder="Masukan Rw" value="{{ $dasawisma->rw }}" readonly>
                            @error('rw')
                            <div class="invalid-feedback">
                                <div class="ml-1">{{ $message }}</div>
                            </div>
                            @enderror
                        </div>

                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="kelurahan">Kelurahan/Desa</label>
                            <input type="text" class="form-control @error('kelurahan') is-invalid @enderror"
                                name="kelurahan" id="kelurahan" placeholder="Masukan Kelurahan"
                                value="{{ $dasawisma->kelurahan }}" readonly>
                            @error('kelurahan')
                            <div class="invalid-feedback">
                                <div class="ml-1">{{ $message }}</div>
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="kecamatan">Kecamatan</label>
                            <input type="text" class="form-control @error('kecamatan') is-invalid @enderror"
                                name="kecamatan" id="kecamatan" placeholder="Masukan Kecamatan"
                                value="{{ $dasawisma->kecamatan }}" readonly>
                        </div>
                    </div>

                </div>


                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="kota">Kabupaten/Kota</label>
                            <input type="text" class="form-control" name="kota" id="kota" placeholder="Masukan Kota"
                                value="PEKALONGAN" readonly>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="provinsi">Provinsi</label>
                            <input type="text" class="form-control " name="provinsi" id="provinsi"
                                placeholder="Masukan Provinsi" value="JAWA TENGAH" readonly>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="dasawisma">Dasawisma</label>

                            <select name="dasawisma" id="dasawisma"
                                class="form-control @error('dasawisma') is-invalid @enderror">
                                <option value="">-- Pilih --</option>
                            </select>

                            @error('dasawisma')
                            <div class="invalid-feedback">
                                <div class="ml-1">{{ $message }}</div>
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="stts_dlm_keluarga">Status Dalam Keluarga</label>

                            <select name="stts_dlm_keluarga" id="stts_dlm_keluarga"
                                class="form-control @error('stts_dlm_keluarga') is-invalid @enderror">
                                <option value="">-- Pilih --</option>
                                <option value="Kepala Keluarga">Kepala Keluarga</option>
                            </select>

                            @error('stts_dlm_keluarga')
                            <div class="invalid-feedback">
                                <div class="ml-1">{{ $message }}</div>
                            </div>
                            @enderror
                        </div>
                    </div>


                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="no_reg">No. Regristrasi</label>
                            <input type="number" min="0" class="form-control @error('no_reg') is-invalid @enderror"
                                name="
                                no_reg" id="no_reg" placeholder="Masukan No. Regristrasi">

                            @error('no_reg')
                            <div class="invalid-feedback">
                                <div class="ml-1">{{ $message }}</div>
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="no_ktp">No. KTP/NIK</label>
                            <input type="number" min="0" class="form-control @error('no_ktp') is-invalid @enderror"
                                name="
                                no_ktp" id="no_ktp" placeholder="Masukan No. KTP/NIK">

                            @error('no_ktp')
                            <div class="invalid-feedback">
                                <div class="ml-1">{{ $message }}</div>
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nama_kk">Nama Kepala Rumah Tangga</label>
                            <input type="text" name="nama_kk"
                                class="form-control @error('nama_kk') is-invalid @enderror"
                                placeholder="Masukan Nama Kepala Rumah Tangga">

                            @error('nama_kk')
                            <div class="invalid-feedback">
                                <div class="ml-1">{{ $message }}</div>
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- jabatan --}}
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="kader_pkk">Kader PKK/Dasawisma</label>

                        <select name="kader_pkk" id="kader_pkk"
                            class="form-control @error('kader_pkk') is-invalid @enderror">
                            <option value="">-- Pilih --</option>
                            <option value="Ya">Ya</option>
                            <option value="Tidak">Tidak</option>
                        </select>

                        @error('kader_pkk')
                        <div class="invalid-feedback">
                            <div class="ml-1">{{ $message }}</div>
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="jabatan">Jabatan</label>
                        <input type="text" name="jabatan" class="form-control @error('jabatan') is-invalid @enderror"
                            placeholder="Masukan Jabatan">

                        @error('jabatan')
                        <div class="invalid-feedback">
                            <div class="ml-1">{{ $message }}</div>
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="jk">Jenis Kelamin</label>
                            <select name="jk" id="jk" class="form-control @error('jk') is-invalid @enderror">
                                <option value="">-- Pilih --</option>
                                <option value="L">LAKI-LAKI</option>
                                <option value="P">PEREMPUAN</option>
                            </select>

                            @error('jk')
                            <div class="invalid-feedback">
                                <div class="ml-1">{{ $message }}</div>
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="tmp_lahir">Tempat Lahir</label>
                            <input type="text" class="form-control @error('tmp_lahir') is-invalid @enderror" name="
                                tmp_lahir" id="tmp_lahir" placeholder="Masukan Tempat Lahir">

                            @error('tmp_lahir')
                            <div class="invalid-feedback">
                                <div class="ml-1">{{ $message }}</div>
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="tgl_lahir">Tanggal Lahir</label>
                            <input type="text" class="form-control @error('tgl_lahir') is-invalid @enderror" name="
                                tgl_lahir" id="tgl_lahir" placeholder="Masukan Tanggal Lahir">

                            @error('tgl_lahir')
                            <div class="invalid-feedback">
                                <div class="ml-1">{{ $message }}</div>
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="agama">Agama</label>
                            <select name="agama" id="agama" class="form-control @error('agama') is-invalid @enderror">
                                <option value="">-- Pilih --</option>
                                <option value="ISLAM">ISLAM</option>
                                <option value="KRISTEN">KRISTEN</option>
                                <option value="KATHOLIK">KATHOLIK</option>
                                <option value="HINDU">HINDU</option>
                                <option value="BUDHA">BUDHA</option>
                                <option value="KONGHUCHU">KONGHUCHU</option>
                                <option value="LAINNYA">LAINNYA</option>
                            </select>

                            @error('agama')
                            <div class="invalid-feedback">
                                <div class="ml-1">{{ $message }}</div>
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="stts_perkawinan">Status Perkawinan</label>
                            <select name="stts_perkawinan" id="stts_perkawinan"
                                class="form-control @error('stts_perkawinan') is-invalid @enderror">
                                <option value="">-- Pilih --</option>
                                <option value="MENIKAH">MENIKAH</option>
                                <option value="LAJANG">LAJANG</option>
                                <option value="JANDA">JANDA</option>
                                <option value="DUDA">DUDA</option>
                            </select>

                            @error('stts_perkawinan')
                            <div class="invalid-feedback">
                                <div class="ml-1">{{ $message }}</div>
                            </div>
                            @enderror
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="pendidikan">Pendidikan</label>
                            <select name="pendidikan" id="pendidikan"
                                class="form-control @error('pendidikan') is-invalid @enderror">
                                <option value="">-- Pilih --</option>
                                <option value="TIDAK TAMAT SD">TIDAK TAMAT SD</option>
                                <option value="SD/MI">SD/MI</option>
                                <option value="SMP/Sederajat">SMP/Sederajat</option>
                                <option value="SMU/SMK Sederajat">SMU/SMK Sederajat</option>
                            </select>

                            @error('pendidikan')
                            <div class="invalid-feedback">
                                <div class="ml-1">{{ $message }}</div>
                            </div>
                            @enderror
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="pekerjaan">Pekerjaan</label>
                            <select name="pekerjaan" id="pekerjaan"
                                class="form-control @error('pekerjaan') is-invalid @enderror">
                                <option value="">-- Pilih --</option>
                                <option value="PETANI">PETANI</option>
                                <option value="PEDAGANG">PEDAGANG</option>
                                <option value="SWASTA">SWASTA</option>
                                <option value="WIRAUSAHA">WIRAUSAHA</option>
                                <option value="PNS">PNS</option>
                                <option value="TNI/POLRI">TNI/POLRI</option>
                                <option value="LAINNYA">LAINNYA</option>
                            </select>

                            @error('pekerjaan')
                            <div class="invalid-feedback">
                                <div class="ml-1">{{ $message }}</div>
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>


                <div class="col-md-12">
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="
                            alamat" id="alamat" placeholder="Masukan Alamat">

                        @error('alamat')
                        <div class="invalid-feedback">
                            <div class="ml-1">{{ $message }}</div>
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="aktif_kegiatan_posyandu">Aktif dalam Kegiatan Posyandu</label>
                            <select name="aktif_kegiatan_posyandu" id="aktif_kegiatan_posyandu"
                                class="form-control @error('aktif_kegiatan_posyandu') is-invalid @enderror">
                                <option value="">-- Pilih --</option>
                                <option value="YA">YA</option>
                                <option value="TIDAK">TIDAK</option>
                            </select>

                            @error('aktif_kegiatan_posyandu')
                            <div class="invalid-feedback">
                                <div class="ml-1">{{ $message }}</div>
                            </div>
                            @enderror
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="akseptor_kb">Akseptor KB</label>
                            <select name="akseptor_kb" id="akseptor_kb"
                                class="form-control @error('akseptor_kb') is-invalid @enderror">
                                <option value="">-- Pilih --</option>
                                <option value="YA">YA</option>
                                <option value="TIDAK">TIDAK</option>
                            </select>

                            @error('akseptor_kb')
                            <div class="invalid-feedback">
                                <div class="ml-1">{{ $message }}</div>
                            </div>
                            @enderror
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="program_bina_keluarga_balita">Mengikuti Program Bina Keluarga Balita</label>
                            <select name="program_bina_keluarga_balita" id="program_bina_keluarga_balita"
                                class="form-control @error('program_bina_keluarga_balita') is-invalid @enderror">
                                <option value="">-- Pilih --</option>
                                <option value="YA">YA</option>
                                <option value="TIDAK">TIDAK</option>
                            </select>

                            @error('program_bina_keluarga_balita')
                            <div class="invalid-feedback">
                                <div class="ml-1">{{ $message }}</div>
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="memiliki_tabungan">Memiliki Tabungan</label>
                            <select name="memiliki_tabungan" id="memiliki_tabungan"
                                class="form-control @error('memiliki_tabungan') is-invalid @enderror">
                                <option value="">-- Pilih --</option>
                                <option value="YA">YA</option>
                                <option value="TIDAK">TIDAK</option>
                            </select>

                            @error('memiliki_tabungan')
                            <div class="invalid-feedback">
                                <div class="ml-1">{{ $message }}</div>
                            </div>
                            @enderror
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="mengikuti_paud">Mengikuti PAUD/Sejenis</label>
                            <select name="mengikuti_paud" id="mengikuti_paud"
                                class="form-control @error('mengikuti_paud') is-invalid @enderror">
                                <option value="">-- Pilih --</option>
                                <option value="YA">YA</option>
                                <option value="TIDAK">TIDAK</option>
                            </select>

                            @error('mengikuti_paud')
                            <div class="invalid-feedback">
                                <div class="ml-1">{{ $message }}</div>
                            </div>
                            @enderror
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="ikut_kegiatan_koperasi">Ikut Dalam Kegiatan Koperasi</label>
                            <select name="ikut_kegiatan_koperasi" id="ikut_kegiatan_koperasi"
                                class="form-control @error('ikut_kegiatan_koperasi') is-invalid @enderror">
                                <option value="">-- Pilih --</option>
                                <option value="YA">YA</option>
                                <option value="TIDAK">TIDAK</option>
                            </select>

                            @error('ikut_kegiatan_koperasi')
                            <div class="invalid-feedback">
                                <div class="ml-1">{{ $message }}</div>
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="meengikuti_klm_bljr">Mengikuti Kelompok Belajar</label>
                            <select name="meengikuti_klm_bljr" id="meengikuti_klm_bljr"
                                class="form-control @error('meengikuti_klm_bljr') is-invalid @enderror">
                                <option value="">-- Pilih --</option>
                                <option value="YA">YA</option>
                                <option value="TIDAK">TIDAK</option>
                            </select>

                            @error('meengikuti_klm_bljr')
                            <div class="invalid-feedback">
                                <div class="ml-1">{{ $message }}</div>
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="jenis">Jenis</label>
                        <input type="text" class="form-control @error('jenis') is-invalid @enderror" name="
                            jenis" id="jenis" placeholder="Masukan Jenis">

                        @error('jenis')
                        <div class="invalid-feedback">
                            <div class="ml-1">{{ $message }}</div>
                        </div>
                        @enderror
                    </div>
                </div>


                <button type="submit" class="btn bg-cyan"><i class="fas fa-plus"></i>&nbsp; Tambah</button>
                <a href="{{ url('admin-kecamatan/daftar-admin-kelurahan') }}" class="btn btn-danger"> <i
                        class="fas fa-ban"></i>&nbsp;
                    Kembali</a>
            </form>

        </div>
    </div><!-- /.card -->
</div>
@endsection