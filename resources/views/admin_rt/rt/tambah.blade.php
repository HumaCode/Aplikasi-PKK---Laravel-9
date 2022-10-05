@extends('layout.main')


@section('judul')
Tambah Akun RT
@endsection



@section('content')
<div class="col-md-12">

    <div class="card card-cyan card-outline">
        <div class="card-body">

            <form action="{{ url('admin2/proses-tambah') }}" method="post">
                @csrf

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="dusun">RT</label>
                            <input type="number" min="0" name="dusun" class="form-control" id="dusun"
                                placeholder="Masukan Dusun" value="{{ old('dusun', $dataRt->dusun) }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="rw">RW</label>
                            <input type="number" min="0" name="rw" class="form-control" id="rw" placeholder="Masukan Rw"
                                value="{{ old('rw', $dataRt->rw) }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kelurahan">Kelurahan</label>
                            <input type="text" class="form-control" name="kelurahan" id="kelurahan"
                                placeholder="Masukan Kelurahan" value="{{ old('kelurahan', $dataRt->kelurahan) }}"
                                readonly>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kecamatan">Kecamatan</label>
                            <input type="text" class="form-control" name="kecamatan" id="kecamatan"
                                placeholder="Masukan Kecamatan" value="{{ old('kecamatan', $dataRt->kecamatan) }}"
                                readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kota">Kota</label>
                            <input type="text" class="form-control " name="kota" id="kota" placeholder="Masukan Kota"
                                value="{{ old('kota', $dataRt->kota) }}" readonly>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="provinsi">Provinsi</label>
                            <input type="text" class="form-control " name="provinsi" id="provinsi"
                                placeholder="Masukan Provinsi" value="{{ old('provinsi', $dataRt->provinsi) }}"
                                readonly>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                                id="nama" placeholder="Masukan Nama" value="{{ old('nama') }}" autofocus>
                            @error('nama')
                            <div class="invalid-feedback">
                                <div class="ml-1">{{ $message }}</div>
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" id="password" placeholder="Masukan Password" value="123456">
                            <small class="text-danger">* Password default 123456</small>
                            @error('password')
                            <div class="invalid-feedback">
                                <div class="ml-1">{{ $message }}</div>
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>



                <button type="submit" class="btn bg-cyan"> <i class="fas fa-plus"></i>&nbsp; SIMPAN</button>
                <a href="{{ url('admin2/daftar-admin') }}" class="btn btn-danger"><i class="fas fa-ban"></i>&nbsp;
                    KEMBALI</a>
            </form>

        </div>
    </div><!-- /.card -->
</div>
@endsection