@extends('tecnico.contrato.main')

@section('breadcrumb')
    <li><a href="{{ route('contratos.index')}}">Contrato</a></li>
    <li class="active">{{ $contrato->id }}</li>
@stop

@section('module')
    <div class="box box-danger">
        <div class="box-header with-border">
            <div class="row">
                <div class="col-md-2 col-sm-6 col-xs-6 text-left">
                    <a href=" {{ route('contratos.index') }}" class="btn btn-default btn-sm btn-block">{{ trans('app.comeback') }}</a>
                </div>
                <div class="col-md-2 col-md-offset-8 col-sm-6 col-xs-6 text-right">
                    <a href=" {{ route('contratos.edit', ['contratos' => $contrato->id])}}" class="btn btn-primary btn-sm btn-block"> {{trans('app.edit')}}</a>
                </div>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="form-group col-md-2">
                    <label class="control-label">Código</label>
                    <div>{{ $contrato->id }}</div>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-3">
                    <label class="control-label">Número</label>
                    <div>{{ $contrato->contrato_numero }}</div>
            	</div>
            </div>

            <div class="row">
                <div class="form-group col-md-12">
                    <label class="control-label">Tercero</label>
                    <div>
                        <a href="{{ route('terceros.show', ['terceros' =>  $contrato->contrato_tercero ]) }}" title="Ver tercero">{{ $contrato->tercero_nit }}</a>
                        {{ $contrato->tercero_nombre }}
                    </div>
                </div>
            </div>

            <div class="row">
            	<div class="form-group col-md-3">
            		<label class="control-label">Fecha Inicio</label>
            		<div>{{ $contrato->contrato_fecha }}</div>
            	</div>

            	<div class="form-group col-md-3"   >
            		<label class="control-label">Fecha De Vencimiento</label>
            		<div>{{ $contrato->contrato_vencimiento }}</div>
            	</div>
            </div>

            <div class="row">
            	<div class="col-md-3">
            		<label class="control-label"> Condiciones </label>
            		<div>{{ $contrato->contrato_condiciones }}</div>
            	</div></br>

                <div class="form-group col-md-3">
                    <label class="checkbox-inline" for="contrato_activo">
                        <input type="checkbox" id="contrato_activo" name="contrato_activo" value="contrato_activo" disabled {{ $contrato->contrato_activo ? 'checked': '' }}> Activo
                    </label>
                </div>
            </div>
            <br/><br/>
            <div class="row">
            <div class="form-group col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                         <li class="active"><a href="#tab_danos" data-toggle="tab">Daños</a></li>            
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_danos">
                            <div class="box box-danger" id="wrapper-danos-contrato">
                                <div class="box-body">
                                    <!-- table table-bordered table-striped -->
                                    <div class="box-body table-responsive no-padding">
                                        <table id="browse-contratos-danos-list" class="table table-hover table-bordered" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th width="90px">Nombre</th>
                                                    <th width="5px">Tiempo</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- Render content dano --}}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>      
        </div>
    </div>

@stop