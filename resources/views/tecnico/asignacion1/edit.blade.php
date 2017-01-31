@extends('tecnico.asignacion1.main')

@section('breadcrumb')
    <li><a href="{{ route('asignacion1s.index')}}">Editar</a></li>
    <li><a href="{{ route('asignacion1s.show', ['asignacion1' => $asignacion1->id]) }}">{{ $asignacion1->id }}</a></li>
	<li class="active">Editar</li>
@stop

@section('module')
	<div class="box box-danger" id="asignacion1-create">
		{!! Form::open(['id' => 'form-asignacion1', 'data-toggle' => 'validator']) !!}
			<div class="box-body" id="render-form-asignacion1">
				{{-- Render form asignacion1 --}}
			</div>

			<div class="box-footer clearfix">
                <div class="row">
                    <div class="col-md-2 col-sm-6 col-xs-6 text-left">
						<a href="{{ route('asignacion1s.index') }}" class="btn btn-default btn-sm btn-block">{{ trans('app.cancel') }}</a>
                    </div>
                    <div class="col-md-2 col-md-offset-8 col-sm-6 col-xs-6 text-right">
						<button type="submit" class="btn btn-primary btn-sm btn-block">{{ trans('app.edit') }}</button>
                    </div>
                </div>
            </div>
		{!! Form::close() !!}
	</div>
@stop