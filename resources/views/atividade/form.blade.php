<script>
    $(function(){
        $('#percentual').change(function(){
            $('#valorPercentual').html($(this).prop('value')+'%');
            if($(this).prop('value') == "100"){
                $("select option:nth-child(1)").removeAttr('selected');
                $("select option:nth-child(4)").attr('selected','selected');
            }else{
                $("select option:nth-child(4)").removeAttr('selected');
                $("select option:nth-child(1)").attr('selected','selected');
            }
        });

        $("input[name='pPA']").change(function(){
            if($(this).prop('value') == 0){
                $('#divNumeroPPA').attr('style', 'display:none');
            }else{
                $('#divNumeroPPA').attr('style', 'display:block');
            }
        });
    })
</script>
<div class="form-group {{ $errors->has('nome') ? 'has-error' : ''}}">
    <label for="nome" class="form-label">{{ 'Nome' }}</label>
    <input class="form-control" name="nome" type="text" id="nome" value="{{ isset($atividade->nome) ? $atividade->nome : ''}}" required>
    {!! $errors->first('nome', '<p class="help-block">:message</p>') !!}
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('percentual') ? 'has-error' : ''}}">
            <label for="percentual" class="form-label">{{ 'Quanto está completo? (%)' }}</label><br>
            <input class="form-range" name="percentual" type="range" min="0" max="100" step="0.1" id="percentual" value="{{ isset($atividade->percentual) ? $atividade->percentual : ''}}" ><br>
            <div class="row">
                <div class="col-md-5"></div>
                <div class="col-md-2">
                    <small class="text-center text-small" id="valorPercentual">{{ isset($atividade->percentual) ? $atividade->percentual : ''}}%</small>
                </div>
                <div class="col-md-5"></div>
            </div>
            {!! $errors->first('percentual', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
            <label for="status" class="form-label">{{ 'Status' }}</label>
            <select name="status" class="form-select" id="status" >
            @foreach (json_decode('{"Em Execu\u00e7\u00e3o":"Em Execu\u00e7\u00e3o","Parada":"Parada","Cancelada":"Cancelada","Conclu\u00edda":"Conclu\u00edda"}', true) as $optionKey => $optionValue)
                <option value="{{ $optionKey }}" {{ (isset($atividade->status) && $atividade->status == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
            @endforeach
            </select>
            {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group {{ $errors->has('prazo') ? 'has-error' : ''}}">
            <label for="prazo" class="form-label">{{ 'Prazo' }}</label>
            <input class="form-control" name="prazo" type="date" id="prazo" value="{{ isset($atividade->prazo) ? $atividade->prazo : ''}}" required>
            {!! $errors->first('prazo', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            @isset($responsaveis)
                <label for="responsavel" class="form-label">Responsável</label>
                <select name="responsavel" id="responsavel" class="form-select">
                    @foreach ($responsaveis as $responsavel)
                        <option value="{{$responsavel->id}}" @if(isset($atividade) && $atividade->responsavel == $responsavel->id ) {{' selected="selected"'}} @endif>
                            {{$responsavel->name.' ('.$responsavel->sigla.')'}}
                        </option>
                    @endforeach
                </select>
            @endisset
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('pPA') ? 'has-error' : ''}}">
            <label for="pPA" class="form-label">{{ 'Contempla PPA?' }}</label>
            <div class="radio">
                <label><input name="pPA" type="radio" value="1" {{ (isset($atividade) && 1 == $atividade->pPA) ? 'checked' : '' }}> {{__('Yes')}}</label>
            </div>
            <div class="radio">
                <label><input name="pPA" type="radio" value="0" @if (isset($atividade)) {{ (0 == $atividade->pPA) ? 'checked' : '' }} @else {{ 'checked' }} @endif> {{__('No')}}</label>
            </div>
            {!! $errors->first('pPA', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-10">
        <div class="form-group {{ $errors->has('numeroPPA') ? 'has-error' : ''}}" id="divNumeroPPA" style="display:none">
            <label for="numeroPPA" class="form-label">{{ 'Número da PPA' }}</label>
            <input class="form-control" name="numeroPPA" type="number" id="numeroPPA" value="{{ isset($atividade->numeroPPA) ? $atividade->numeroPPA : ''}}" required>
            {!! $errors->first('numeroPPA', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>
<div class="form-group {{ $errors->has('observacao') ? 'has-error' : ''}}">
    <label for="observacao" class="form-label">{{ 'Observação' }}</label>
    <textarea class="form-control" rows="5" name="observacao" type="textarea" id="observacao" >{{ isset($atividade->observacao) ? $atividade->observacao : ''}}</textarea>
    {!! $errors->first('observacao', '<p class="help-block">:message</p>') !!}
</div>
<input type="hidden" name="idAcao" value="{{$acao->id}}">
<div class="form-group mt-3">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? __('Update') : __('Create') }}">
</div>
