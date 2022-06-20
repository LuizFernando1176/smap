@extends('layouts.app')

@section('content')
    <div class="row" id="user-profile">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="wideget-user mb-2">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="row">
                                    <div class="panel profile-cover">
                                        <div class="profile-cover__action bg-img">

                                        </div>
                                        <div class="profile-cover__img">
                                            <div class="profile-img-1">
                                                <img src="{{ asset('img/perfil.png') }}" alt="img">
                                            </div>
                                            <div class="profile-img-content text-dark text-start">
                                                <div class="text-dark">
                                                    <h3 class="h3 mb-2">{{ $user->name }}</h3>
                                                    <h5 class="text-muted">{{ $user->email }}</h5>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="">
                                        <div class="social social-profile-buttons mt-5 float-end">
                                            <div class="mt-3">
                                                <a class="social-icon text-danger"
                                                    title="Coordenadoria Geral de Informática"
                                                    alt="Coordenadoria Geral de Informática"
                                                    href="https://www.youtube.com/channel/UCmqKTg8dqrwv6qvEEdD44Rg"
                                                    target="_blank"><i class="fa  fa-youtube"
                                                        style="font-size: 2em"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Secretaria</div>
                        </div>
                        <div class="card-body">
                            <div>
                                <h5>Nome<i class="fe fe-map-pin fs-20 text-primary mx-2"></i></h5>
                                <p>{{ $secretarias[0]->nome }}</p>
                            </div>
                            <hr>
                            <div class="d-flex align-items-center mb-3 mt-3">

                                <div>
                                    <h5>Sigla<i class="fe fe-map-pin fs-20 text-primary mx-2"></i></h5>
                                    <p>{{ $secretarias[0]->sigla }}</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-3 mt-3">
                                <div class="me-4 text-center text-primary">
                                    <span><i class="fe fe-map-pin fs-20"></i></span>
                                </div>
                                <div>
                                    <strong>Responsável, {{ $secretarias[0]->responsavel }}</strong>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-3 mt-3">
                                <div class="me-4 text-center text-primary">
                                    <span><i class="fe fe-phone fs-20"></i></span>
                                </div>
                                <div>
                                    <strong>
                                        @if ($secretarias[0]->telefone == '' || $secretarias[0]->telefone == null)
                                            (Telefone não informado)
                                        @else
                                            {{ $secretarias[0]->telefone }}
                                        @endif
                                    </strong>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-3 mt-3">
                                <div class="me-4 text-center text-primary">
                                    <span><i class="fe fe-mail fs-20"></i></span>
                                </div>
                                <div>
                                    <strong>
                                        @if ($secretarias[0]->email == '' || $secretarias[0]->email == null)
                                            (E-mail não informado)
                                        @else
                                            {{ $secretarias[0]->email }}
                                        @endif
                                    </strong>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="col-xl-6">

                    <div class="card border p-0 shadow">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="col-sm-6 col-md-6 col-xl-3">
                                    <a class="modal-effect btn btn-secondary-light btn-hero text-dark "
                                        data-bs-effect="effect-super-scaled" data-bs-toggle="modal" href="#modaldemo8">Mudar
                                        Senha</a>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="card border p-0 shadow-none">


                    </div>
                </div>

            </div>
        </div>
        <!-- COL-END -->
    </div>

    <!-- MODAL EFFECTS -->
    <div class="modal fade" id="modaldemo8">
        <div class="modal-dialog modal-dialog-centered text-center" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title"></h6><button aria-label="Close" class="btn-close"
                        data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="col-xl-12">

                        <div class="card border p-0 shadow-lg">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="media mt-0">
                                        <div class="media-user me-2">
                                            <div class=""><img alt="" class="rounded-circle avatar avatar-md"
                                                    src="{{ asset('img/perfil.png') }}"></div>
                                            <!---->
                                        </div>
                                        <div class="media-body">
                                            <h6 class="mb-0 mt-1">Mudar Senha</h6>
                                            <small class="text-danger">Esse formulário deve ser usado para alterar a
                                                senha no
                                                proximo login.
                                            </small>

                                        </div>
                                    </div>

                                </div>
                                <div class="mt-4 text-center">
                                    <h4 class="fw-semibold mt-3">Mudança de senha</h4>
                                    <p class="mb-0">
                                    <form method="POST" action="{{url('perfil/mudarSenha')}}/{{$user->id}}">
                                        @csrf
                                        <label for="password">Senha:</label>
                                        <input type="password" id="password" name="password" class="form-control">
                                        <button type="submit" class="btn btn-primary mt-2">Mudar a senha</button>
                                    </form>
                                    </p>
                                </div>
                            </div>

                        </div>

                        <div class="card border p-0 shadow-none">


                        </div>
                    </div>
                </div>

            </div>
        </div>
    @endsection
