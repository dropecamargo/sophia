@extends('inventario.contador.main')

@section('breadcrumb')
    <li><a href="{{ route('contadores.index')}}">Contadores</a></li>
    <li class="active">{{ $contador->id }}</li>
@stop

@section('module')
    <div class="box box-danger">
        
        <div class="box-body">
            <div class="row">
                <div class="form-group col-md-2">
                    <label class="control-label">Código</label>
                    <div>{{ $contador->id }}</div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-8">
                    <label class="control-label">Nombre</label>
                    <div>{{ $contador->contador_nombre }}</div>
            	</div>
                <div class="form-group col-md-2 col-xs-8 col-sm-3">
                    <label class="checkbox-inline" for="contador_activo">
                        <input type="checkbox" id="contador_activo" name="contador_activo" value="contador_activo" disabled {{ $contador->contador_activo ? 'checked': '' }}> Activo
                    </label>
                </div>
            </div>
        </div>

        <div class="box-footer with-border">
            <div class="row">
                <div class="col-md-2 col-md-offset-4 col-sm-6 col-xs-6 text-left">
                    <a href=" {{ route('contadores.index') }}" class="btn btn-default btn-sm btn-block">{{ trans('app.comeback') }}</a>
                </div>
                <div class="col-md-2 col-sm-6 col-xs-6 text-right">
                    <a href=" {{ route('contadores.edit', ['contadores' => $contador->id])}}" class="btn btn-primary btn-sm btn-block"> {{trans('app.edit')}}</a>
                </div>
            </div>
        </div>
    </div>
@stop