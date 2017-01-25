@extends('tecnico.contrato.main')

@section('breadcrumb')
    <li><a href="{{ route('contratos.index')}}">Contrato</a></li>
	<li class="active">Nuevo</li>
@stop

@section('module')
	<div class="box box-danger" id="contratos-create">
		<div class="box-body" id="render-form-contrato">
			{{-- Render form contratos --}}
		</div>	
	</div>
@stop