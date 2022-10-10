@extends('layout.main')


@section('judul')
Tambah Akun Dasawisma
@endsection



@section('content')
<div class="col-md-12">

    <div class="card card-cyan card-outline">
        <div class="card-body">

            <form action="{{ url('/admin/proses-tambah') }}" method="post">
                @csrf

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                                id="nama" placeholder="Masukan Nama" value="{{ old('nama') }}">
                            @error('nama')
                            <div class="invalid-feedback">
                                <div class="ml-1">{{ $message }}</div>
                            </div>
                            @enderror
                        </div>

                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="rt">RT</label>
                            <input type="number" min="0" name="rt"
                                class="form-control @error('rt') is-invalid @enderror" id="rt" placeholder="Masukan Rt"
                                value="{{ old('rt') }}">
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
                            <label for="kelurahan">Kelurahan</label>
                            <input type="text" class="form-control @error('kelurahan') is-invalid @enderror"
                                name="kelurahan" id="kelurahan" placeholder="Masukan Kelurahan"
                                value="{{ old('kelurahan') }}">
                            @error('kelurahan')
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
                            <label for="kota">Kota</label>
                            <input type="text" class="form-control" name="kota" id="kota" placeholder="Masukan Kota"
                                value="PEKALONGAN" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="provinsi">Provinsi</label>
                            <input type="text" class="form-control" name="provinsi" id="provinsi"
                                placeholder="Masukan Provinsi" value="JAWA TENGAH" readonly>

                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="dasawisma">Dasawisma</label>
                            <select name="dasawisma" id="dasawisma"
                                class="form-control @error('dasawisma') is-invalid @enderror" name="dasawisma">
                                <option selected disabled>-- Pilih --</option>

                                @foreach ($klmDasa as $item)
                                <option value="{{ $item->id }}">{{ $item->dasawisma }} | kel. {{ $item->kelurahan }} |
                                    {{
                                    $item->rt . '/' .
                                    $item->rw}}</option>
                                @endforeach
                            </select>
                            @error('dasawisma')
                            <div class="invalid-feedback">
                                <div class="ml-1">{{ $message }}</div>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
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

                <button type="submit" class="btn bg-cyan"><i class="fas fa-plus"></i>&nbsp; Tambah</button>
                <a href="{{ url('admin/daftar-admin') }}" class="btn btn-danger"> <i class="fas fa-ban"></i>&nbsp;
                    Kembali</a>
            </form>

        </div>
    </div><!-- /.card -->
</div>
@endsection