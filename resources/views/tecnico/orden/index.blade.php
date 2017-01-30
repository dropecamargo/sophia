@extends('tecnico.orden.main')

@section('breadcrumb')
    <li class="active">Ordenes</li>
@stop

@section('module')
	<div id="orden-main">
        <div class="box box-danger">
            <div class="box-body table-responsive">

            {!! Form::open(['id' => 'form-koi-search-tercero-component', 'class' => 'form-horizontal', 'data-toggle' => 'validator', 'role' => 'form']) !!}
                    <div class="form-group">
                        <label for="searchordenp_ordenp_numero" class="col-md-1 control-label">Código</label>
                        <div class="col-md-2">
                            <input id="searchordenp_ordenp_numero" placeholder="Código" class="form-control input-sm" name="searchordenp_ordenp_numero" type="text" maxlength="15" value="{{ session('searchordenp_ordenp_numero') }}">
                        </div>

                        <label for="searchordenp_ordenp_estado" class="col-md-1 control-label">Estado</label>
                        <div class="col-md-2">
                            <select name="searchordenp_ordenp_estado" id="searchordenp_ordenp_estado" class="form-control">
                                <option value="" selected>Todas</option>
                                <option value="A" {{ session('searchordenp_ordenp_estado') == 'A' ? 'selected': '' }}>Abiertas</option>
                                <!--option value="N" {{ session('searchordenp_ordenp_estado') == 'N' ? 'selected': '' }}>Anuladas</option-->
                                <option value="C" {{ session('searchordenp_ordenp_estado') == 'C' ? 'selected': '' }}>Cerradas</option>
                            </select>
                        </div>

                        <label for="searchordenp_tercero" class="col-sm-1 control-label">Tercero</label>
                        <div class="form-group col-sm-2">
                            <div class="input-group input-group-sm">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-default btn-flat btn-koi-search-tercero-component-table" data-field="searchordenp_tercero">
                                        <i class="fa fa-user"></i>
                                    </button>
                                </span>
                                <input id="searchordenp_tercero" placeholder="Tercero" class="form-control tercero-koi-component input-sm" name="searchordenp_tercero" type="text" maxlength="15" data-wrapper="modal-asiento-wrapper-ordenp" data-name="searchordenp_tercero_nombre" value="{{ session('searchordenp_tercero') }}">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <input id="searchordenp_tercero_nombre" name="searchordenp_tercero_nombre" placeholder="Tercero beneficiario" class="form-control input-sm" type="text" maxlength="15" readonly value="{{ session('searchordenp_tercero_nombre') }}">
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
                            <a href="{{ route('ordenes.create') }}" class="btn btn-default btn-block btn-sm">
                                <i class="fa fa-building-o"></i> Nueva orden
                            </a>
                        </div>
                    </div>
                {!! Form::close() !!}
                
                <table id="orden-search-table" class="table table-bordered table-striped" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Fecha</th>
                            <th>Tercero</th>
                            <th>Abierta</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@stop