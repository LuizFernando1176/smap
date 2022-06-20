@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-12 mt-4">
                <a onclick="{{url('home')}}" title="Back"><button class="btn btn-warning btn-sm"><i
                            class="fa fa-arrow-left" aria-hidden="true"></i> {{ __('Back') }}</button></a>
                <a href="{{ url('/secretaria/' . $secretaria->id . '/edit') }}" title="Edit Secretarium"><button
                        class="btn btn-primary btn-sm"><i class="fa fa-pencil-square" aria-hidden="true"></i>
                        {{ __('Edit') }}</button></a>

                <form method="POST" action="{{ url('secretaria' . '/' . $secretaria->id) }}" accept-charset="UTF-8"
                    style="display:inline">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-danger btn-sm" title="Delete Secretarium"
                        onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash"
                            aria-hidden="true"></i> {{ __('Delete') }}</button>
                </form>
                <br />
                <br />
                <div class="card-title">
                    <h3 class="h3">{{ $secretaria->nome . ' - ' . $secretaria->sigla }}</h3>
                </div>
                <div class="card-text">
                    <ul style="list-style-type: none">
                        <li><b>Endereço:</b>
                            {{ $secretaria->logradouro . ', ' . $secretaria->numero . ' - ' . $secretaria->bairro }}</li>
                        <li><b>Responsável:</b> {{ $secretaria->responsavel }}</li>
                        <li><b>Representante(s) cadastrado(s):</b>
                            <ul style="list-style-type: none">
                                @if (!isset($usuarios) || sizeof($usuarios) < 1)
                                    <li>(ainda não possui)</li>
                                @else
                                    @foreach ($usuarios as $usuario)
                                        <li><a href="{{ url('user', ['id' => $usuario->id]) }}">{{ $usuario->name }}</a>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </li>
                        <li>
                            <b>Contato desta secretaria:</b>
                            <ul style="list-style-type: none">
                                <li><i class="bi bi-telephone"></i>&nbsp;{{ $secretaria->telefone }}</li>
                                <li><i class="bi bi-envelope"></i>&nbsp;{{ $secretaria->email }}</li>
                            </ul>
                        </li>
                        @if (isset($secretariasFilhas) && sizeof($secretariasFilhas) > 0)
                            <li>
                                <b>Secretaria(s) Executiva(s)</b>
                                <ul style="list-style-type: none">
                                    @foreach ($secretariasFilhas as $filha)
                                        <li><a
                                                href="{{ url('secretaria', ['id' => $filha->id]) }}">{{ $filha->nome }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                        @if ($secretariaMae->id != 1)
                            <li>
                                <b>Ligada a:</b>
                                &nbsp;<a
                                    href="{{ url('secretaria', ['id' => $secretariaMae->id]) }}">{{ $secretariaMae->nome }}</a>
                            </li>
                        @endif
                    </ul>
                </div>
                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="h5 text-center">Ações</h5>
                    </div>
                    <div class="card-body">
                        <a href="{{ url('/acao/create', ['idsecretaria' => $secretaria->id]) }}"
                            class="btn btn-success btn-sm mb-3" title="{{ __('Add New') }} Acao">
                            <i class="fa fa-plus" aria-hidden="true"></i> {{ __('Add New') }}
                        </a>
                        @if (isset($acoes) && sizeof($acoes) > 0)
                            <form method="GET" action="{{ url('/acao') }}" accept-charset="UTF-8"
                                class="form-inline my-2 my-lg-0 float-right" role="search">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search"
                                        placeholder="{{ __('Search...') }}" value="{{ request('search') }}">
                                    <span class="input-group-append">
                                        <button class="btn btn-secondary" type="submit">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </form>

                            <br />
                            <br />
                            <script>
                                document.addEventListener("DOMContentLoaded", function(){
                                    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
                                    var popoverList = popoverTriggerList.map(function(element){
                                        return new bootstrap.Popover(element);
                                    });
                                });
                                </script>
                                <script>
                                    $(document).ready(function(){
                                        $("#myBtn").click(function(){
                                            $("#myPopover").popover("show");
                                        }); 
                                    });
                                    </script>
                            <div class="table-responsive">
                                <table id="datatablesSimple" id="datatablesSimple" class="table">
                                    <thead>
                                        <tr>

                                            <th>Nome</th>
                                            <th>% Completo</th>
                                            <th>Prazo</th>
                                            <th>{{ __('Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($acoes as $item)
                                            <tr>

                                                <td>{{ $item->nome }} - 
                                                    <button type="button" id="myBtn" data-bs-toggle="popover" title="{{$item->nome}}" class="btn btn-orange" data-bs-content="{{$quantidadeAtividades}}"><i class="bi bi-info-circle-fill fa-1x"></i></button>
                                                    </td>
                                                <td>
                                                    <div class="progress bg-dark">
                                                        <div class="progress-bar
                                                        @if ($item->percentual < 33.0) {{ ' bg-danger' }}
                                                        @elseif($item->percentual >= 33.0 && $item->percentual < 66.0)
                                                            {{ ' bg-warning' }}
                                                        @else
                                                            {{ ' bg-success' }} @endif
                                                        "
                                                            role="progressbar" style="width: {{ $item->percentual }}%;"
                                                            aria-valuenow="{{ $item->percentual }}" aria-valuemin="0"
                                                            aria-valuemax="100">
                                                            {{ $item->percentual }}%
                                                        </div>
                                                    </div>

                                                </td>
                                                <td>{{ date_format(date_create($item->prazo), 'd/m/Y') }}</td>
                                                <td>
                                                    <a href="{{ url('/acao/' . $item->id) }}" title="View Acao"><button
                                                            class="btn btn-info btn-sm"><i class="fa fa-eye"
                                                                aria-hidden="true"></i> {{ __('View') }}</button></a>
                                                    <a href="{{ url('/acao/' . $item->id . '/edit') }}"
                                                        title="Edit Acao"><button class="btn btn-primary btn-sm"><i
                                                                class="fa fa-pencil-square" aria-hidden="true"></i>
                                                            {{ __('Edit') }}</button></a>

                                                    <form method="POST" action="{{ url('/acao' . '/' . $item->id) }}"
                                                        accept-charset="UTF-8" style="display:inline">
                                                        {{ method_field('DELETE') }}
                                                        {{ csrf_field() }}
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            title="Delete Acao"
                                                            onclick="return confirm(&quot;Confirm delete?&quot;)"><i
                                                                class="fa fa-trash" aria-hidden="true"></i>
                                                            {{ __('Delete') }}</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-info">
                                <p>Não foram encontradas ações atribuídas a esta secretaria em nossa base de dados</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
