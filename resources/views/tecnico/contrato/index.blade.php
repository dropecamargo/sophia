@extends('tecnico.contrato.main')

@section('breadcrumb')
    <li class="active">Contratos</li>
@stop

@section('module')
	<div id="contrato-main">
        <div class="box box-danger">
            <div class="box-body table-responsive">

            {!! Form::open(['id' => 'form-koi-search-tercero-component', 'class' => 'form-horizontal', 'data-toggle' => 'validator', 'role' => 'form']) !!}
                    <div class="row col-md-offset-1">
                        <label for="searchcontrato_contrato_id" class="col-md-1 control-label">Código</label>
                        <div class="col-md-2">
                            <input id="searchcontrato_contrato_numero" placeholder="Código" class="form-control input-sm" name="searchcontrato_contrato_numero" type="text" maxlength="15" value="{{ session('searchcontrato_contrato_numero') }}">
                        </div>

                        <label for="searchcontrato_tercero" class="col-sm-1 control-label">Tercero</label>
                        <div class="form-group col-sm-3">
                            <div class="input-group input-group-sm">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-default btn-flat btn-koi-search-tercero-component-table" data-field="searchcontrato_tercero">
                                        <i class="fa fa-user"></i>
                                    </button>
                                </span>
                                <input id="searchcontrato_tercero" placeholder="Tercero" class="form-control tercero-koi-component input-sm" name="searchcontrato_tercero" type="text" maxlength="15" data-wrapper="modal-asiento-wrapper-contratop" data-name="searchcontrato_tercero_nombre" value="{{ session('searchcontrato_tercero') }}">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <input id="searchcontrato_tercero_nombre" name="searchcontrato_tercero_nombre" placeholder="Tercero beneficiario" class="form-control input-sm" type="text" maxlength="15" readonly value="{{ session('searchcontrato_tercero_nombre') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-2 col-xs-4">
                            <button type="button" class="btn btn-default btn-block btn-sm btn-clear">Limpiar</button>
                        </div>
                        <div class="col-md-2 col-xs-4">
                            <button type="button" class="btn btn-primary btn-block btn-sm btn-search">Buscar</button>
                        </div>
                        <div class="col-md-2 col-xs-4">
                            <a href="{{ route('contratos.create') }}" class="btn btn-default btn-block btn-sm">
                                <i class="fa fa-briefcase"></i> Nuevo Contrato
                            </a>
                        </div>
                    </div>
                {!! Form::close() !!}
                <table id="contrato-search-table" class="table table-bordered table-striped" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                         
                            <th>Número </th>
                            <th>Tercero</th>
                            <th>F. Inicio</th>
                            <th>F. Vencimiento</th>
                            <th>Activo</th>
                            
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@stop