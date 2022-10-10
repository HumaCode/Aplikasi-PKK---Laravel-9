@extends('layout.main')


@section('judul')
Daftar Kelompok Dasawisma
@endsection


@section('content')
<div class="col-md-12">

    <div class="card card-cyan card-outline">
        <div class="card-header">
            <a href="{{ url('admin2/tambah-kelompok-dasawisma') }}" class="btn bg-cyan btn-sm"><i
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
                        <th>Kelompok Dasawisma</th>
                        <th>RT</th>
                        <th>RW</th>
                        <th>Kelurahan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($klmp_dasawisma as $data)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}.</td>
                        <td>{{ $data->dasawisma }}</td>
                        <td>{{ $data->rt }}</td>
                        <td>{{ $data->rw }}</td>
                        <td>{{ $data->kelurahan }}</td>

                        <td>
                            <a href="/admin2/edit-kelompok-dasawisma/{{ $data->id }}" class="badge bg-warning"><span
                                    data-feather="edit"><i class="fas fa-pencil-alt"></i>&nbsp; Edit</span></a>
                            <form action="/admin2/hapus-kelompok-dasawisma/{{ $data->id }}" method="post"
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