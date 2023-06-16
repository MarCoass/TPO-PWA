<header class="sticky-top">
    <nav id="menuHamburguesa" class="navbar navbar-expand-xxxl p-3 text-bg-light">
        <a href="/">
            <img class="logoHome" src="{{ asset('images/World_Taekwondo.png') }}" alt="logo TKD" width="100px" />
        </a>
        <span class="fs-4 ms-3 tituloPag">Poomsae
            Reconocido</span>
            <button id="cambiarVista_negro" class="btn btn-dark"><i class="bi bi-moon"></i></button>
            <button id="cambiarVista_blanco" class="btn btn-light" style="display:none;"><i class="bi bi-sun"></i></button>
        @auth
              <div id="botonesBasicos" class="d-flex justify-content-between align-items-center">

                <div class="boton-container" >
                    <a  href="{{ route('verPerfil') }}" class="btn btn-outline-dark"><i class="bi bi-person me-1"></i>{{auth()->user()->usuario}}</a>
                </div>

                <div class="boton-container">
                    <a href="{{ route('logout.perform') }}" class="btn btn-outline-dark"><i class="bi bi-door-open me-1"></i>Cerrar Sesion</a>
                </div>

              </div>


        <input type="hidden" id='idUsuarioActual' value="{{auth()->user()->id}}">
        <div class="btn-group">
            <button type="button" class="btn btn-outline-dark" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-bell me-2"></i><span id="notiCantidad" class="badge bg-primary rounded-pill"></span>
            </button>
            <ul id="notiCasera" class="dropdown-menu dropdown-menu-end p-1" aria-labelledby="dropdownMenuButton" style="width: 450px">
                <li><a class="dropdown-item" href="#">
                    No hay notificaciones <span class="badge bg-primary rounded-pill">0</span>
                </a></li>
            </ul>
        </div>

        <button id="menuNavBar" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="navbarNav" class="collapse navbar-collapse ms-3">
            <ul class="navbar-nav" role="tablist">

                {{-- PERMISOS PÚBLICOS --}}

                <a href="/presentacion" class="nav-item btn {{ request()->is('presentacion') ? 'active' : '' }}" id="seccion2-tab">

                    @include('layouts.partials.svg')
                    Ver Competencias

                </a>

                <a href="/resultados" class="nav-item btn {{ request()->is('resultados') ? 'active' : '' }}" id="seccion5-tab">

                    @include('layouts.partials.svg')
                    Resultados

                </a>

                {{-- PERMISOS ADMINISTRADOR --}}

                @if(auth()->user()->idRol == 1 )
                    <a href="/index_reloj" class="nav-item btn {{ request()->is('cronometro') ? 'active' : '' }}" id="seccion1-tab">

                        @include('layouts.partials.svg')
                        Cronómetro

                    </a>

                    <a href="/competidores" class="nav-item btn {{ request()->is('competidores') ? 'active' : '' }}" id="seccion3-tab">

                        @include('layouts.partials.svg')
                        Ver Competidores

                    </a>

                    <a href="{{ route('index_usuarios') }}" class="nav-item btn {{ request()->is('administrador') ? 'active' : '' }}">

                        @include('layouts.partials.svg')
                        Gestion de Usuarios
    
                    </a>

                    <a href="{{ route('index_categoria') }}" class="nav-item btn {{ request()->is('administrador') ? 'active' : '' }}">

                        @include('layouts.partials.svg')
                        Gestion de Categorias
    
                    </a>

                    <a href="{{ route('index_competencia') }}" class="nav-item btn {{ request()->is('administrador') ? 'active' : '' }}">

                        @include('layouts.partials.svg')
                        Gestion de Competencias
    
                    </a>

                    <a href="{{ route('index_poomsae') }}" class="nav-item btn {{ request()->is('administrador') ? 'active' : '' }}">

                        @include('layouts.partials.svg')
                        Gestion de Poomsaes
    
                    </a>

                    <a href="{{ route('graduaciones.index') }}" class="nav-item btn {{ request()->is('administrador') ? 'active' : '' }}">

                        @include('layouts.partials.svg')
                        Gestion de Graduaciones
    
                    </a>

                    <a href="{{ route('index_solicitudes') }}" class="nav-item btn {{ request()->is('administrador') ? 'active' : '' }}">

                        @include('layouts.partials.svg')
                        Gestion de Solicitudes
    
                    </a>
                @endif

                {{-- PERMISOS JUEZ --}}

                @if( auth()->user()->idRol == 2 )
                <a href="/puntuador/index" class="nav-item btn {{ request()->is('puntuador') ? 'active' : '' }}" id="seccion1-tab">

                    @include('layouts.partials.svg')
                    Puntuador

                </a>
                @endif

                {{-- PERMISOS COMPETIDOR --}}

                @if( auth()->user()->idRol == 3  )
                <a href="/cargarCompetidor" class="nav-item btn {{ request()->is('cargarCompetidor') ? 'active' : '' }}" id="seccion4-tab" >

                    @include('layouts.partials.svg')
                    Inscribirse a una Competencia

                </a>
                @endif

                
            </ul>
        </div>



        @endauth

        @guest
        <div class="text-end">
          <a href="{{ route('login.perform') }}" class="btn btn-outline-primary me-2"><i class="bi bi-box-arrow-in-right me-2"></i>Login</a>
          <a href="{{ route('registro.perform') }}" class="btn btn-outline-success"><i class="bi bi-person-add me-2"></i>Registrarse</a>
        </div>
        @endguest


    </nav>
</header>
