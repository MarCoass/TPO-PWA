

<div class="dropdown">
    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
        @if (count(auth()->user()->unreadNotifications))
            <span>{{ count(auth()->user()->unreadNotifications) }}</span>
        @endif
    </a>

    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
        @forelse (auth()->user()->unreadNotifications as $notificacion)
            <li>
                <hr>
                {{$notificacion->data['estado']}} <br>
                {{$notificacion->data['titulo']}} <br>
                {{$notificacion->data['mensaje']}} <br>
                {{$notificacion->created_at->diffForHumans()}}
                <hr>
                <form action="{{ route('marcarLeido', $notificacion->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-primary">Marcar como leída</button>
                </form>
            </li>
        @empty
            <li><h1>No hay nuevas notificaciones</h1></li>
        @endforelse

        @forelse (auth()->user()->readNotifications as $notificacion)
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
        @endforelse
    </ul>
</div>
