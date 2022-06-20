@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')
            <div class="col-md-12 mt-4">
                <a onclick="{{url('secretaria', ['id', $secretaria->id])}}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left"
                            aria-hidden="true"></i> {{ __('Back') }}</button></a>
                <a href="{{ url('/acao/' . $acao->id . '/edit') }}" title="Edit Acao"><button
                        class="btn btn-primary btn-sm"><i class="fa fa-pencil-square" aria-hidden="true"></i>
                        {{ __('Edit') }}</button></a>

                <form method="POST" action="{{ url('acao' . '/' . $acao->id) }}" accept-charset="UTF-8"
                    style="display:inline">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-danger btn-sm" title="Delete Acao"
                        onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash"
                            aria-hidden="true"></i> {{ __('Delete') }}</button>
                </form>
                <br />
                <br />
                <div class="card-title">
                    <h3 class="h3">{{ $acao->nome }}</h3>
                </div>
                <div class="card-text">
                    <ul style="list-style-type: none">
                        <li><b>Cadastrada em:</b>
                            {{ date_format(date_create($acao->created_at), 'd/m/Y') }}</li><br>
                        <li><b>Percentual completo:</b>
                            <div class="progress bg-dark">
                                <div class="progress-bar
                                    @if ($acao->percentual < 33.0) {{ ' bg-danger' }}
                                    @elseif($acao->percentual >= 33.0 && $acao->percentual < 66.0)
                                        {{ ' bg-warning' }}
                                    @else
                                        {{ ' bg-success' }} @endif
                                    "
                                    role="progressbar" style="width: {{ $acao->percentual }}%;"
                                    aria-valuenow="{{ $acao->percentual }}" aria-valuemin="0" aria-valuemax="100">
                                    {{ $acao->percentual }}%
                                </div>
                            </div>
                        </li><br>
                        <li><b>Prazo:</b>
                            {{ date_format(date_create($acao->prazo), 'd/m/Y') . ' (' . $atePrazo . ')' }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-4">
            <div class="card mt-3">
                <div class="card-header h5 text-center">Atividades nesta Ação</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <a href="{{ url('/atividade/create', ['idAcao' => $acao->id]) }}"
                                class="btn btn-success btn-sm mb-3" title="{{ __('Add New') }} Atividade">
                                <i class="fa fa-plus" aria-hidden="true"></i> {{ __('Add New') }}
                            </a>
                        </div>
                    </div>
                    @if (empty($atividades))
                        <div class="alert alert-info text-center fa-2x">Esta ação ainda não possui atividades.</div>
                    @else
                        <div class="row">
                            <div class="col-md-12">
                                <table id="datatablesSimple" class="table">
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Percentual</th>
                                            <th>Prazo</th>
                                            <th>Status</th>
                                            <th>Responsável</th>
                                            <th>Contempla PPA?</th>
                                            <th>Numero PPA</th>
                                            <th>{{ __('Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($atividades as $item)
                                            <tr {{ $item->status }}>
                                                <td>{{ $item->nome }}</td>
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
                                                    @switch($item->status)
                                                        @case('Concluída')
                                                            <span class='badge bg-success'>Concluída</span>
                                                        @break

                                                        @case('Em execução')
                                                            <span class="badge bg-warning">Em execução</span>
                                                        @break

                                                        @case('Paralizada')
                                                            <span class="badge bg-danger">Paralizada</span>
                                                        @break

                                                        @default
                                                            <i class="bi bi-question"></i>
                                                        @break
                                                    @endswitch
                                                </td>
                                                <td>{{ $item->responsavel }}</td>
                                                <td>
                                                    @if ($item->pPA == 0)
                                                        <span class="badge bg-danger">não</span>
                                                    @else
                                                        <span class="badge bg-success">sim</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($item->pPA == 0)
                                                        {{ '(não contempla)' }}
                                                    @else
                                                        {{ $item->numeroPPA }}
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ url('/atividade/' . $item->id) }}"
                                                        title="View Atividade"><button class="btn btn-info btn-sm"><i
                                                                class="fa fa-eye" aria-hidden="true"></i>
                                                            {{ __('View') }}</button></a>
                                                    <a href="{{ url('/atividade/' . $item->id . '/edit') }}"
                                                        title="Edit Atividade"><button class="btn btn-primary btn-sm"><i
                                                                class="fa fa-pencil-square" aria-hidden="true"></i>
                                                            {{ __('Edit') }}</button></a>

                                                    <form method="POST"
                                                        action="{{ url('/atividade' . '/' . $item->id) }}"
                                                        accept-charset="UTF-8" style="display:inline">
                                                        {{ method_field('DELETE') }}
                                                        {{ csrf_field() }}
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            title="Delete Atividade"
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
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
