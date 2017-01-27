@extends('inventario.producto.main')

@section('breadcrumb')
    <li><a href="{{ route('productos.index')}}">Editar</a></li>
    <li><a href="{{ route('productos.show', ['producto' => $producto->id]) }}">{{ $producto->id }}</a></li>
	<li class="active">Editar</li>
@stop

@section('module')
	<div class="box box-danger" id="producto-create">
		<div id="render-form-producto">
			{{-- Render form producto --}}
		</div>
	</div>
@stop