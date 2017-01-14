@extends('inventario.marca.main')

@section('breadcrumb')
    <li><a href="{{ route('marcas.index')}}">Editar</a></li>
    <li><a href="{{ route('marcas.show', ['marca' => $marca->id]) }}">{{ $marca->id }}</a></li>
	<li class="active">Editar</li>
@stop

@section('module')
	<div class="box box-danger" id="marca-create">
		{!! Form::open(['id' => 'form-marca', 'data-toggle' => 'validator']) !!}
			<div class="box-body" id="render-form-marca">
				{{-- Render form marca --}}
			</div>

			<div class="box-footer clearfix">
                <div class="row">
                    <div class="col-md-2 col-sm-6 col-xs-6 text-left">
						<a href="{{ route('marcas.index') }}" class="btn btn-default btn-sm btn-block">{{ trans('app.cancel') }}</a>
                    </div>
                    <div class="col-md-2 col-md-offset-8 col-sm-6 col-xs-6 text-right">
						<button type="submit" class="btn btn-primary btn-sm btn-block">{{ trans('app.edit') }}</button>
                    </div>
                </div>
            </div>
		{!! Form::close() !!}
	</div>
@stop