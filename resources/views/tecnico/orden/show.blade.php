@extends('tecnico.orden.main')

@section('breadcrumb')
    <li class="active">Ordenes</li>
@stop

@section('module')
<div class="box box-danger">
        <div class="box-header with-border">
            <div class="row">
                <div class="col-md-2 col-sm-6 col-xs-6 text-left">
                    <a href=" {{ route('ordenes.index') }}" class="btn btn-default btn-sm btn-block">{{ trans('app.comeback') }}</a>
                </div>
                <div class="col-md-2 col-md-offset-8 col-sm-6 col-xs-6 text-right">
                    <a href=" {{ route('ordenes.edit', ['ordenes' => $orden->id])}}" class="btn btn-primary btn-sm btn-block"> {{trans('app.edit')}}</a>
                </div>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="form-group col-md-2">
                    <label class="control-label">Código</label>
                    <div>{{ $orden->id }}</div>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-12">
                    <label class="control-label">Tercero</label>
                    <div>
                        Documento: <a href="{{ route('terceros.show', ['terceros' =>  $orden->orden_tercero ]) }}" title="Ver tercero">{{$orden->tercero_nit}}</a>
                        <br>
                        Nombre: {{ $orden->tercero_nombre }}
                    </div>
                </div>
            </div>

            <div class="row">
            	<div class="form-group col-md-3">
            		<label class="control-label">Fecha</label>
            		<div>{{ $orden->orden_fecha }}</div>
            	</div>

            	<div class="form-group col-md-3">
            		<label class="control-label">Daño</label>
            		<div>{{ $orden->dano_nombre }}</div>
            	</div>
            </div>

            <div class="row">
            	<div class="form-group col-md-3">
            		<label class="control-label">Tipo</label>
            		<div>{{ $orden->tipoorden_nombre }}</div>
            	</div>

            	<div class="form-group col-md-3">
            		<label class="control-label">Prioridad</label>
            		<div>{{ $orden->prioridad_nombre }}</div>
            	</div>
            </div>

            <div class="row">
            	<div class="form-group col-md-3">
            		<label class="control-label">Solicitante</label>
            		<div>{{ $orden->solicitante_nombre }}</div>
            	</div>
            </div>

            <div class="row">
            	<div class="col-md-3">
            		<label class="control-label"> Problema </label>
            		<div>{{ $orden->orden_problema }}</div>
            	</div></br>

                <div class="form-group col-md-3">
                    <label class="checkbox-inline" for="orden_abierta">
                        <input type="checkbox" id="orden_abierta" name="orden_abierta" value="orden_abierta" disabled {{ $orden->orden_abierta ? 'checked': '' }}> Activo
                    </label>
                </div>
            </div>     
        </div>
    </div>
@stop