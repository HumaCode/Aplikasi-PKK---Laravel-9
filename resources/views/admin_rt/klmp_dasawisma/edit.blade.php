@extends('layout.main')


@section('judul')
Edit Kelompok Dasawisma
@endsection



@section('content')
<div class="col-md-12">

    <div class="card card-cyan card-outline">
        <div class="card-body">

            <form action="{{ url('admin2/proses-edit-kelompok-dasawisma/' . $klmp_dasawisma->id) }}" method="post">
                @method('put')
                @csrf


                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="rt">RT</label>
                            <input type="number" min="0" name="rt" class="form-control" id="rt" placeholder="Masukan rt"
                                value="{{ old('rt', $userRt->dusun) }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="rw">RW</label>
                            <input type="number" min="0" name="rw" class="form-control" id="rw" placeholder="Masukan Rw"
                                value="{{ old('rw', $userRt->rw) }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kelurahan">Kelurahan</label>
                            <input type="text" class="form-control" name="kelurahan" id="kelurahan"
                                placeholder="Masukan Kelurahan" value="{{ old('kelurahan', $userRt->kelurahan) }}"
                                readonly>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kecamatan">Kecamatan</label>
                            <input type="text" class="form-control" name="kecamatan" id="kecamatan"
                                placeholder="Masukan Kecamatan" value="{{ old('kecamatan', $userRt->kecamatan) }}"
                                readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kota">Kota</label>
                            <input type="text" class="form-control " name="kota" id="kota" placeholder="Masukan Kota"
                                value="{{ old('kota', $userRt->kota) }}" readonly>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="provinsi">Provinsi</label>
                            <input type="text" class="form-control " name="provinsi" id="provinsi"
                                placeholder="Masukan Provinsi" value="{{ old('provinsi', $userRt->provinsi) }}"
                                readonly>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="dasawisma">Dasawisma</label>
                            <input type="text" class="form-control @error('dasawisma') is-invalid @enderror"
                                name="dasawisma" id="dasawisma" placeholder="Masukan Kelompok Dasawisma"
                                value="{{ old('dasawisma', $klmp_dasawisma->dasawisma) }}" autofocus>
                            @error('dasawisma')
                            <div class="invalid-feedback">
                                <div class="ml-1">{{ $message }}</div>
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>


                <button type="submit" class="btn bg-cyan"><i class="fas fa-pencil-alt"></i>&nbsp; UBAH</button>
                <a href="{{ url('admin2/daftar-admin') }}" class="btn btn-danger"><i class="fas fa-ban"></i>&nbsp;
                    KEMBALI</a>
            </form>

        </div>
    </div><!-- /.card -->
</div>
@endsection