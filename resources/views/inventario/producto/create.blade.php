@extends('inventario.producto.main')

@section('breadcrumb')
    <li><a href="{{ route('productos.index')}}">Productos</a></li>
	<li class="active">Nuevo</li>
@stop

@section('module')
	<div class="box box-danger" id="producto-create">
		<div  id="render-form-producto">
			{{-- Render form producto --}}
		</div>
	</div>
@stop