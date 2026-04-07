<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Ing. Yonathan Castillo">
    <meta name="generator" content="Bootstrap v5.3.7">

    <title>Consultar Participante - {{ config('app.name', 'Laravel') }}</title>

    {{-- Favicon y PWA --}}
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/appicon-32x32.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicons/appicon-128x128.png') }}">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

    <!--Bootstrap -->
    {{--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">--}}
    @vite(['resources/js/bootstrap5.js', 'resources/js/sweetalert2.js', 'resources/js/web-app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400&display=swap" rel="stylesheet">

    <style>

        * {
            font-family: "Poppins", sans-serif;
            font-weight: 400;
            font-style: normal;
        }

        .text_title {
            color: rgba(8, 23, 44, 1);
            font-weight: bold;
        }

        .gradient-custom-2 {
            /* fallback for old browsers */
            background: rgb(42, 177, 199);

            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(90deg, rgba(42, 177, 199, 1) 0%, rgba(41, 149, 209, 1) 50%, rgba(41, 94, 228, 1) 100%);

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(90deg, rgba(42, 177, 199, 1) 0%, rgba(41, 149, 209, 1) 50%, rgba(41, 94, 228, 1) 100%);
        }

        @media (min-width: 768px) {
            .gradient-form {
                height: 100vh !important;
            }
        }

        @media (min-width: 769px) {
            .gradient-custom-2 {
                border-top-right-radius: .3rem;
                border-bottom-right-radius: .3rem;
            }
        }

        @media (min-width: 768px) {
            #scale {
                transform: scale(0.8); /* Reduce el tamaño al 80% */
            }
        }

        /*--------------------------------------------------------------
        # Preloader
        --------------------------------------------------------------*/
        #preloader {
            position: fixed;
            inset: 0;
            z-index: 999999;
            overflow: hidden;
            background: #ffffff;
            transition: all 0.6s ease-out;
        }

        #preloader:before {
            content: "";
            position: fixed;
            top: calc(50% - 30px);
            left: calc(50% - 30px);
            border: 6px solid #ffffff;
            border-color: #1977cc transparent #1977cc transparent;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            animation: animate-preloader 1.5s linear infinite;
        }

        @keyframes animate-preloader {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .ima_profile_user{
            width: 200px;
            height: 200px;
            border-radius: 100%;
            object-fit: cover;
        }

    </style>

    @stack('css')
    @livewireStyles
</head>
<body style="background-color: #eee;">

<div class="position-relative gradient-form" style="min-height: 100vh;">
    <div class="<!--position-absolute--> <!--top-50--> <!--start-50--> <!--translate-middle--> container pt-5">


        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-xl-10">
                <div class="card rounded-3 text-black">
                    <div class="row g-0">
                        <div class="col-lg-6">
                            <div class="card-body mx-md-4 <!--position-relative-->" id="card_body">

                                <div class="text-center">
                                    {{--<a href="{{ route('web.index') }}" onclick="verCargandoAuth(this)">--}}
                                        <img class="img-fluid" src="{{ asset('img/cintillo.png') }}" alt="Foto del Participante">
                                    {{--</a>--}}
                                    <h6 class="pb-1 text_title">
                                        <strong>Consultar Participante</strong>
                                    </h6>
                                </div>


                                <img src="{{ verImagen($participante->fotografia, true) }}" class="img-thumbnail rounded mx-auto d-block ima_profile_user" alt="...">


                                <ol class="list-group mt-2 <!--list-group-numbered-->">
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <div class="fw-bold">Cédula:</div>
                                            <span class="text-uppercase">{{ is_numeric($participante->cedula) ? formatoMillares($participante->cedula, 0) : $participante->cedula }}</span>
                                        </div>
                                        {{--<span class="badge text-bg-primary rounded-pill">14</span>--}}
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <div class="fw-bold">Nombre Completo</div>
                                            <span class="text-uppercase">
                                                {{ $participante->primer_nombre }}
                                                {{ $participante->segundo_nombre }}
                                                {{ $participante->primer_apellido }}
                                                {{ $participante->segundo_apellido }}
                                            </span>
                                        </div>
                                        {{--<span class="badge text-bg-primary rounded-pill">14</span>--}}
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <div class="fw-bold">Club:</div>
                                            <span class="text-uppercase">{{ $participante->entidad->nombre }}</span>
                                        </div>
                                        {{--<span class="badge text-bg-primary rounded-pill">14</span>--}}
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <div class="fw-bold">Deporte:</div>
                                            <span class="text-uppercase">{{ $participante->deporteinicial->deporte }}</span>
                                        </div>
                                        {{--<span class="badge text-bg-primary rounded-pill">14</span>--}}
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <div class="fw-bold">Cargo:</div>
                                            <span class="text-uppercase">{{ $participante->cargo->cargo }}</span>
                                        </div>
                                        {{--<span class="badge text-bg-primary rounded-pill">14</span>--}}
                                    </li>
                                    @if($deportes->isNotEmpty())
                                        <li class="list-group-item justify-content-between align-items-start">
                                            <div class="ms-2 me-auto">
                                                <div class="fw-bold">Deportes y Modalidades:</div>
                                                <ol class="list-group list-group-numbered">
                                                    @foreach($deportes as $atleta)
                                                        <li class="list-group-item text-uppercase">
                                                            <small>{{ $atleta->deporte->deporte }} - {{ $atleta->modalidad->modalidad }}</small>
                                                        </li>
                                                    @endforeach
                                                </ol>
                                            </div>
                                            {{--<span class="badge text-bg-primary rounded-pill">14</span>--}}
                                        </li>
                                    @endif
                                </ol>





                            </div>
                        </div>
                        <div class="col-lg-6 d-none d-lg-flex align-items-center gradient-custom-2" style="min-height: 70vh">
                            <div class="text-white px-3 py-4 p-md-5 mx-md-4 text-center">
                                <img class="img-fluid rounded-2" src="{{ asset('img/logo_juegos_border_white.png') }}" alt="Logo Juegos FEDECIV">
                                {{--<h3>XIX Juegos FEDECIV</h3>
                                <a href="https://www.morros-devops.xyz" target="_blank"
                                   class="text-white text-decoration-none">“Maracaibo 2026”</a>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
<!-- Preloader -->
<div id="preloader"></div>

{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>--}}
<script type="application/javascript">

    //Script para ejecurar el preloader
    window.addEventListener('load', function () {
        document.querySelector('#preloader').classList.add('d-none');
    });

    //Validar Formularios
    (() => {
        'use strict'
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                } else {
                    mostrarPreloader();
                }
                form.classList.add('was-validated');
            }, false);
        })
    })();

    console.log('Hi!')
</script>

@include('layouts.sweetAlert2')
@stack('js')
@livewireScripts

<script>
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', () => {
            navigator.serviceWorker.register("{{ asset('service-worker.js') }}")
                .then(reg => console.log('✅ Service Worker registrado en:', reg.scope))
                .catch(err => console.error('⚠️ Error al registrar el Service Worker:', err));
        });
    }
</script>
</body>
</html>
