@extends('layout.main')

@section('judul')
Menu Utama
@endsection


@section('content')
<div class="col-lg-12">
    <div class="card p-5">
        <img class="m-auto img-fluid" src="{{ asset('/') }}/logo/logo.png" alt="" width="250"><br>
        <strong class="text-center" style="font-size: 30px">{{ config('app.name') }}</strong>
        <p class="text-center" style="color: #737373">APLIKASI TP PKK KOTA PEKALONGAN</p>
    </div>
</div>




@if ($sesiUser->level == 1)
<div class="col-lg-12">
    <div class="card card-cyan card-outline">
        <div class="card-body">
            <div class="row">

                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $jmlAdmin }}</h3>


                            <p>Akun Admin per RT</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="admin/daftar-admin" class="small-box-footer">Lihat <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $jmlDasawisma }}</h3>

                            <p>Akun Dasawisma</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-sitemap"></i>
                        </div>
                        <a href="{{ url('admin/daftar-dasawisma') }}" class="small-box-footer">Lihat <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>150</h3>

                            <p>Kader</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-file"></i>
                        </div>
                        <a href="#" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@elseif($sesiUser->level == 2)
<div class="col-lg-12">
    <div class="card card-cyan card-outline">
        <div class="card-body">

            <div class="row">
                <div class="col-lg-6 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            @if ($sesiUser->level == 1)
                            <h3>{{ $jmlAdmin }}</h3>
                            <p>Akun Admin per RT</p>
                            @elseif($sesiUser->level == 2)
                            <h3>{{ $jmlAdmin2 }}</h3>
                            <p>Akun Admin RT : {{ $rt->dusun }}</p>
                            @endif


                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="admin2/daftar-admin" class="small-box-footer">Lihat <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-6 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $jmlDasawisma }}</h3>

                            <p>Akun Dasawisma</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-sitemap"></i>
                        </div>
                        <a href="{{ url('admin2/daftar-dasawisma') }}" class="small-box-footer">Lihat <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $jmlAdmin }}</h3>


                            <p>Daftar Warga TP PKK (Form 4.14.1A)</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="admin/daftar-admin" class="small-box-footer">Lihat <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-6 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $jmlDasawisma }}</h3>

                            <p>Data Keluarga (Form 4.14.1B)</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-sitemap"></i>
                        </div>
                        <a href="{{ url('admin/daftar-dasawisma') }}" class="small-box-footer">Lihat <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


@elseif($sesiUser->level == 3)
<div class="col-lg-12">
    <div class="card card-cyan card-outline">
        <div class="card-body">
            <div class="row">

                <div class="col-lg-6 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $jmlAdmin }}</h3>


                            <p>Daftar Warga TP PKK (Form 4.14.1A)</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="admin/daftar-admin" class="small-box-footer">Lihat <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-6 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $jmlDasawisma }}</h3>

                            <p>Data Keluarga (Form 4.14.1B)</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-sitemap"></i>
                        </div>
                        <a href="{{ url('admin/daftar-dasawisma') }}" class="small-box-footer">Lihat <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif


@endsection