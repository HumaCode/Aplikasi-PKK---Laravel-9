@extends('layout.main')


@section('judul')
Daftar Admin Kecamatan
@endsection


@section('content')
<div class="col-md-12">

    <div class="card card-cyan card-outline">
        <div class="card-header">
            <a href="{{ url('admin/tambah-admin-kecamatan') }}" class="btn bg-cyan btn-sm"><i
                    class="fas fa-plus"></i>&nbsp;
                Tambah</a>
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
                        <th>Username</th>
                        <th>Nama</th>
                        <th>Kecamatan</th>
                        <th>Kota</th>
                        <th>Provinsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($kecamatan as $data)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}.</td>
                        <td>{{ $data->username }}</td>
                        <td>{{ $data->nama }}</td>
                        <td>{{ $data->kecamatan }}</td>
                        <td>{{ $data->kota }}</td>
                        <td>{{ $data->provinsi }}</td>

                        <td>
                            <a href="/admin/edit-admin-kecamatan/{{ $data->username }}" class="badge bg-warning"><span
                                    data-feather="edit"><i class="fas fa-pencil-alt"></i>&nbsp; Edit</span></a>
                            <form action="/admin/hapus-admin-kecamatan/{{ $data->username }}" method="post"
                                class="d-inline">
                                @method('delete')
                                @csrf
                                <button class="badge bg-danger border-0"
                                    onclick="return confirm('Anda yakin akan menghapus data ini.?')"><span
                                        data-feather="trash"><i class="fas fa-trash"></i>&nbsp; Hapus</span></button>
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