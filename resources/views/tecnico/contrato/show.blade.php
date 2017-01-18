@extends('tecnico.contrato.main')

@section('breadcrumb')
    <li><a href="{{ route('contratos.index')}}">Contrato</a></li>
    <li class="active">{{ $contrato->id }}</li>
@stop

