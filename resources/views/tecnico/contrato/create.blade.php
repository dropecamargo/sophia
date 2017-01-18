@extends('tecnico.contrato.main')

@section('breadcrumb')
    <li><a href="{{ route('contratos.index')}}">Ordenes</a></li>
	<li class="active">Nuevo</li>
@stop

@section('module')
	<div class="box box-whithout-border" id="contratos-create">
		<div id="render-form-orden">
			{{-- Render form orden --}}
		</div>
	</div>
@stop