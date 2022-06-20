@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-12 mt-4">
                <a onclick="{{url('acao', ['id', $acao->id])}}" title="Back"><button class="btn btn-warning btn-sm"><i
                            class="fa fa-arrow-left" aria-hidden="true"></i> {{ __('Back') }}</button></a>
                <a href="{{ url('/atividade/' . $atividade->id . '/edit') }}" title="Edit Atividade"><button
                        class="btn btn-primary btn-sm"><i class="fa fa-pencil-square" aria-hidden="true"></i>
                        {{ __('Edit') }}</button></a>

                <form method="POST" action="{{ url('atividade' . '/' . $atividade->id) }}" accept-charset="UTF-8"
                    style="display:inline">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-danger btn-sm" title="Delete Atividade"
                        onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash"
                            aria-hidden="true"></i> {{ __('Delete') }}</button>
                </form>
                <br />
                <br />
                <div class="card-title">
                    <h3 class="h3">{{ $atividade->nome }}</h3>
                </div>
                <div class="card-text">
                    <ul style="list-style-type: none">
                        <li><b>Cadastrada em:</b>
                            {{ date_format(date_create($atividade->created_at), 'd/m/Y') }}
                        </li><br>
                        <li><b>Percentual completo:</b>
                            <div class="progress bg-dark">
                                <div class="progress-bar
                                    @if ($atividade->percentual < 33.0) {{ ' bg-danger' }}
                                    @elseif($atividade->percentual >= 33.0 && $atividade->percentual < 66.0)
                                        {{ ' bg-warning' }}
                                    @else
                                        {{ ' bg-success' }}
                                        @endif
                                    "
                                    role="progressbar" style="width: {{ $atividade->percentual }}%;"
                                    aria-valuenow="{{ $atividade->percentual }}" aria-valuemin="0"
                                    aria-valuemax="100">
                                    {{ $atividade->percentual }}%
                                </div>
                            </div>
                        </li><br>
                        <li><b>Prazo:</b>
                            {{ date_format(date_create($atividade->prazo), 'd/m/Y').' ('.$atePrazo.')' }}
                        </li><br>
                        <li><b>Status:</b> <span>{{$atividade->status}}</span></li><br>
                        <li><b>Responsável:</b> <span>{{$atividade->responsavel}}</span></li><br>
                        <li><b>Contempla alguma PPA?</b>
                            @if ($atividade->pPA)
                                {{$atividade->numeroPPA}}
                            @else
                                <span class="badge bg-danger">Não</span>
                            @endif
                        </li><br>
                        @if ($atividade->observacao != "")
                            <li><b>Observação</b><br>
                                <p>{{$atividade->observacao}}</p>
                            </li><br>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-md-12 mt-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="h5 text-center">Histórico desta atividade</h5>
                    </div>
                    <div class="card-body bg-light">
                        <div class="row">
                            <div class="col-md-3">
                                <button class="btn btn-success"
                                    onclick="window.location.href = '{{ url('/historico/create', ['idAtividade' => $atividade->id]) }}'">
                                    <i class="fa fa-plus"></i>&nbsp;Adicionar histórico
                                </button>
                            </div>
                        </div>
                        @if (isset($historicos) && sizeof($historicos) > 0)
                            @foreach ($historicos as $i => $historico)
                                <div class="row bg-white border p-3 m-3">
                                    <div class="col-12 mb-3">
                                        <h4 class="h4 text-center">
                                            {{ date_format(date_create($historico->created_at), 'd/m/Y H:i:s') }} -
                                            {{ $historico->descricao }}</h4>

                                    </div>
                                    <div class="col-12 mb-3">
                                        <a href="{{ url('/historico/' . $historico->id . '/edit') }}" title="Edit Historico"><button
                                            class="btn btn-primary btn-sm"><i class="fa fa-pencil-square" aria-hidden="true"></i>
                                            {{ __('Edit') }}</button></a>

                                        <form method="POST" action="{{ url('historico' . '/' . $historico->id) }}" accept-charset="UTF-8"
                                            style="display:inline">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Historico"
                                                onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash"
                                                    aria-hidden="true"></i> {{ __('Delete') }}</button>
                                        </form>
                                    </div>
                                    @isset($fotos)
                                        <hr>
                                        @foreach ($fotos[$i] as $foto)
                                            @if ($foto->idHistorico == $historico->id)
                                                <div class="col-lg-4">
                                                    <div class="card shadow p-1" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal">
                                                        <img src="{{ asset('storage/' . $foto->foto) }}"
                                                            class="card-img-top">
                                                        <div class="card-body">
                                                            <p class="card-text">{{ $foto->legenda }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endisset
                                </div>
                            @endforeach
                        @else
                            <div class="alert alert-info">
                                <p>Não foram encontrados históricos de atividades em nossa base de dados.</p>
                            </div>
                        @endisset
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">

                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Próxima</span>
                    </button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<script>
    $('.p-1').click(function() {
        let historicoCorpo = $(this).parent().parent().children();
        let fotos = [];
        $.each(historicoCorpo, function(key, coluna) {
            if (key > 0) {
                if (key == 1) {
                    $('.carousel-inner').append(
                        '<div class="carousel-item active">' +
                        '<img src="' + $(coluna).children('.card').children('img').prop('src') +
                        '" class="d-block w-100" alt="">' +
                        '<div class="carousel-caption d-none d-md-block bg-dark">' +
                        '<p>' + $(coluna).children('.card').children('.card-body').children(
                            '.card-text').html() + '</p>' +
                        '</div>' +
                        '</div>');
                } else {
                    $('.carousel-inner').append(
                        '<div class="carousel-item">' +
                        '<img src="' + $(coluna).children('.card').children('img').prop('src') +
                        '" class="d-block w-100" alt="">' +
                        '<div class="carousel-caption d-none d-md-block bg-dark">' +
                        '<p>' + $(coluna).children('.card').children('.card-body').children(
                            '.card-text').html() + '</p>' +
                        '</div>' +
                        '</div>');
                }
            }
        })
    });
</script>
@endsection
