<!-- Navbar -->
<nav class="main-header navbar navbar-expand-md navbar-dark navbar-cyan">
    <div class="container">
        <a href="{{ asset('/') }}" class="navbar-brand">
            <img src="{{ asset('/') }}logo/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                style="opacity: .8">
            <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{{ url('/') }}" class="nav-link">Home</a>
                </li>

            </ul>

            <!-- Right navbar links -->
            <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                        class="nav-link dropdown-toggle">

                        @if ($sesiUser->level == 1)
                        SUPER ADMIN
                        @elseif($sesiUser->level == 2)
                        ADMIN RT
                        @elseif($sesiUser->level == 3)
                        ANGGOTA DASAWISMA
                        @endif

                        : {{ $sesiUser->nama
                        }}</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <li>
                            <a href="{{ url('logout') }}" class="dropdown-item">
                                <i class="fas fa-sign-out-alt"></i> Keluar
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>


    </div>
</nav>
<!-- /.navbar -->