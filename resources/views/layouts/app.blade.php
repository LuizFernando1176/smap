<!doctype html>
<html lang="en" dir="ltr">
<head>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/indice.png') }}" />
    <!-- TITLE -->
    <title>{{ env('APP_NAME') }} </title>

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" />
    <link id="style" href="{{ asset('css/color1.css') }}" rel="stylesheet" />
    <link id="style" href="{{ asset('css/dark-style.css') }}" rel="stylesheet" />
    <link id="style" href="{{ asset('css/animated.css') }}" rel="stylesheet" />
    <link id="style" href="{{ asset('css/style.css') }}" rel="stylesheet" />
    <link id="style" href="{{ asset('css/transparent-style.css') }}" rel="stylesheet" />
    <link id="style" href="{{ asset('css/bootstrap-icons.css') }}" rel="stylesheet" />
    <link id="style" href="{{ asset('css/icons.css') }}" rel="stylesheet" />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="{{asset('js/core/datatables.min.js')}}" ></script>
    <script src="{{asset('js/core/datatable.js')}}"></script>

</head>
<body>
    @include('layouts.header')
    <!-- /app-Header -->
    <div class=" container">
        <div>
            <div class="container">
                <div class="row mt-5">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <div>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item "><a href="{{url('home')}}"><i class="bi bi-house-fill"></i></a></li>
                                        @isset($secretaria)
                                            <li class="breadcrumb-item active" aria-current="page"><a href="{{url('/secretaria', ['id' => $secretaria->id])}}" style="text-decoration: none">{{$secretaria->sigla}}</a></li>
                                        @endisset
                                        @isset($acao)
                                            <li class="breadcrumb-item active" aria-current="page"><a href="{{url('/acao', ['id' => $acao->id])}}" style="text-decoration: none">{{$acao->nome}}</a></li>
                                        @endisset
                                        @isset($atividade)
                                            <li class="breadcrumb-item active" aria-current="page"><a href="{{url('/atividade', ['id' => $atividade->id])}}" style="text-decoration: none">{{$atividade->nome}}</a></li>
                                        @endisset
                                    </ol>
                                </div>
                            </div>
                            <div class="card-body">

                                @yield('content')

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    @include('layouts.footer')
    <!-- FOOTER END -->

    </div>

    <!-- BACK-TO-TOP -->
    <a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>
</body>

</html>
