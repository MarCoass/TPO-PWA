<!-- aca es donde muestra una lista de los errores de las validaciones de login-->

@if(isset ($errors) && count($errors) > 0)
    <div class="alert alert-warning soy-un-error-de-messages-blade-php" role="alert">
        <ul class="list-unstyled mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<!-- aca es donde se devuelve lo de la funcion register() de RegistroController.php -->

@if(Session::get('success', false))
    <?php $data = Session::get('success'); ?>
    @if (is_array($data))
        @foreach ($data as $msg)
            <div class="alert alert-success" role="alert">
                <i class="fa fa-check"></i>
                {{ $msg }}
            </div>
        @endforeach
    @else
        <div class="alert alert-success" role="alert">
            <i class="fa fa-check"></i>
            {{ $data }}
        </div>
    @endif
@endif


<!-- aca es para enviar mensajes en color rojo cuando se envian mensajes por restringed -->
@if(Session::get('restringed', false))
    <?php $data = Session::get('restringed'); ?>
    @if (is_array($data))
        @foreach ($data as $msg)
            <div class="alert alert-warning" role="alert">
                <i class="fa fa-check"></i>
                {{ $msg }}
            </div>
        @endforeach
    @else
        <div class="alert alert-danger" role="alert">
            <i class="fa fa-check"></i>
            {{ $data }}
        </div>
    @endif
@endif