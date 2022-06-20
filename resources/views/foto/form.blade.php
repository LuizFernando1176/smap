<div class="form-group {{ $errors->has('legenda') ? 'has-error' : ''}}">
    <label for="legenda" class="control-label">{{ 'Legenda' }}</label>
    <input class="form-control" name="legenda" type="text" id="legenda" value="{{ isset($foto->legenda) ? $foto->legenda : ''}}" >
    {!! $errors->first('legenda', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('foto') ? 'has-error' : ''}}">
    <label for="foto" class="control-label">{{ 'Foto' }}</label>
    <input class="form-control" name="foto" type="file" id="foto" value="{{ isset($foto->foto) ? $foto->foto : ''}}" required>
    {!! $errors->first('foto', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('idHistorico') ? 'has-error' : ''}}">
    <label for="idHistorico" class="control-label">{{ 'Histórico' }}</label>
    <input class="form-control" name="idHistorico" type="number" id="idHistorico" value="{{ isset($foto->idHistorico) ? $foto->idHistorico : ''}}" required>
    {!! $errors->first('idHistorico', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
