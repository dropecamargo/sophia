@extends('inventario.tipo.main')

@section('breadcrumb')
    <li><a href="{{ route('tipos.index')}}">Tipos</a></li>
    <li class="active">{{ $tipo->id }}</li>
@stop

@section('module')
    <div class="box box-danger">
        <div class="box-body">
            <div class="row">
                <div class="form-group col-md-2 col-xs-6 col-sm-6">
                    <label class="control-label">Código</label>
                    <div>{{ $tipo->id }}</div>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-2 col-xs-6 col-sm-6">
                    <label class="control-label">Tipo</label>
                    <div>{{ $tipo->tipo_codigo }}</div>
                </div>
                <div class="form-group col-md-3 col-xs-6 col-sm-6">
                    <label class="control-label">Nombre</label>
                    <div>{{ $tipo->tipo_nombre }}</div>
                </div>
                <div class="form-group col-md-2 col-xs-6 col-sm-6"><br>
                    <label class="checkbox-inline" for="tipo_activo">
                        <input type="checkbox" id="tipo_activo" name="tipo_activo" value="tipo_activo" disabled {{ $tipo->tipo_activo ? 'checked': '' }}> Activo
                    </label>
                </div>
            </div>
        </div>
        <div class="box-footer with-border">
            <div class="row">
                <div class="col-md-2 col-md-offset-4 col-sm-6 col-xs-6 text-left">
                    <a href=" {{ route('tipos.index') }}" class="btn btn-default btn-sm btn-block">{{ trans('app.comeback') }}</a>
                </div>
                <div class="col-md-2 col-sm-6 col-xs-6 text-right">
                    <a href=" {{ route('tipos.edit', ['tipos' => $tipo->id])}}" class="btn btn-primary btn-sm btn-block"> {{trans('app.edit')}}</a>
                </div>
            </div>
        </div>
    </div>
@stop