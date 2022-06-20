@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ __('Prefeitura de Olinda - Secretarias') }}  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <a class="btn btn-primary rigth " href="{{url('secretaria/create')}}"><i class="fe fe-plus"></i>Adicionar Secretaria</a>
                    </div>
                    <div class="accordion" id="accordionExample">
                        @foreach ($secretarias as $i => $secretarium)
                            <div class="accordion-item">
                                <h3 class="accordion-header" id="heading{{ $i }}"></h3>
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse{{ $i }}" aria-expanded="true"
                                    aria-controls="collapse{{ $i }}">
                                    {{ $secretarium->nome }}&nbsp;-&nbsp;{{ $secretarium->sigla }}
                                </button>

                                <div id="collapse{{ $i }}" class="accordion-collapse collapse"
                                    aria-labelledby="heading{{ $i }}" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <h5>Responsável pela secretaria&nbsp;-&nbsp;{{ $secretarium->responsavel }}
                                        </h5><br>
                                        <button class="btn btn-info" onclick="window.location.href = '{{url('secretaria', ['id' => $secretarium->id])}}'">Ver detalhes</button><br>

                                        <div class="accordion" id="accordionExample{{ $secretarium->sigla }}">
                                            @if (isset($nomeSecretariasFilhas[$secretarium->id]) && $nomeSecretariasFilhas[$secretarium->id] != [])
                                                @foreach ($nomeSecretariasFilhas[$secretarium->id] as $i => $filha)
                                                    <div class="accordion-item">
                                                        <h6 class="accordion-header" id="headingFilha{{ $i }}">
                                                        </h6>
                                                        <button class="accordion-button" type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#collapseFilha{{ $i }}"
                                                            aria-expanded="true"
                                                            aria-controls="collapseFilha{{ $i }}">
                                                            {{ $filha->nome }}&nbsp;-&nbsp;{{ $filha->sigla }}
                                                        </button>

                                                        <div id="collapseFilha{{ $i }}"
                                                            class="accordion-collapse collapse"
                                                            aria-labelledby="headingFilha{{ $i }}"
                                                            data-bs-parent="#accordionExample{{ $secretarium->sigla }}">
                                                            <div class="accordion-body">
                                                                <h5>Responsável pela
                                                                    secretaria&nbsp;-&nbsp;{{ $filha->responsavel }}
                                                                </h5><br><br>
                                                                <button class="btn btn-info" onclick="window.location.href = '{{url('secretaria', ['id' => $filha->id])}}'">Ver detalhes</button><br>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
