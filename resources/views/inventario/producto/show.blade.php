@extends('inventario.producto.main')

@section('breadcrumb')
    <li><a href="{{ route('productos.index')}}">Productos</a></li>
    <li class="active">{{ $producto->id }}</li>
@stop

@section('module')
    <div class="box box-danger">
        <div class="box-header with-border">
            <div class="row">
                <div class="col-md-2 col-sm-6 col-xs-6 text-left">
                    <a href=" {{ route('productos.index') }}" class="btn btn-default btn-sm btn-block">{{ trans('app.comeback') }}</a>
                </div>
                <div class="col-md-2 col-md-offset-8 col-sm-6 col-xs-6 text-right">
                    <a href=" {{ route('productos.edit', ['productos' => $producto->id])}}" class="btn btn-primary btn-sm btn-block"> {{trans('app.edit')}}</a>
                </div>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="form-group col-md-2">
                    <label class="control-label">Id</label>
                    <div>{{ $producto->id }}</div>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-2">
                    <label class="control-label">Placa</label>
                    <div>{{ $producto->producto_placa }}</div>
                </div>
                <div class="form-group col-md-2">
                    <label class="control-label">Serie</label>
                    <div>{{ $producto->producto_serie }}</div>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-2">
                    <label class="control-label">Referencia</label>
                    <div>{{ $producto->producto_referencia }}</div>
                </div>
                <div class="form-group col-md-2">
                    <label class="control-label">Codigo</label>
                    <div>{{ $producto->producto_codigo }}</div>
                </div>
                <div class="form-group col-md-2">
                    <label class="control-label">Nombre del producto</label>
                    <div>{{ $producto->producto_nombre }}</div>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-2">
                    <label class="control-label">Parte</label>
                    <div>{{ $producto->producto_parte }}</div>
                </div>
                <div class="form-group col-md-2">
                    <label class="control-label">Vida Util</label>
                    <div>{{ $producto->producto_vida_util }}</div>
                </div>
            </div>            

            <div class="row">
                <div class="form-group col-md-2">
                    <label class="control-label">Costo Promedio</label>
                    <div>{{ $producto->producto_costo_promedio }}</div>
                </div>
                <div class="form-group col-md-2">
                    <label class="control-label">Ultimo Costo</label>
                    <div>{{ $producto->producto_ultimo_costo }}</div>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-2">
                    <label class="control-label">Marca</label>
                    <div>{{ $producto->marca_modelo }}</div>
                </div>
                <div class="form-group col-md-2">
                    <label class="control-label">Modelo</label>
                    <div>{{ $producto->modelo_nombre }}</div>
                </div>
                <div class="form-group col-md-2">
                    <label class="control-label">Estado</label>
                    <div>{{ $producto->estado_nombre }}</div>
                </div>
                <div class="form-group col-md-2">
                    <label class="control-label">Tipo</label>
                    <div>{{ $producto->tipo_nombre }}</div>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label class="control-label">Proveedor</label>
                    <div>{{ $producto->tercero_nombre }}</div>
                </div>
            </div>
        </div>
    </div>
@stop