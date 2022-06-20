<div class="form-group {{ $errors->has('nome') ? 'has-error' : ''}}">
    <label for="nome" class="form-label">{{ 'Nome' }}</label>
    <input class="form-control" name="nome" type="text" id="nome" value="{{ isset($acao->nome) ? $acao->nome : ''}}" required>
    {!! $errors->first('nome', '<p class="help-block">:message</p>') !!}
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('prazo') ? 'has-error' : ''}}">
            <label for="prazo" class="form-label">{{ 'Prazo' }}</label>
            <input class="form-control" name="prazo" type="date" id="prazo" value="{{ isset($acao->prazo) ? $acao->prazo : ''}}" >
            {!! $errors->first('prazo', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('exercicio') ? 'has-error' : ''}}">
            <label for="exercicio" class="form-label">{{ 'Exercício' }}</label>
            <input class="form-control" name="exercicio" type="number" id="exercicio" value="{{ isset($acao->exercicio) ? $acao->exercicio : ''}}" required>
            {!! $errors->first('exercicio', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
            <label for="status" class="form-label">{{ 'Status' }}</label>
            <select name="status" class="form-select" id="status" >
            @foreach (json_decode('{"em execu\u00e7\u00e3o":"Em execu\u00e7\u00e3o","parada":"Parada","cancelada":"Cancelada","conclu\u00edda":"Conclu\u00edda"}', true) as $optionKey => $optionValue)
                <option value="{{ $optionKey }}" {{ (isset($acao->status) && $acao->status == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
            @endforeach
        </select>
            {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>
<input type="hidden" name="idSecretaria" value="{{$secretaria->id}}">

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? __('Update') : __('Create') }}">
</div>
