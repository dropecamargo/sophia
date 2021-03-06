@extends('tecnico.zona.main')

@section('breadcrumb')
    <li><a href="{{ route('zonas.index')}}">Editar</a></li>
    <li><a href="{{ route('zonas.show', ['zona' => $zona->id]) }}">{{ $zona->id }}</a></li>
	<li class="active">Editar</li>
@stop

@section('module')
	<div class="box box-danger" id="zona-create">
		{!! Form::open(['id' => 'form-zona', 'data-toggle' => 'validator']) !!}
			<div class="box-body" id="render-form-zona">
				{{-- Render form zona --}}	
			</div>

			<div class="box-footer ">
                <div class="row">
                    <div class="col-md-2 col-md-offset-4 col-sm-6 col-xs-6 text-left">
						<a href="{{ route('zonas.index') }}" class="btn btn-default btn-sm btn-block">{{ trans('app.cancel') }}</a>
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-6 text-right">
						<button type="submit" class="btn btn-primary btn-sm btn-block">{{ trans('app.save') }}</button>
                    </div>
                </div>
            </div>
		{!! Form::close() !!}
	</div>
@stop