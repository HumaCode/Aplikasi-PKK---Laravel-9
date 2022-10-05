@extends('layout.main')


@section('judul')
Edit Akun <span class="text-danger">{{ $adminRt->nama }}</span>
@endsection



@section('content')
<div class="col-md-12">

    <div class="card card-cyan card-outline">
        <div class="card-body">

            <form action="{{ url('/admin/proses-edit-admin/' . $adminRt->username) }}" method="post">
                @method('put')
                @csrf

                <input type="hidden" name="passLama" value="{{ $user->password }}">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                                id="nama" placeholder="Masukan Nama" value="{{ old('nama', $adminRt->nama) }}">
                            @error('nama')
                            <div class="invalid-feedback">
                                <div class="ml-1">{{ $message }}</div>
                            </div>
                            @enderror
                        </div>

                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="dusun">RT/Dusun</label>
                            <input type="number" min="0" name="dusun"
                                class="form-control @error('dusun') is-invalid @enderror" id="dusun"
                                placeholder="Masukan Dusun" value="{{ old('dusun', $adminRt->dusun) }}">
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
                                value="{{ old('rw', $adminRt->rw) }}">
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
                                value="{{ old('kelurahan', $adminRt->kelurahan) }}">
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
                                value="{{ old('kecamatan', $adminRt->kecamatan) }}">
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
                            <input type="text" class="form-control @error('kota') is-invalid @enderror" name="kota"
                                id="kota" placeholder="Masukan Kota" value="{{ old('kota', $adminRt->kota) }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="provinsi">Provinsi</label>
                            <input type="text" class="form-control @error('provinsi') is-invalid @enderror"
                                name="provinsi" id="provinsi" placeholder="Masukan Provinsi"
                                value="{{ old('provinsi', $adminRt->provinsi) }}" readonly>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                        id="password" placeholder="Masukan Password">
                    <small class="text-danger">* jika password tidak diubah, maka kosongkan</small><br>
                    <small class="text-danger">* jika ingin mengubah password, minimal 6 karakter</small>
                </div>


                <button type="submit" class="btn bg-cyan"><i class="fas fa-pencil-alt"></i>&nbsp; UBAH</button>
                <a href="{{ url('admin/daftar-admin') }}" class="btn btn-danger"><i class="fas fa-ban"></i>&nbsp;
                    KEMBALI</a>
            </form>

        </div>
    </div><!-- /.card -->
</div>
@endsection