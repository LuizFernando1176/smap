<div class="header " style="background-color: #0b3f72">
    <div class="container">

        <div class="d-flex">
            <!-- LOGO -->
            <div class="main-header-center ms-3 d-none d-lg-block ">
                <a href="{{ url('home') }}">
                    <img src="{{ asset('img/logos.png') }}" class="header-brand-img desktop-logo" alt="logo">
                    <img src="{{ asset('img/logos.png') }}" class="header-brand-img light-logo1" alt="logo">
                </a>
            </div>
            <div class="d-flex order-lg-2 ms-auto header-right-icons">
                <div class="dropdown d-none">
                    <a href="javascript:void(0)" class="nav-link icon" data-bs-toggle="dropdown">
                        <i class="fe fe-search"></i>
                    </a>
                    <div class="dropdown-menu header-search dropdown-menu-start">
                        <div class="input-group w-100 p-2">
                            <input type="text" class="form-control" placeholder="Search....">
                            <div class="input-group-text btn btn-primary">
                                <i class="fe fe-search" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- SEARCH -->
                <button class="navbar-toggler navresponsive-toggler d-lg-none ms-auto" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4"
                    aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon fe fe-more-vertical"></span>
                </button>
                <div class="navbar navbar-collapse responsive-navbar p-0">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                        <div class="d-flex order-lg-2">
                            <div class="dropdown d-lg-none d-flex">
                                <a href="javascript:void(0)" class="nav-link icon" data-bs-toggle="dropdown">
                                    <i class="fe fe-search"></i>
                                </a>
                                <div class="dropdown-menu header-search dropdown-menu-start">
                                    <div class="input-group w-100 p-2">
                                        <input type="text" class="form-control" placeholder="Search....">
                                        <div class="input-group-text btn btn-primary">
                                            <i class="fa fa-search" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- COUNTRY -->

                            @auth
                                <div class="dropdown d-flex profile-1">
                                    <a href="javascript:void(0)" data-bs-toggle="dropdown"
                                        class="nav-link leading-none d-flex">
                                        <img src="{{ asset('img/perfil.png') }}" alt="profile-user"
                                            class="avatar  profile-user brround cover-image">
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">

                                        <div class="drop-heading">
                                            <div class="text-center">
                                                <h5 class="text-dark mb-0 fs-14 fw-semibold">{{ Auth::user()->name }}
                                                </h5>
                                                <small class="text-muted">{{ Auth::user()->email }}</small>
                                            </div>
                                        </div>

                                        <div class="dropdown-divider m-0"></div>
                                        <a class="dropdown-item" href="{{url('perfil')}}/{{Auth::user()->id}}">
                                            <i class="dropdown-icon fe fe-user"></i> Perfil
                                        </a>
                                        <a class="dropdown-item" href="lockscreen.html">
                                            <i class="dropdown-icon fe fe-lock"></i> Tela de Bloqueio
                                        </a>
                                        @if(Auth::user()->nivel == 1)
                                        <a class="dropdown-item" href="{{url('register')}}">
                                            <i class="dropdown-icon fe fe-user"></i> Criar Usuário
                                        </a>
                                        @else
                                        @endif
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                            <i class="dropdown-icon icon icon-logout"></i> {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>

                                    </div>
                                </div>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
