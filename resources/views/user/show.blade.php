@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-12 mt-4">
                <a onclick="{{url('home')}}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left"
                            aria-hidden="true"></i> {{ __('Back') }}</button></a>
                <a href="{{ url('/user/' . $user->id . '/edit') }}" title="Edit user"><button
                        class="btn btn-primary btn-sm"><i class="fa fa-pencil-square" aria-hidden="true"></i>
                        {{ __('Edit') }}</button></a>

                <form method="POST" action="{{ url('user' . '/' . $user->id) }}" accept-charset="UTF-8"
                    style="display:inline">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-danger btn-sm" title="Delete user"
                        onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash"
                            aria-hidden="true"></i> {{ __('Delete') }}</button>
                </form>
                <br />
                <br />

                <div class="table-responsive">
                    <table id="datatablesSimple" class="table">
                        <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $user->id }}</td>
                            </tr>
                            <tr>
                                <th> Name </th>
                                <td> {{ $user->name }} </td>
                            </tr>
                            <tr>
                                <th> Email </th>
                                <td> {{ $user->email }} </td>
                            </tr>
                            <tr>
                                <th> Secretaria </th>
                                <td> {{ $user->idSecretaria }} </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
