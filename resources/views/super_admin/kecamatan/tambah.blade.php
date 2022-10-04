@extends('layout.main')


@section('judul')
Tambah Admin Kecamatan
@endsection



@section('content')
<div class="col-md-12">

    <div class="card card-cyan card-outline">
        <div class="card-body">

            <form action="{{ url('/admin/proses-tambah-admin-kecamatan') }}" method="post">
                @csrf

                <div class="row">
                    <div class="col-md-4">
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

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kecamatan">Kecamatan</label>
                            <input type="text" class="form-control @error('kecamatan') is-invalid @enderror"
                                name="kecamatan" id="kecamatan" placeholder="Masukan Kecamatan"
                                value="{{ old('kecamatan') }}">
                            @error('kecamatan')
                            <div class="invalid-feedback">
                                <div class="ml-1">{{ $message }}</div>
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
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

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kota">Kabupaten/Kota</label>
                            <input type="text" class="form-control" name="kota" id="kota" placeholder="Masukan Kota"
                                value="PEKALONGAN" readonly>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="provinsi">Provinsi</label>
                            <input type="text" class="form-control" name="provinsi" id="provinsi"
                                placeholder="Masukan Provinsi" value="JAWA TENGAH" readonly>
                        </div>
                    </div>


                </div>




                <button type="submit" class="btn bg-cyan"><i class="fas fa-plus"></i>&nbsp; Tambah</button>
                <a href="{{ url('admin/daftar-admin-kecamatan') }}" class="btn btn-danger"> <i
                        class="fas fa-ban"></i>&nbsp;
                    Kembali</a>
            </form>

        </div>
    </div><!-- /.card -->
</div>
@endsection