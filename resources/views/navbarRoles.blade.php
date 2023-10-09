<nav class="color_barra navbar navbar-expand-lg ">
    <div class="container-fluid">
        <a class="navbar-brand"
            href="{{ url('/Crud') }}/{{ request('token') }}?email={{ request('email') }}&token={{ request('token') }}">
            <img width="100" class="img-thumbnail rounder-circle" src="{{ asset('images/LOGO_UTEQ2022_COMPLETO.png') }}"
                alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="bi bi-list"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="text-white nav-link" aria-current="page"
                        href="{{ url('/Crud') }}/{{ request('token') }}?email={{ request('email') }}&token={{ request('token') }}">
                        <i class="bi bi-house me-1"></i>Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="text-white nav-link" aria-current="page"
                        href="{{ url('/home') }}/{{ request('token') }}?email={{ request('email') }}&token={{ request('token') }}">
                        <i class="bi bi-archive me-1"></i>Produción
                    </a>
                </li>
                <li class="nav-item">
                    <a class="text-white nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="text-white nav-link " aria-disabled="true">Disabled</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="text-white nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="bi bi-person-fill-gear h5"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#"><i class="bi bi-eye-slash me-1"></i>Password</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-person me-1"></i>My información</a></li>
                        <hr class="dropdown-divider">
                        <li><button id="salir" class="dropdown-item" type="submit"><i class="bi bi-box-arrow-in-right me-1"></i>Salir</button></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
