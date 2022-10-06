@extends('layout.main')


@section('judul')
Daftar Warga TP PKK
@endsection


@section('content')
<div class="col-md-12">

    <div class="card card-cyan card-outline">
        <div class="card-header">
            <a href="{{ url('admin-dasawisma/tambah-warga') }}" class="btn bg-cyan btn-sm"><i
                    class="fas fa-plus"></i>&nbsp;
                Tambah Data Kepala Rumah Tangga</a>
        </div>
        <div class="card-body">


            {{-- pesan flash --}}
            @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
                {{ session('success') }}
            </div>
            @endif

            <table id="example2" class="table table-bordered table-striped">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Dasawisma</th>
                        <th>No KTP/NIK</th>
                        <th>Nama</th>
                        <th>Jumlah Kehamilan</th>
                        <th>Jumlah Kematian</th>
                        <th>Jumlah Anggota Keluarga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($wargaKK as $data)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}.</td>
                        <td>{{ $data->username }}</td>
                        <td>{{ $data->nama }}</td>
                        <td>{{ $data->dusun }}</td>
                        <td>{{ $data->kelurahan }}</td>
                        <td>{{ $data->kecamatan }}</td>
                        <td>{{ $data->provinsi }}</td>
                        <td>{{ $data->dasawisma }}</td>

                        <td>
                            <a href="/admin/edit-dasawisma/{{ $data->username }}" class="badge bg-warning"><span
                                    data-feather="edit">Edit</span></a>
                            <form action="/admin/hapus/{{ $data->username }}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button class="badge bg-danger border-0"
                                    onclick="return confirm('Anda yakin akan menghapus data ini.?')"><span
                                        data-feather="trash">Hapus</span></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </div><!-- /.card -->
</div>
@endsection