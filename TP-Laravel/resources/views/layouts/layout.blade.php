<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Poomsae Reconocido Individual Élite</title>

    <!-- ICON -->
    <link rel="icon" type="image\x-icon" href="../util/Img/logo.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <!-- Bootstrap Icons v1.10.4 -->
    <link rel="stylesheet" href="../util/bootstrap-5.2.3/bootstrap-icons-1.10.4/bootstrap-icons.css">

    <!-- una font digital para cronometro -->
    <link href="https://fonts.cdnfonts.com/css/digital-7-mono" rel="stylesheet">

    <!-- Estilos Propios -->
    <link rel="stylesheet" href="../util/css/style.css">
    <link rel="stylesheet" href="../util/css/pagination.css">


</head>

<body class="transicion">
    <header class="sticky-top border-bottom border-danger border-2">
        <div>
            <nav id="menuHamburguesa" class="navbar navbar-expand-xxxl p-3  text-bg-light">

                <img src="{{ asset('images/World_Taekwondo.png') }}" alt="logo TKD" width="100px" /><span
                    class="fs-4 ms-3 tituloPag">Poomsae
                    Reconocido</span>
                <div class=""><i class="bi bi-moon-fill mx-3" id="botonTemaOscuro"></i>
                    <i class="bi bi-sun-fill d-none mx-3" id="botonTemaClaro"></i>
                </div>
                <button id="menuNavBar" class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div id="navbarNav" class="collapse navbar-collapse ms-3">
                    <ul class="navbar-nav" role="tablist">
                        <a href="/cronometro" class="nav-item btn {{ request()->is('cronometro') ? 'active' : '' }}" id="seccion1-tab">

                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 68.3 1024 636.1"
                                enable-background="new 0 68.3 1024 636.1" xml:space="preserve">
                                <path fill="#2993FC" stroke="" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-miterlimit="10"
                                    d="  M1017.1,362.3c8.3-3.3,3.3-12.2,3.3-12.2c-3.3-4.4-20.4,2.2-20.4,2.2c-16.6,1.1-32.1,12.7-32.1,12.7c-7.2,0-38.1,12.7-38.1,12.7  c-33.7,9.9-51.4,6.1-51.4,6.1c-3.9-12.1-45.9-56.9-45.9-56.9c-6.6-16.6-19.3-28.2-19.3-28.2l-18.2,10.5c-24.9,5.5-92.3,58-92.3,58  c-19.9-7.2-69.1,22.7-69.1,22.7c-24.9-12.2-65.6,21.6-65.6,21.6c-20.3-9.4-114.5-5-114.5-5c7.7-5.5,34.3-4.4,34.3-4.4l4.4-6.1  c-13.3-7.7-66.9,6.1-66.9,6.1c-11.6-9.9-60.8-10.5-60.8-10.5c-9.4-14.4-41.4-13.8-41.4-13.8c-1-14.2-29.4-68.7-29.4-68.7  c-1.1-24.9,29.3-24.3,29.3-24.3c45.3,1.7,170.8-31.5,170.8-31.5c9.4-5.5,100.6-34.8,100.6-34.8l-0.6-10.5  c3.9-6.1,45.3-16.6,45.3-16.6c3.3,7.2,49.2,12.2,49.2,12.2c12.7,1.1,11.1-12.2,11.1-12.2c9.4-2.8,7.7-9.4,7.7-9.4l-10.5-27.1  c-2.2-11.1-14.9-6.6-14.9-6.6l-40.9,12.7c-11.1-1.1-18.2,3.3-18.2,3.3c-4.4,1.1-30.9,7.7-30.9,7.7c-2.8-2.8-6.1-40.9-6.1-40.9  c-11.1,4.4-87.9,9.4-87.9,9.4c-86.2,1.1-179.6,34.8-179.6,34.8c-9.9-13.8-68,3.9-68,3.9c3.9-1.7,7.2-9.4,7.2-9.4  c-1.1-18.2,3.9-24.9,3.9-24.9c18.2-32.6-23.8-60.2-23.8-60.2c-44.2-33.7-95.1-5.5-95.1-5.5c-47.5,19.9-33.2,78.5-33.2,78.5  c3.3,11.6,7.7,32.1,7.7,32.1l-27.6,6.6c-34.3,6.6-51.4,35.4-51.4,35.4c12.7,13.3,6.1,39.8,6.1,39.8c-22.7,16-14.4,94-14.4,94  c-4.4,1.7-21.6,49.7-21.6,49.7c-9.4,11.1-2.8,65.9-2.8,65.9c4.4,9.9,65.8,77.3,65.8,77.3c3.3,10.5,30.9,4.4,30.9,4.4  c3.9,2.8,64.1-24.3,64.1-24.3l3.9,4.4c2.2,12.2-17.1,21.6-17.1,21.6c10.5,9.9,38.1,7.2,38.1,7.2c1.1,22.7-38.1,61.9-38.1,61.9  c3.3,7.7,77.9-3.9,77.9-3.9c2.2,11.1,13.8,11.6,13.8,11.6c19.3-4.4,22.1,19.9,22.1,19.9c12.7,33.7,77.9,42.6,77.9,42.6  c40.3,7.2,127.1-59.7,127.1-59.7c36.5,11.1,74.6-56.4,74.6-56.4c5.5-7.7,21.7-14.4,21.7-14.4c5.7-0.6,21.4-10.5,21.4-10.5  c7.7-4.4,39.8-21,39.8-21c6.1-1.1,17.7-17.1,17.7-17.1l7.7-12.2c4.4-5.5,1.1-14.9,1.1-14.9l4.4-8.3c-1.4-3.5-3.5-5.4-6-6.3  c19.2-6.9,32-14.1,32-14.1c14.9,12.7,57.5-2.2,57.5-2.2c9.4-4.4,128.2-35.4,128.2-35.4c15.5,1.1,14.4-3.9,14.4-3.9l11.6-3.2  c10.5,7.2,27.6-0.1,27.6-0.1c3.9,0.6,12.7-3.1,12.7-3.1c5-3.3,49.5-8.9,49.5-8.9h20.7c12.7-2.1,11.1-32.4,11.1-32.4  C1023.2,372.1,1017.1,362.3,1017.1,362.3z M114.5,447.2c-4.6-4.6-3.1-37.1-3.1-37.1c8.1,25.4,13.7,30,13.7,30L114.5,447.2z   M400.4,550.2l-7.4,13.3c-2.8,0-7.8-8.3-7.8-8.3l15.1-11.1V550.2z M624.7,496.1C609.2,494.9,596,511,596,511  c-24.6,18.6-33.2,15.5-33.2,15.5c-28.7-12.7-45.9,27.6-45.9,27.6l-39.2-26.5l45.3-11.6c14.4,0,28.2-13.8,28.2-13.8  c3.3,6.6,11.6,0,11.6,0c3.3-2.2,29.8-6.6,29.8-6.6c14.1-0.3,27.8-2.7,40.3-5.9C628.1,492.9,624.7,496.1,624.7,496.1z" />
                            </svg>
                            Cronómetro

                        </a>
                        <a href="/video" class="nav-item btn {{ request()->is('video') ? 'active' : '' }}" id="seccion2-tab">

                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 68.3 1024 636.1"
                                enable-background="new 0 68.3 1024 636.1" xml:space="preserve">
                                <path fill="#2993FC" stroke="" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-miterlimit="10"
                                    d="  M1017.1,362.3c8.3-3.3,3.3-12.2,3.3-12.2c-3.3-4.4-20.4,2.2-20.4,2.2c-16.6,1.1-32.1,12.7-32.1,12.7c-7.2,0-38.1,12.7-38.1,12.7  c-33.7,9.9-51.4,6.1-51.4,6.1c-3.9-12.1-45.9-56.9-45.9-56.9c-6.6-16.6-19.3-28.2-19.3-28.2l-18.2,10.5c-24.9,5.5-92.3,58-92.3,58  c-19.9-7.2-69.1,22.7-69.1,22.7c-24.9-12.2-65.6,21.6-65.6,21.6c-20.3-9.4-114.5-5-114.5-5c7.7-5.5,34.3-4.4,34.3-4.4l4.4-6.1  c-13.3-7.7-66.9,6.1-66.9,6.1c-11.6-9.9-60.8-10.5-60.8-10.5c-9.4-14.4-41.4-13.8-41.4-13.8c-1-14.2-29.4-68.7-29.4-68.7  c-1.1-24.9,29.3-24.3,29.3-24.3c45.3,1.7,170.8-31.5,170.8-31.5c9.4-5.5,100.6-34.8,100.6-34.8l-0.6-10.5  c3.9-6.1,45.3-16.6,45.3-16.6c3.3,7.2,49.2,12.2,49.2,12.2c12.7,1.1,11.1-12.2,11.1-12.2c9.4-2.8,7.7-9.4,7.7-9.4l-10.5-27.1  c-2.2-11.1-14.9-6.6-14.9-6.6l-40.9,12.7c-11.1-1.1-18.2,3.3-18.2,3.3c-4.4,1.1-30.9,7.7-30.9,7.7c-2.8-2.8-6.1-40.9-6.1-40.9  c-11.1,4.4-87.9,9.4-87.9,9.4c-86.2,1.1-179.6,34.8-179.6,34.8c-9.9-13.8-68,3.9-68,3.9c3.9-1.7,7.2-9.4,7.2-9.4  c-1.1-18.2,3.9-24.9,3.9-24.9c18.2-32.6-23.8-60.2-23.8-60.2c-44.2-33.7-95.1-5.5-95.1-5.5c-47.5,19.9-33.2,78.5-33.2,78.5  c3.3,11.6,7.7,32.1,7.7,32.1l-27.6,6.6c-34.3,6.6-51.4,35.4-51.4,35.4c12.7,13.3,6.1,39.8,6.1,39.8c-22.7,16-14.4,94-14.4,94  c-4.4,1.7-21.6,49.7-21.6,49.7c-9.4,11.1-2.8,65.9-2.8,65.9c4.4,9.9,65.8,77.3,65.8,77.3c3.3,10.5,30.9,4.4,30.9,4.4  c3.9,2.8,64.1-24.3,64.1-24.3l3.9,4.4c2.2,12.2-17.1,21.6-17.1,21.6c10.5,9.9,38.1,7.2,38.1,7.2c1.1,22.7-38.1,61.9-38.1,61.9  c3.3,7.7,77.9-3.9,77.9-3.9c2.2,11.1,13.8,11.6,13.8,11.6c19.3-4.4,22.1,19.9,22.1,19.9c12.7,33.7,77.9,42.6,77.9,42.6  c40.3,7.2,127.1-59.7,127.1-59.7c36.5,11.1,74.6-56.4,74.6-56.4c5.5-7.7,21.7-14.4,21.7-14.4c5.7-0.6,21.4-10.5,21.4-10.5  c7.7-4.4,39.8-21,39.8-21c6.1-1.1,17.7-17.1,17.7-17.1l7.7-12.2c4.4-5.5,1.1-14.9,1.1-14.9l4.4-8.3c-1.4-3.5-3.5-5.4-6-6.3  c19.2-6.9,32-14.1,32-14.1c14.9,12.7,57.5-2.2,57.5-2.2c9.4-4.4,128.2-35.4,128.2-35.4c15.5,1.1,14.4-3.9,14.4-3.9l11.6-3.2  c10.5,7.2,27.6-0.1,27.6-0.1c3.9,0.6,12.7-3.1,12.7-3.1c5-3.3,49.5-8.9,49.5-8.9h20.7c12.7-2.1,11.1-32.4,11.1-32.4  C1023.2,372.1,1017.1,362.3,1017.1,362.3z M114.5,447.2c-4.6-4.6-3.1-37.1-3.1-37.1c8.1,25.4,13.7,30,13.7,30L114.5,447.2z   M400.4,550.2l-7.4,13.3c-2.8,0-7.8-8.3-7.8-8.3l15.1-11.1V550.2z M624.7,496.1C609.2,494.9,596,511,596,511  c-24.6,18.6-33.2,15.5-33.2,15.5c-28.7-12.7-45.9,27.6-45.9,27.6l-39.2-26.5l45.3-11.6c14.4,0,28.2-13.8,28.2-13.8  c3.3,6.6,11.6,0,11.6,0c3.3-2.2,29.8-6.6,29.8-6.6c14.1-0.3,27.8-2.7,40.3-5.9C628.1,492.9,624.7,496.1,624.7,496.1z" />
                            </svg>
                            Video

                        </a>
                        <a href="/tablaCompetidores" class="nav-item btn {{ request()->is('tablaCompetidores') ? 'active' : '' }}" id="seccion3-tab">

                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 68.3 1024 636.1"
                                enable-background="new 0 68.3 1024 636.1" xml:space="preserve">
                                <path fill="#2993FC" stroke="" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-miterlimit="10"
                                    d="  M1017.1,362.3c8.3-3.3,3.3-12.2,3.3-12.2c-3.3-4.4-20.4,2.2-20.4,2.2c-16.6,1.1-32.1,12.7-32.1,12.7c-7.2,0-38.1,12.7-38.1,12.7  c-33.7,9.9-51.4,6.1-51.4,6.1c-3.9-12.1-45.9-56.9-45.9-56.9c-6.6-16.6-19.3-28.2-19.3-28.2l-18.2,10.5c-24.9,5.5-92.3,58-92.3,58  c-19.9-7.2-69.1,22.7-69.1,22.7c-24.9-12.2-65.6,21.6-65.6,21.6c-20.3-9.4-114.5-5-114.5-5c7.7-5.5,34.3-4.4,34.3-4.4l4.4-6.1  c-13.3-7.7-66.9,6.1-66.9,6.1c-11.6-9.9-60.8-10.5-60.8-10.5c-9.4-14.4-41.4-13.8-41.4-13.8c-1-14.2-29.4-68.7-29.4-68.7  c-1.1-24.9,29.3-24.3,29.3-24.3c45.3,1.7,170.8-31.5,170.8-31.5c9.4-5.5,100.6-34.8,100.6-34.8l-0.6-10.5  c3.9-6.1,45.3-16.6,45.3-16.6c3.3,7.2,49.2,12.2,49.2,12.2c12.7,1.1,11.1-12.2,11.1-12.2c9.4-2.8,7.7-9.4,7.7-9.4l-10.5-27.1  c-2.2-11.1-14.9-6.6-14.9-6.6l-40.9,12.7c-11.1-1.1-18.2,3.3-18.2,3.3c-4.4,1.1-30.9,7.7-30.9,7.7c-2.8-2.8-6.1-40.9-6.1-40.9  c-11.1,4.4-87.9,9.4-87.9,9.4c-86.2,1.1-179.6,34.8-179.6,34.8c-9.9-13.8-68,3.9-68,3.9c3.9-1.7,7.2-9.4,7.2-9.4  c-1.1-18.2,3.9-24.9,3.9-24.9c18.2-32.6-23.8-60.2-23.8-60.2c-44.2-33.7-95.1-5.5-95.1-5.5c-47.5,19.9-33.2,78.5-33.2,78.5  c3.3,11.6,7.7,32.1,7.7,32.1l-27.6,6.6c-34.3,6.6-51.4,35.4-51.4,35.4c12.7,13.3,6.1,39.8,6.1,39.8c-22.7,16-14.4,94-14.4,94  c-4.4,1.7-21.6,49.7-21.6,49.7c-9.4,11.1-2.8,65.9-2.8,65.9c4.4,9.9,65.8,77.3,65.8,77.3c3.3,10.5,30.9,4.4,30.9,4.4  c3.9,2.8,64.1-24.3,64.1-24.3l3.9,4.4c2.2,12.2-17.1,21.6-17.1,21.6c10.5,9.9,38.1,7.2,38.1,7.2c1.1,22.7-38.1,61.9-38.1,61.9  c3.3,7.7,77.9-3.9,77.9-3.9c2.2,11.1,13.8,11.6,13.8,11.6c19.3-4.4,22.1,19.9,22.1,19.9c12.7,33.7,77.9,42.6,77.9,42.6  c40.3,7.2,127.1-59.7,127.1-59.7c36.5,11.1,74.6-56.4,74.6-56.4c5.5-7.7,21.7-14.4,21.7-14.4c5.7-0.6,21.4-10.5,21.4-10.5  c7.7-4.4,39.8-21,39.8-21c6.1-1.1,17.7-17.1,17.7-17.1l7.7-12.2c4.4-5.5,1.1-14.9,1.1-14.9l4.4-8.3c-1.4-3.5-3.5-5.4-6-6.3  c19.2-6.9,32-14.1,32-14.1c14.9,12.7,57.5-2.2,57.5-2.2c9.4-4.4,128.2-35.4,128.2-35.4c15.5,1.1,14.4-3.9,14.4-3.9l11.6-3.2  c10.5,7.2,27.6-0.1,27.6-0.1c3.9,0.6,12.7-3.1,12.7-3.1c5-3.3,49.5-8.9,49.5-8.9h20.7c12.7-2.1,11.1-32.4,11.1-32.4  C1023.2,372.1,1017.1,362.3,1017.1,362.3z M114.5,447.2c-4.6-4.6-3.1-37.1-3.1-37.1c8.1,25.4,13.7,30,13.7,30L114.5,447.2z   M400.4,550.2l-7.4,13.3c-2.8,0-7.8-8.3-7.8-8.3l15.1-11.1V550.2z M624.7,496.1C609.2,494.9,596,511,596,511  c-24.6,18.6-33.2,15.5-33.2,15.5c-28.7-12.7-45.9,27.6-45.9,27.6l-39.2-26.5l45.3-11.6c14.4,0,28.2-13.8,28.2-13.8  c3.3,6.6,11.6,0,11.6,0c3.3-2.2,29.8-6.6,29.8-6.6c14.1-0.3,27.8-2.7,40.3-5.9C628.1,492.9,624.7,496.1,624.7,496.1z" />
                            </svg>
                            Ver Competidores

                        </a>
                        <a href="/agregarCompetidor" class="nav-item btn {{ request()->is('agregarCompetidor') ? 'active' : '' }}" id="seccion4-tab" data-bs-toggle="modal"
                            data-bs-target="#modalFormCompetidor">

                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" xmlns:xlink="http://www.w3.org/1999/xlink"
                                viewBox="0 68.3 1024 636.1" enable-background="new 0 68.3 1024 636.1"
                                xml:space="preserve">
                                <path fill="#2993FC" stroke="" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-miterlimit="10"
                                    d="  M1017.1,362.3c8.3-3.3,3.3-12.2,3.3-12.2c-3.3-4.4-20.4,2.2-20.4,2.2c-16.6,1.1-32.1,12.7-32.1,12.7c-7.2,0-38.1,12.7-38.1,12.7  c-33.7,9.9-51.4,6.1-51.4,6.1c-3.9-12.1-45.9-56.9-45.9-56.9c-6.6-16.6-19.3-28.2-19.3-28.2l-18.2,10.5c-24.9,5.5-92.3,58-92.3,58  c-19.9-7.2-69.1,22.7-69.1,22.7c-24.9-12.2-65.6,21.6-65.6,21.6c-20.3-9.4-114.5-5-114.5-5c7.7-5.5,34.3-4.4,34.3-4.4l4.4-6.1  c-13.3-7.7-66.9,6.1-66.9,6.1c-11.6-9.9-60.8-10.5-60.8-10.5c-9.4-14.4-41.4-13.8-41.4-13.8c-1-14.2-29.4-68.7-29.4-68.7  c-1.1-24.9,29.3-24.3,29.3-24.3c45.3,1.7,170.8-31.5,170.8-31.5c9.4-5.5,100.6-34.8,100.6-34.8l-0.6-10.5  c3.9-6.1,45.3-16.6,45.3-16.6c3.3,7.2,49.2,12.2,49.2,12.2c12.7,1.1,11.1-12.2,11.1-12.2c9.4-2.8,7.7-9.4,7.7-9.4l-10.5-27.1  c-2.2-11.1-14.9-6.6-14.9-6.6l-40.9,12.7c-11.1-1.1-18.2,3.3-18.2,3.3c-4.4,1.1-30.9,7.7-30.9,7.7c-2.8-2.8-6.1-40.9-6.1-40.9  c-11.1,4.4-87.9,9.4-87.9,9.4c-86.2,1.1-179.6,34.8-179.6,34.8c-9.9-13.8-68,3.9-68,3.9c3.9-1.7,7.2-9.4,7.2-9.4  c-1.1-18.2,3.9-24.9,3.9-24.9c18.2-32.6-23.8-60.2-23.8-60.2c-44.2-33.7-95.1-5.5-95.1-5.5c-47.5,19.9-33.2,78.5-33.2,78.5  c3.3,11.6,7.7,32.1,7.7,32.1l-27.6,6.6c-34.3,6.6-51.4,35.4-51.4,35.4c12.7,13.3,6.1,39.8,6.1,39.8c-22.7,16-14.4,94-14.4,94  c-4.4,1.7-21.6,49.7-21.6,49.7c-9.4,11.1-2.8,65.9-2.8,65.9c4.4,9.9,65.8,77.3,65.8,77.3c3.3,10.5,30.9,4.4,30.9,4.4  c3.9,2.8,64.1-24.3,64.1-24.3l3.9,4.4c2.2,12.2-17.1,21.6-17.1,21.6c10.5,9.9,38.1,7.2,38.1,7.2c1.1,22.7-38.1,61.9-38.1,61.9  c3.3,7.7,77.9-3.9,77.9-3.9c2.2,11.1,13.8,11.6,13.8,11.6c19.3-4.4,22.1,19.9,22.1,19.9c12.7,33.7,77.9,42.6,77.9,42.6  c40.3,7.2,127.1-59.7,127.1-59.7c36.5,11.1,74.6-56.4,74.6-56.4c5.5-7.7,21.7-14.4,21.7-14.4c5.7-0.6,21.4-10.5,21.4-10.5  c7.7-4.4,39.8-21,39.8-21c6.1-1.1,17.7-17.1,17.7-17.1l7.7-12.2c4.4-5.5,1.1-14.9,1.1-14.9l4.4-8.3c-1.4-3.5-3.5-5.4-6-6.3  c19.2-6.9,32-14.1,32-14.1c14.9,12.7,57.5-2.2,57.5-2.2c9.4-4.4,128.2-35.4,128.2-35.4c15.5,1.1,14.4-3.9,14.4-3.9l11.6-3.2  c10.5,7.2,27.6-0.1,27.6-0.1c3.9,0.6,12.7-3.1,12.7-3.1c5-3.3,49.5-8.9,49.5-8.9h20.7c12.7-2.1,11.1-32.4,11.1-32.4  C1023.2,372.1,1017.1,362.3,1017.1,362.3z M114.5,447.2c-4.6-4.6-3.1-37.1-3.1-37.1c8.1,25.4,13.7,30,13.7,30L114.5,447.2z   M400.4,550.2l-7.4,13.3c-2.8,0-7.8-8.3-7.8-8.3l15.1-11.1V550.2z M624.7,496.1C609.2,494.9,596,511,596,511  c-24.6,18.6-33.2,15.5-33.2,15.5c-28.7-12.7-45.9,27.6-45.9,27.6l-39.2-26.5l45.3-11.6c14.4,0,28.2-13.8,28.2-13.8  c3.3,6.6,11.6,0,11.6,0c3.3-2.2,29.8-6.6,29.8-6.6c14.1-0.3,27.8-2.7,40.3-5.9C628.1,492.9,624.7,496.1,624.7,496.1z" />
                            </svg>
                            Agregar Competidor

                        </a>
                        <a href="/imagenesRandom" class="nav-item btn {{ request()->is('imagenesRandom') ? 'active' : '' }}" id="seccion5-tab">

                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" xmlns:xlink="http://www.w3.org/1999/xlink"
                                viewBox="0 68.3 1024 636.1" enable-background="new 0 68.3 1024 636.1"
                                xml:space="preserve">
                                <path fill="#2993FC" stroke="" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-miterlimit="10"
                                    d="  M1017.1,362.3c8.3-3.3,3.3-12.2,3.3-12.2c-3.3-4.4-20.4,2.2-20.4,2.2c-16.6,1.1-32.1,12.7-32.1,12.7c-7.2,0-38.1,12.7-38.1,12.7  c-33.7,9.9-51.4,6.1-51.4,6.1c-3.9-12.1-45.9-56.9-45.9-56.9c-6.6-16.6-19.3-28.2-19.3-28.2l-18.2,10.5c-24.9,5.5-92.3,58-92.3,58  c-19.9-7.2-69.1,22.7-69.1,22.7c-24.9-12.2-65.6,21.6-65.6,21.6c-20.3-9.4-114.5-5-114.5-5c7.7-5.5,34.3-4.4,34.3-4.4l4.4-6.1  c-13.3-7.7-66.9,6.1-66.9,6.1c-11.6-9.9-60.8-10.5-60.8-10.5c-9.4-14.4-41.4-13.8-41.4-13.8c-1-14.2-29.4-68.7-29.4-68.7  c-1.1-24.9,29.3-24.3,29.3-24.3c45.3,1.7,170.8-31.5,170.8-31.5c9.4-5.5,100.6-34.8,100.6-34.8l-0.6-10.5  c3.9-6.1,45.3-16.6,45.3-16.6c3.3,7.2,49.2,12.2,49.2,12.2c12.7,1.1,11.1-12.2,11.1-12.2c9.4-2.8,7.7-9.4,7.7-9.4l-10.5-27.1  c-2.2-11.1-14.9-6.6-14.9-6.6l-40.9,12.7c-11.1-1.1-18.2,3.3-18.2,3.3c-4.4,1.1-30.9,7.7-30.9,7.7c-2.8-2.8-6.1-40.9-6.1-40.9  c-11.1,4.4-87.9,9.4-87.9,9.4c-86.2,1.1-179.6,34.8-179.6,34.8c-9.9-13.8-68,3.9-68,3.9c3.9-1.7,7.2-9.4,7.2-9.4  c-1.1-18.2,3.9-24.9,3.9-24.9c18.2-32.6-23.8-60.2-23.8-60.2c-44.2-33.7-95.1-5.5-95.1-5.5c-47.5,19.9-33.2,78.5-33.2,78.5  c3.3,11.6,7.7,32.1,7.7,32.1l-27.6,6.6c-34.3,6.6-51.4,35.4-51.4,35.4c12.7,13.3,6.1,39.8,6.1,39.8c-22.7,16-14.4,94-14.4,94  c-4.4,1.7-21.6,49.7-21.6,49.7c-9.4,11.1-2.8,65.9-2.8,65.9c4.4,9.9,65.8,77.3,65.8,77.3c3.3,10.5,30.9,4.4,30.9,4.4  c3.9,2.8,64.1-24.3,64.1-24.3l3.9,4.4c2.2,12.2-17.1,21.6-17.1,21.6c10.5,9.9,38.1,7.2,38.1,7.2c1.1,22.7-38.1,61.9-38.1,61.9  c3.3,7.7,77.9-3.9,77.9-3.9c2.2,11.1,13.8,11.6,13.8,11.6c19.3-4.4,22.1,19.9,22.1,19.9c12.7,33.7,77.9,42.6,77.9,42.6  c40.3,7.2,127.1-59.7,127.1-59.7c36.5,11.1,74.6-56.4,74.6-56.4c5.5-7.7,21.7-14.4,21.7-14.4c5.7-0.6,21.4-10.5,21.4-10.5  c7.7-4.4,39.8-21,39.8-21c6.1-1.1,17.7-17.1,17.7-17.1l7.7-12.2c4.4-5.5,1.1-14.9,1.1-14.9l4.4-8.3c-1.4-3.5-3.5-5.4-6-6.3  c19.2-6.9,32-14.1,32-14.1c14.9,12.7,57.5-2.2,57.5-2.2c9.4-4.4,128.2-35.4,128.2-35.4c15.5,1.1,14.4-3.9,14.4-3.9l11.6-3.2  c10.5,7.2,27.6-0.1,27.6-0.1c3.9,0.6,12.7-3.1,12.7-3.1c5-3.3,49.5-8.9,49.5-8.9h20.7c12.7-2.1,11.1-32.4,11.1-32.4  C1023.2,372.1,1017.1,362.3,1017.1,362.3z M114.5,447.2c-4.6-4.6-3.1-37.1-3.1-37.1c8.1,25.4,13.7,30,13.7,30L114.5,447.2z   M400.4,550.2l-7.4,13.3c-2.8,0-7.8-8.3-7.8-8.3l15.1-11.1V550.2z M624.7,496.1C609.2,494.9,596,511,596,511  c-24.6,18.6-33.2,15.5-33.2,15.5c-28.7-12.7-45.9,27.6-45.9,27.6l-39.2-26.5l45.3-11.6c14.4,0,28.2-13.8,28.2-13.8  c3.3,6.6,11.6,0,11.6,0c3.3-2.2,29.8-6.6,29.8-6.6c14.1-0.3,27.8-2.7,40.3-5.9C628.1,492.9,624.7,496.1,624.7,496.1z" />
                            </svg>
                            Imágenes

                        </a>
                    </ul>
                </div>

            </nav>
    </header>

    <h1> @yield('encabezado')</h1>
    <div>@yield('contenido')</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>

    <div class="bg-danger">
        Aca va el footer :)
        {{ Route::currentRouteName() }}
    </div>


    <!--Fin del div.container-fluid-->
    <script src="../util/js/librerias/popper.min.js"></script>
    <script src="../util/bootstrap-5.2.3/js/bootstrap.min.js"></script>


</body>

</html>
