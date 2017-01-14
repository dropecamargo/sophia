@extends('admin.estado.main')

@section('breadcrumb')
    <li><a href="{{ route('estados.index')}}">Editar</a></li>
    <li><a href="{{ route('estados.show', ['estado' => $estado->id]) }}">{{ $estado->id }}</a></li>
	<li class="active">Editar</li>
@stop

@section('module')
	<div class="box box-danger" id="estado-create">
		{!! Form::open(['id' => 'form-estado', 'data-toggle' => 'validator']) !!}
			<div class="box-body" id="render-form-estado">
				{{-- Render form estado --}}
			</div>

			<div class="box-footer clearfix">
                <div class="row">
                    <div class="col-md-2 col-sm-6 col-xs-6 text-left">
						<a href="{{ route('estados.index') }}" class="btn btn-default btn-sm btn-block">{{ trans('app.cancel') }}</a>
                    </div>
                    <div class="col-md-2 col-md-offset-8 col-sm-6 col-xs-6 text-right">
						<button type="submit" class="btn btn-primary btn-sm btn-block">{{ trans('app.edit') }}</button>
                    </div>
                </div>
            </div>
		{!! Form::close() !!}
	</div>
@stop