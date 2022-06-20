<script>
    function excluirFoto(link, idHistorico){
        $.ajax({
            "method": "GET",
            "url" : "{{url('excluirFoto')}}/"+idHistorico
        }).done(function(resposta){
            console.log(resposta);
            let card = $(link).parent().parent().parent().parent();
            $(card).children("img").attr("src", "");
            $(card).parent().children("input[name=foto]").attr("value", "");
        }).fail(function(resposta){
            console.log(JSON.parse(resposta.responseText).message);
        });
    }

    function disparaInput(link){
        let inputFoto = $(link).parent().parent().parent().parent().children(".card-footer").children(".row").children(".col-12:eq(0)").children("input");
        $(inputFoto).trigger('click');
    }

    function mudaImagem(inputFoto){
        //Remove a imagem preview anterior
        let card = $(inputFoto).parent().parent().parent().parent();
        $(card).children("img").remove();

        //Coloca nova imagem preview
        let image = document.createElement("img");
        image.src = URL.createObjectURL($(inputFoto).prop("files")[0]);
        image.class = "card-img-top";

        //Anexa em card
        $(card).prepend(image);
        $(card).children('.card-body').children('.row').html(
            '<div class="col-6 text-center">'
                +'<a onclick="disparaInput(this)" alt="Trocar a imagem" class="btn btn-info">'
                    +'<i class="text-center text-white bi bi-pencil-square"></i>'
                +'</a>'
            +'</div>'
            +'<div class="col-6 text-center">'
                +'<a onclick="excluirFoto(this, 0)" alt="Excluir imagem" class="btn btn-danger">'
                    +'<i class="text-center bi bi-trash"></i>'
                +'</a>'
            +'</div>');
    }

    $(function(){
        $('#adicionarFoto').click(function(){
            $('#fotos').append('<div class="col-md-4">'
                +'<div class="card" id="imagem">'
                    +'<img src="" alt="" class="card-img-top">'
                    +'<div class="card-body">'
                        +'<div class="row">'
                            +'<div class="col-12 text-center">'
                                +'<a onclick="disparaInput(this)" alt="Trocar a imagem" style="color: inherit; text-decoration: inherit;">'
                                    +'<i class="text-center fs-3 bi bi-plus-square-fill"></i>'
                                +'</a>'
                            +'</div>'
                        +'</div>'
                    +'</div>'
                    +'<div class="card-footer">'
                        +'<div class="row">'
                            +'<div class="col-12">'
                                +'<input class="form-control" name="foto[]" type="file" value="" style="display: none" onchange="mudaImagem(this)">'
                            +'</div>'
                            +'<div class="col-12">'
                                +'<input class="form-control" name="legenda[]" type="text" id="legenda" value="" placeholder="Adicione uma legenda (opcional)">'
                            +'</div>'
                        +'</div>'
                    +'</div>'
                +'</div>');
        });
    });
</script>
<div class="form-group {{ $errors->has('descricao') ? 'has-error' : ''}}">
    <label for="descricao" class="form-label">{{ 'Descrição' }}</label>
    <textarea class="form-control" rows="5" name="descricao" type="textarea" id="descricao" required>{{ isset($historico->descricao) ? $historico->descricao : ''}}</textarea>
    {!! $errors->first('descricao', '<p class="help-block">:message</p>') !!}
</div>
<hr>
@php $nFotos = 0; @endphp
<div class="form-group mt-3 {{ $errors->has('foto') ? 'has-error' : ''}}">
    <label for="fotos" class="form-label">{{ 'Fotos' }}</label>
    <div class="row" id="fotos">
        @isset($fotos)
            @foreach ($fotos as $i => $foto)
                <div class="col-md-4">
                    <div class="card" id="imagem">
                        <img src="@if(isset($foto) && !is_null($foto->foto)) {{ asset('storage/').$foto->foto }} @endif" alt="" class="card-img-top">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6 text-center">
                                    <a onclick="disparaInput(this)" alt="Trocar a imagem" class="btn btn-info">
                                        <i class="text-center text-white bi bi-pencil-square"></i>
                                    </a>
                                </div>
                                <div class="col-6 text-center">
                                    <a onclick='excluirFoto(this, @if(isset($foto) && !is_null($foto->foto)) {{ asset("storage/").$foto->foto }} @endif)' alt="Excluir imagem" class="btn btn-danger">
                                        <i class="text-center bi bi-trash"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-12">
                                    <input class="form-control" name="foto[]" type="file" value="{{ isset($foto->foto) ? $foto->foto : ''}}" style="display: none" onchange="mudaImagem(this)">
                                    {!! $errors->first('foto', '<p class="help-block">:message</p>') !!}
                                </div>
                                <div class="col-12">
                                    <input class="form-control" name="legenda[]" type="text" id="legenda" value="{{ isset($foto->legenda) ? $foto->legenda : ''}}" placeholder="Adicione uma legenda (opcional)" >
                                    {!! $errors->first('legenda', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @php $nFotos = $i; @endphp
            @endforeach
        @endisset
        <div class="col-md-4">
            <div class="card" id="imagem">
                <img src="" alt="" class="card-img-top">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 text-center">
                            <a onclick="disparaInput(this)" alt="Trocar a imagem" style="color: inherit; text-decoration: inherit;">
                                <i class="text-center fs-3 bi bi-plus-square-fill"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-12">
                            <input class="form-control" name="foto[]" type="file" value="" style="display: none" onchange="mudaImagem(this)">
                        </div>
                        <div class="col-12">
                            <input class="form-control" name="legenda[]" type="text" id="legenda" value="" placeholder="Adicione uma legenda (opcional)" >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-group mt-3" id="botaoFoto">
    <div class="row">
        <div class="col-md-3">
            <a class="btn btn-success" id="adicionarFoto">
                <i class="fa fa-plus"></i>&nbsp;Adicionar outra foto
            </a>
        </div>
    </div>
</div>
<input class="form-control" name="idAtividade" type="hidden" id="idAtividade" value="{{ isset($historico->idAtividade) ? $historico->idAtividade : $idAtividade }}" >
<div class="form-group mt-3">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? __('Update') : __('Create') }}">
</div>
