@extends('tecnico.asignacion1.main')

@section('breadcrumb')
    <li><a href="{{ route('asignacion1s.index')}}">Editar</a></li>
    <li><a href="{{ route('asignacion1s.show', ['asignacion1' => $asignacion1->id]) }}">{{ $asignacion1->id }}</a></li>
	<li class="active">Editar</li>
@stop

@section('module')
	<div class="box box-danger" id="asignacion1-create">
		<div id="render-form-asignacion1">
			{{-- Render form asignacion1 --}}
		</div>
	</div>
@stop