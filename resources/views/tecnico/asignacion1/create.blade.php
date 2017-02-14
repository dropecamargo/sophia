@extends('tecnico.asignacion1.main')

@section('breadcrumb')
    <li><a href="{{ route('asignaciones.index')}}">Asignacion</a></li>
	<li class="active">Nuevo</li>
@stop

@section('module')
	<div class="box box-danger" id="asignacion1-create">
		<div id="render-form-asignacion1">
			{{-- Render form asignacion1 --}}
		</div>
	</div>
@stop