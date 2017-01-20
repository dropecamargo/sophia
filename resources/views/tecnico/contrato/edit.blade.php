@extends('tecnico.contrato.main')

@section('breadcrumb')
    <li><a href="{{ route('contratos.index')}}">Contrato</a></li>
    <li><a href="{{ route('contratos.show', ['contratos' => $contrato->id]) }}">{{ $contrato->contrato_numero }}</a></li>

	<li class="active">Editando</li>
@stop

@section('module')
<div class="box box-danger" id="contratos-create">
	<div class="box-body" id="render-form-contrato">
		{{-- Render form contratos --}}
	</div>
</div>
@stop


		
			

	
	