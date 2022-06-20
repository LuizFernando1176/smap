<div class="row">
    <div class="col-md-10">
        <div class="form-group {{ $errors->has('nome') ? 'has-error' : ''}}">
            <label for="nome" class="form-label">{{ 'Nome' }}</label>
            <input class="form-control" name="nome" type="text" id="nome" value="{{ isset($secretarium->nome) ? $secretarium->nome : ''}}" required>
            {!! $errors->first('nome', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('sigla') ? 'has-error' : ''}}">
            <label for="sigla" class="form-label">{{ 'Sigla' }}</label>
            <input class="form-control" name="sigla" type="text" id="sigla" value="{{ isset($secretarium->sigla) ? $secretarium->sigla : ''}}" required>
            {!! $errors->first('sigla', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('idSecretariaPai') ? 'has-error' : ''}}">
            <label for="idSecretariaPai" class="form-label">{{ 'Pertence a...' }}</label>
            <select class="form-select" name="idSecretariaPai" id="idSecretariaPai">
                @isset($secretarias)
                    @foreach ($secretarias as $secretaria)
                        <option value="{{$secretaria->id}}" @if(isset($secretarium) && $secretarium->idSecretariaPai == $secretaria->id) {{" selected"}} @endif>{{$secretaria->nome}}</option>
                    @endforeach
                @endisset
            </select>
            {!! $errors->first('idSecretariaPai', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>
<div class="form-group {{ $errors->has('responsavel') ? 'has-error' : ''}}">
    <label for="responsavel" class="form-label">{{ 'Responsável' }}</label>
    <input class="form-control" name="responsavel" type="text" id="responsavel" value="{{ isset($secretarium->responsavel) ? $secretarium->responsavel : ''}}" >
    {!! $errors->first('responsavel', '<p class="help-block">:message</p>') !!}
</div>
<hr>
<div class="row mb-3">
    <div class="col-md-12">
        <label class="form-label text-secondary text-large">{{ 'Endereço' }}</label>
    </div>
    <div class="col-md-8">
        <div class="form-group {{ $errors->has('logradouro') ? 'has-error' : ''}}">
            <label for="logradouro" class="form-label">{{ 'Logradouro' }}</label>
            <input class="form-control" name="logradouro" type="text" id="logradouro" value="{{ isset($secretarium->logradouro) ? $secretarium->logradouro : ''}}" >
            {!! $errors->first('logradouro', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-1">
        <div class="form-group {{ $errors->has('numero') ? 'has-error' : ''}}">
            <label for="numero" class="form-label">{{ 'Número' }}</label>
            <input class="form-control" name="numero" type="text" id="numero" value="{{ isset($secretarium->numero) ? $secretarium->numero : ''}}" >
            {!! $errors->first('numero', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group {{ $errors->has('bairro') ? 'has-error' : ''}}">
            <label for="bairro" class="form-label">{{ 'Bairro' }}</label>
            <input class="form-control" name="bairro" type="text" id="bairro" value="{{ isset($secretarium->bairro) ? $secretarium->bairro : ''}}" >
            {!! $errors->first('bairro', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>
<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? __('Update') : __('Create') }}">
</div>
