 <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand pe-3 pt-3" href="index.html">
                <img style="width: 70%;" src="{!! asset('logo.png') !!}" />
            </a>
            <!-- Navbar-->
            <ul class="navbar-nav me-auto ms-3 ms-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-start" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}" 
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">تسجيل الخروج</a>
                        </li>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </ul>
                </li>
            </ul>
        </nav>