@extends('tecnico.orden.main')
@section('breadcrumb')
   {{--<li><a href="{{ route('ordenes.index')}}">Orden</a></li>
    <li><a href="{{ route('ordenes.show', ['ordenes' => $orden->id]) }}">{{ $orden->id}}</a></li>--}}

	<li class="active">Editando</li>
@stop

@section('module')
<div class="box box-danger" id="ordenes-create">
	<div class="box-body" id="render-form-orden">
		{{-- Render form ordenes --}}
	</div>
</div>
@stop