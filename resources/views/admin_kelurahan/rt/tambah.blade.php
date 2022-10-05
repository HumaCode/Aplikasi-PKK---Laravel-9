@extends('layout.main')


@section('judul')
Tambah Akun RT
@endsection



@section('content')
<div class="col-md-12">

    <div class="card card-cyan card-outline">
        <div class="card-body">

            <form action="{{ url('/admin-kelurahan/proses-tambah-admin-rt') }}" method="post">
                @csrf

                <div class="row">
                    <div class="col-md-3">
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
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="dusun">RT</label>
                            <input type="number" min="0" name="dusun"
                                class="form-control @error('dusun') is-invalid @enderror" id="dusun"
                                placeholder="Masukan Rt" value="{{ old('dusun') }}">
                            @error('dusun')
                            <div class="invalid-feedback">
                                <div class="ml-1">{{ $message }}</div>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="rw">RW</label>
                            <input type="number" min="0" name="rw"
                                class="form-control @error('rw') is-invalid @enderror" id="rw" placeholder="Masukan rw"
                                value="{{ old('rw') }}">
                            @error('rw')
                            <div class="invalid-feedback">
                                <div class="ml-1">{{ $message }}</div>
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-3">
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


                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="kelurahan">Kelurahan</label>
                            <input type="text" class="form-control" name="kelurahan" id="kelurahan"
                                placeholder="Masukan Kelurahan" value="{{ $kel->kelurahan }}" readonly>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="kecamatan">Kecamatan</label>
                            <input type="text" class="form-control" name="kecamatan" id="kecamatan"
                                placeholder="Masukan Kecamatan" value="{{ $kel->kecamatan }}" readonly>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="kota">Kota</label>
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
                </div>




                <button type="submit" class="btn bg-cyan"><i class="fas fa-plus"></i>&nbsp; TAMBAH</button>
                <a href="{{ url('admin-kelurahan/daftar-admin-rt') }}" class="btn btn-danger"><i
                        class="fas fa-ban"></i>&nbsp;
                    KEMBALI</a>
            </form>

        </div>
    </div><!-- /.card -->
</div>
@endsection