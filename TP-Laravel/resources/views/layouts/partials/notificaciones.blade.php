<div class="btn-group">
    <button type="button" class="btn btn-outline-dark" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-bell me-2"></i>
        @if (count(auth()->user()->unreadNotifications))
            <span id="notiCantidad" class="badge bg-primary rounded-pill">{{ count(auth()->user()->unreadNotifications) }}</span>
        @endif
    </button>

    <ul id="notiCasera" class="dropdown-menu dropdown-menu-end p-1" aria-labelledby="dropdownMenuLink" style="width: 450px">
        @forelse (auth()->user()->unreadNotifications as $notificacion)
        @if($notificacion->data['estado'] == "success")
            <div class="d-flex p-1 btn btn-outline-success">
                <i class="bi bi-hand-thumbs-up mt-4 h5 align-middle"></i>
                @endif
                @if($notificacion->data['estado'] == "restricted")
                <div class="d-flex p-1 btn btn-outline-danger">
                <i class="bi bi-hand-thumbs-down mt-4 h5 align-middle"></i>
                @endif
                <li class="rounded pt-1 pe-1">
                    <h6>{{$notificacion->data['titulo']}}</h6>
                    <p class="lead">{{$notificacion->data['mensaje']}}</p>
                    <form action="{{ route('marcarLeido', $notificacion->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-outline-dark notiBoton"><i class="bi bi-eye-slash me-2"></i>Marcar como leída</button>
                            <p class="fw-light align-items-end">{{$notificacion->created_at->diffForHumans()}}</p>
                        </div>
                    </form>
                </li>
            </div>
        @empty
            <li class="rounded p-2"><h6>No hay nuevas notificaciones</h6></li>
        @endforelse

        {{-- @forelse (auth()->user()->readNotifications as $notificacion)
            <li>
                <hr>
                {{$notificacion->data['estado']}} <br>
                {{$notificacion->data['titulo']}} <br>
                {{$notificacion->data['mensaje']}} <br>
                {{$notificacion->created_at->diffForHumans()}}
                <hr>
            </li>
        @empty
            <li><h1>No hay mensajes leidos</h1></li>
        @endforelse --}}
    </ul>






</div>
