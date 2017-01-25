@extends('inventario.producto.main')

@section('breadcrumb')
    <li><a href="{{ route('productos.index')}}">Editar</a></li>
    <li><a href="{{ route('productos.show', ['producto' => $producto->id]) }}">{{ $producto->id }}</a></li>
	<li class="active">Editar</li>
@stop

@section('module')
	<div class="box box-danger" id="producto-create">
		<div class="box-header with-border">
	        <div class="row">
	            <div class="col-md-2 col-sm-6 col-xs-6 text-left">
	                <a href="{{ route('productos.show', ['producto' => $producto->id]) }}" class="btn btn-default btn-sm btn-block">{{ trans('app.cancel') }}</a>
	            </div>
	            <div class="col-md-2 col-md-offset-8 col-sm-6 col-xs-6 text-right">
	                <button type="button" class="btn btn-primary btn-sm btn-block submit-producto">{{ trans('app.save') }}</button>
	            </div>
	        </div>
	    </div>
		<div id="render-form-producto">
			{{-- Render form producto --}}
		</div>
	</div>
@stop