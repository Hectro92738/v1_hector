<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a
                href="{{ url('/Crud') }}/{{ request('token') }}?email={{ request('email') }}&token={{ request('token') }}&numEmp={{ request('numEmp') }}"class="nav-link"><i
                    class="bi bi-house me-1"></i>Principal
            </a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Perfil</a>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item dropdown">
            <div class="infor">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span id="avatar"></span>
                    <span id="nombre"></span>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item"
                        href="{{ url('/avatar') }}/{{ request('token') }}?email={{ request('email') }}&token={{ request('token') }}&numEmp={{ request('numEmp') }}">
                        <button id="view_avatar" class="infor dropdown-item" type="submit">
                            <i class="bi bi-person-bounding-box me-1"></i>Avatar
                        </button>
                    </a>
                    <a class="dropdown-item" href="#">
                        <button data-bs-toggle="modal" data-bs-target="#drop_sesion" class="infor dropdown-item"
                            type="submit">
                            <i class="bi bi-box-arrow-in-right me-1"></i>Salir
                        </button>
                    </a>
                </div>
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
