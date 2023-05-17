@extends('layouts/layout')

@section('titulo')
    Video
@endsection

@section('encabezado')
Video
@endsection

@section('contenido')

<div class="text-center">
    <div class="row my-5 d-block d-md-none">
        <div class="col-12">
            <a href="https://www.youtube.com/watch?v=ermNRSmkGF8" target="_blank" class="btn btn-danger">Haga clic acá para ver un vídeo</a>
        </div>
    </div>
    
    <div class="row my-5 d-none d-md-block">
        <div class="col-12">
        <iframe width="560" height="315" src="https://www.youtube.com/embed/ermNRSmkGF8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        </div>
    </div>
</div>
@endsection