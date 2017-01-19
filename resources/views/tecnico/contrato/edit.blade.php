@extends('tecnico.contrato.main')

@section('breadcrumb')
    <li><a href="{{ route('contratos.index')}}">Contrato</a></li>
    <li><a href="{{ route('contratos.show', ['contratos' => $contrato->id]) }}">{{ $contrato->contrato_numero }}</a></li>

	<li class="active">Editando</li>
@stop

@section('module')
	<div class="box box-whithout-border" id="contratos-create">
		<div id="render-form-contrato">
			{{-- Render form Contrato --}}
		</div>
	</div>
@stop