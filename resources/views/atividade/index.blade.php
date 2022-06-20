@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-12 mt-4">
                <div class="card">
                    <div class="card-header">Atividade</div>
                    <div class="card-body">
                        <a href="{{ url('/atividade/create') }}" class="btn btn-success btn-sm mb-3" title="{{ __('Add New') }} Atividade">
                            <i class="fa fa-plus" aria-hidden="true"></i> {{ __('Add New') }}
                        </a>

                        <form method="GET" action="{{ url('/atividade') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="{{ __('Search...') }}" value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                             <table id="datatablesSimple" class="table">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Nome</th><th>Percentual</th><th>Prazo</th><th>{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($atividade as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nome }}</td>
                                        <td>
                                            <div class="progress bg-dark">
                                                <div class="progress-bar
                                                @if ($item->percentual < 33.0)
                                                    {{ ' bg-danger' }}
                                                @elseif($item->percentual >= 33.0 && $item->percentual < 66.0)
                                                    {{ ' bg-warning' }}
                                                @else
                                                    {{ ' bg-success' }}
                                                @endif
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
                                            <a href="{{ url('/atividade/' . $item->id) }}" title="View Atividade"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> {{ __('View') }}</button></a>
                                            <a href="{{ url('/atividade/' . $item->id . '/edit') }}" title="Edit Atividade"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square" aria-hidden="true"></i> {{ __('Edit') }}</button></a>

                                            <form method="POST" action="{{ url('/atividade' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Atividade" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash" aria-hidden="true"></i> {{ __('Delete') }}</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $atividade->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
