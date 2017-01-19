@extends('tecnico.contrato.main')

@section('breadcrumb')
    <li><a href="{{ route('contratos.index')}}">Contrato</a></li>
    <li class="active">{{ $contrato->id }}</li>
@stop

@section('module')
    <div class="box box-danger">
        <div class="box-header with-border">
            <div class="row">
                <div class="col-md-2 col-sm-6 col-xs-6 text-left">
                    <a href=" {{ route('contratos.index') }}" class="btn btn-default btn-sm btn-block">{{ trans('app.comeback') }}</a>
                </div>
                <div class="col-md-2 col-md-offset-8 col-sm-6 col-xs-6 text-right">
                    <a href=" {{ route('contratos.edit', ['contratos' => $contrato->id])}}" class="btn btn-primary btn-sm btn-block"> {{trans('app.edit')}}</a>
                </div>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="form-group col-md-2">
                    <label class="control-label">Código</label>
                    <div>{{ $contrato->id }}</div>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-3">
                    <label class="control-label">Número De Contrato</label>
                    <div>{{ $contrato->contrato_numero }}</div>
            	</div>

                <div class="form-group col-md-3">
                    <label class="control-label">Contrato Tercero</label>
                    <div> {{ $contrato->contrato_tercero }}</div>
                </div>
            </div>

            <div class="row">
            	<div class="form-group col-md-3">
            		<label class="control-label">Fecha Inicio</label>
            		<div>{{ $contrato->contrato_fecha }}</div>
            	</div>

            	<div class="form-group col-md-3"   >
            		<label class="control-label">Fecha De Vencimiento</label>
            		<div>{{ $contrato->contrato_vencimiento }}</div>
            	</div>
            </div>

            <div class="row">
            	<div class="col-md-3">
            		<label class="control-label"> Condiciones </label>
            		<div>{{ $contrato->contrato_condiciones }}</div>
            	</div></br>

                <div class="form-group col-md-3">
                    <label class="checkbox-inline" for="contrato_activo">
                        <input type="checkbox" id="contrato_activo" name="contrato_activo" value="contrato_activo" disabled {{ $contrato->contrato_activo ? 'checked': '' }}> Activo
                    </label>
                </div>
            </div>
        </div>
    </div>
@stop