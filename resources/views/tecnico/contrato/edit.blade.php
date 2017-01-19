@extends('tecnico.contrato.main')

@section('breadcrumb')
    <li><a href="{{ route('contratos.index')}}">Contrato</a></li>
    <li><a href="{{ route('contratos.show', ['contratos' => $contrato->id]) }}">{{ $contrato->contrato_numero }}</a></li>

	<li class="active">Editando</li>
@stop

@section('module')
	<div class="box box-danger" id="contratos-create">
			{!! Form::open(['id' => 'form-contrato', 'data-toggle' => 'validator']) !!}
	<div class="box-body" id="render-form-contrato">
				{{-- Render form contratos --}}
			</div>
		<div class="box-footer clearfix">
                <div class="row">
                    <div class="col-md-2 col-sm-6 col-xs-6 text-left">
						<a href="{{ route('marcas.index') }}" class="btn btn-default btn-sm btn-block">{{ trans('app.cancel') }}</a>
                    </div>
                    <div class="col-md-2 col-md-offset-8 col-sm-6 col-xs-6 text-right">
						<button type="submit" class="btn btn-primary btn-sm btn-block">{{ trans('app.save') }}</button>
                    </div>
                </div>
            </div>
		{!! Form::close() !!}
			
	</div>
@stop


		
			

	
	