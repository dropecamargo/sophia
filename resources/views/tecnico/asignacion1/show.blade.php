@extends('tecnico.asignacion1.main')

@section('breadcrumb')
    <li><a href="{{ route('asignacion1s.index')}}">Asignacion</a></li>
    <li class="active">{{ $asignacion1->id }}</li>
@stop

@section('module')
	<div class="box box-danger">
        <div class="box-header with-border">
            <div class="row">
                <div class="col-md-2 col-sm-6 col-xs-6 text-left">
                    <a href=" {{ route('asignacion1s.index') }}" class="btn btn-default btn-sm btn-block">{{ trans('app.comeback') }}</a>
                </div>
                <div class="col-md-2 col-md-offset-8 col-sm-6 col-xs-6 text-right">
                    <a href=" {{ route('asignacion1s.edit', ['asignacion1s' => $asignacion1->id])}}" class="btn btn-primary btn-sm btn-block"> {{trans('app.edit')}}</a>
                </div>
            </div>
        </div>
        <div class="box-body">
        	<div class="row">
        		<div class="form-group col-md-2">
                    <label class="control-label">Código</label>
                    <div>{{ $asignacion1->id }}</div>
                </div>	
                <div class="form-group col-md-3">
                    <label class="control-label">Fecha</label>
                    <div>{{ $asignacion1->asignacion1_fecha }}</div>
                </div>
        	</div>
        	<div class="row">
        		<div class="form-group col-md-4">
                    <label class="control-label">Cliente</label>
                    <div>
                    Documento: <a href="{{ route('terceros.show', ['terceros' =>  $asignacion1->asignacion1_tercero ]) }}" title="Ver tercero">{{$asignacion1->tercero_nit}}</a><br>
                        Nombre: {{ $asignacion1->tercero_nombre }}</div>
                </div>
                <div class="form-group col-md-3">
                    <label class="control-label">Contacto</label>
                    <div>Nombre: {{ $asignacion1->contacto_nombre }} <br>
                    Telefono: {{ $asignacion1->tcontacto_telefono }}</div>
                </div>
        	</div>
        	<div class="row">
        		<div class="form-group col-md-3">
                    <label class="control-label">Tipo</label>
                    <div>{{ $asignacion1->asignacion1_tipo }}</div>
                </div>
                <div class="form-group col-md-3">
                    <label class="control-label">Municipio</label>
                    <div>{{ $asignacion1->municipio_nombre }}</div>
                </div>
        	</div>
        	<div class="row">
        		<div class="form-group col-md-3">
                    <label class="control-label">Area</label>
                    <div>{{ $asignacion1->asignacion1_area }}</div>
                </div>
                <div class="form-group col-md-3">
                    <label class="control-label">Centro Costo</label>
                    <div>{{ $asignacion1->asignacion1_centrocosto }}</div>
                </div>
        	</div>
        	<div class="row">
        		<div class="form-group col-md-4">
                    <label class="control-label">Direccion</label>
                    <div>{{ $asignacion1->asignacion1_direccion }}</div>
                </div>
                <div class="form-group col-md-2">
                    <label class="control-label">Zona</label>
                    <div>{{ $asignacion1->zona_nombre }}</div>
                </div>
        	</div>
        	<div class="row">
        		<div class="form-group col-md-4">
                    <label class="control-label">Tecnico</label>
                    <div>Documento: {{ $asignacion1->tecnico_nit }}<br>
                    Nombre: {{ $asignacion1->tecnico_nombre }}</div>
                </div>
        	</div>
        </div>
    </div>
@stop