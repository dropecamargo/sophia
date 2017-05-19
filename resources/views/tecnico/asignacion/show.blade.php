@extends('tecnico.asignacion.main')

@section('breadcrumb')
    <li><a href="{{ route('asignaciones.index')}}">Asignacion</a></li>
    <li class="active">{{ $asignacion1->id }}</li>
@stop

@section('module')
	<div class="box box-danger" id="asignacion-show">
        <div class="box-body">
            @if( $asignacion1->asignacion1_tipo == 'E')
                <div class="row">
                    <div class="form-group col-md-3">
                        <label class="control-label">Tipo</label>
                        <div>{{ $asignacion1->asignacion1_tipo == 'E' ? 'Envio' : '' }}</div>
                    </div>
                </div>
            	<div class="row">
            		<div class="form-group col-md-2">
                        <label class="control-label">Id</label>
                        <div>{{ $asignacion1->id }}</div>
                    </div>	
                    <div class="form-group col-md-offset-2 col-md-3">
                        <label class="control-label">Fecha</label>
                        <div>{{ $asignacion1->asignacion1_fecha }}</div>
                    </div>
            	</div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label class="control-label">Cliente</label>
                        <div>
                        Documento: <a href="{{ route('terceros.show', ['terceros' =>  $asignacion1->asignacion1_tercero ]) }}" title="Ver tercero">{{$asignacion1->tercero_nit}}</a><br>
                            Nombre: {{ $asignacion1->tercero_nombre }}</div>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="control-label">Contacto</label>
                        <div>Nombre: {{ $asignacion1->contacto_nombre }} <br>
                        Telefono: {{ $asignacion1->tcontacto_telefono }}</div>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label">Contrato</label>
                        <div>{{ $asignacion1->contrato_numero }}</div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-3">
                        <label class="control-label">Municipio</label>
                        <div>{{ $asignacion1->municipio_nombre }}</div>
                    </div>
                    <div class="form-group col-md-3 col-md-offset-1">
                        <label class="control-label">Area</label>
                        <div>{{ $asignacion1->asignacion1_area }}</div>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="control-label">Centro Costo</label>
                        <div>{{ $asignacion1->asignacion1_centrocosto }}</div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label class="control-label">Tecnico</label>
                        <div>
                        Documento: <a href="{{ route('terceros.show', ['terceros' =>  $asignacion1->asignacion1_tecnico ]) }}" title="Ver tercero">{{ $asignacion1->tecnico_nit }}</a><br>
                        Nombre: {{ $asignacion1->tecnico_nombre }}</div>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label">Direccion</label> <small>{{ $asignacion1->asignacion1_direccion_nomenclatura }}</small>
                        <div>{{ $asignacion1->asignacion1_direccion }}</div>
                    </div>
                </div>
            @endif

            @if( $asignacion1->asignacion1_tipo == 'R')
                <div class="row">
                    <div class="form-group col-md-3">
                        <label class="control-label">Tipo</label>
                        <div>{{ $asignacion1->asignacion1_tipo == 'R' ? 'Retiro' : '' }}</div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-3">
                        <label class="control-label">Id</label>
                        <div>{{ $asignacion1->id }}</div>
                    </div>  
                    <div class="form-group col-md-3 col-md-offset-1">
                        <label class="control-label">Fecha</label>
                        <div>{{ $asignacion1->asignacion1_fecha }}</div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label class="control-label">Cliente</label>
                        <div>
                        Documento: <a href="{{ route('terceros.show', ['terceros' =>  $asignacion1->asignacion1_tercero ]) }}" title="Ver tercero">{{$asignacion1->tercero_nit}}</a><br>
                            Nombre: {{ $asignacion1->tercero_nombre }}</div>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="control-label">Contacto</label>
                        <div>Nombre: {{ $asignacion1->contacto_nombre }} <br>
                        Telefono: {{ $asignacion1->tcontacto_telefono }}</div>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="control-label">Contrato</label>
                        <div>{{ $asignacion1->contrato_numero }}</div>
                    </div>
                </div>
            @endif
        </div>
        <div class="box-body table-responsive">
            <table id="browse-asignacion2-list" class="table table-hover table-bordered" cellspacing="0" width="100%">
                <tr>
                    <th>Producto</th>
                    <th>Tipo</th>
                    <th>De</th>
                </tr>
            </table>
        </div>
        <div class="box-footer with-border">
            <div class="row">
                <div class="col-md-2 col-md-offset-5 col-sm-6 col-xs-6 text-left">
                    <a href=" {{ route('asignaciones.index') }}" class="btn btn-default btn-sm btn-block">{{ trans('app.comeback') }}</a>
                </div>
            </div>
        </div>
    </div>
@stop