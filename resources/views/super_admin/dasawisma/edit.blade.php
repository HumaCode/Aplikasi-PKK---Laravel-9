@extends('layout.main')


@section('judul')
Edit Akun Dasawisma
@endsection



@section('content')
<div class="col-md-12">

    <div class="card card-cyan card-outline">
        <div class="card-body">

            <form action="{{ url('admin/proses-edit/' . $kader->username) }}" method="post">
                @method('put')
                @csrf

                <input type="hidden" name="passLama" value="{{ $user->password }}">

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                                id="nama" placeholder="Masukan Nama" value="{{ old('nama', $kader->nama) }}">
                            @error('nama')
                            <div class="invalid-feedback">
                                <div class="ml-1">{{ $message }}</div>
                            </div>
                            @enderror
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="dusun">RT/Dusun</label>
                            <input type="number" min="0" name="dusun"
                                class="form-control @error('dusun') is-invalid @enderror" id="dusun"
                                placeholder="Masukan Dusun" value="{{ old('dusun', $kader->dusun) }}">
                            @error('dusun')
                            <div class="invalid-feedback">
                                <div class="ml-1">{{ $message }}</div>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kelurahan">Kelurahan</label>
                            <input type="text" class="form-control @error('kelurahan') is-invalid @enderror"
                                name="kelurahan" id="kelurahan" placeholder="Masukan Kelurahan"
                                value="{{ old('kelurahan', $kader->kelurahan) }}">
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
                                value="{{ old('kecamatan', $kader->kecamatan) }}">
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
                                id="kota" placeholder="Masukan Kota" value="{{ old('kota', $kader->kota) }}">
                            @error('kota')
                            <div class="invalid-feedback">
                                <div class="ml-1">{{ $message }}</div>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="provinsi">Provinsi</label>
                            <input type="text" class="form-control @error('provinsi') is-invalid @enderror"
                                name="provinsi" id="provinsi" placeholder="Masukan Provinsi"
                                value="{{ old('provinsi', $kader->provinsi) }}">
                            @error('provinsi')
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
                            <label for="dasawisma">Dasawisma</label>
                            <input type="text" class="form-control @error('dasawisma') is-invalid @enderror"
                                name="dasawisma" id="dasawisma" placeholder="Masukan Dasawisma"
                                value="{{ old('dasawisma', $kader->dasawisma) }}">
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
                                name="password" id="password" placeholder="Masukan Password">
                            <small class="text-danger">* jika password tidak diubah maka kosongkan</small>
                            @error('password')
                            <div class="invalid-feedback">
                                <div class="ml-1">{{ $message }}</div>
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn bg-cyan">Submit</button>
            </form>

        </div>
    </div><!-- /.card -->
</div>
@endsection