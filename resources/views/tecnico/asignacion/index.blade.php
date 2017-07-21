@extends('tecnico.asignacion.main')

@section('breadcrumb')
    <li class="active">Envío Equipo</li>
@stop

@section('module')
	<div id="asignacion1s-main">
        <div class="box box-danger">
            <div class="box-body">
                {!! Form::open(['id' => 'form-koi-search-tercero-component', 'class' => 'form-horizontal', 'data-toggle' => 'validator', 'role' => 'form']) !!}
                <div class="row">
                    <label for="searchasignacion1_tercero" class="col-sm-1 control-label">Cliente</label>
                    <div class="col-md-2">
                        <div class="input-group input-group-sm">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-default btn-flat btn-koi-search-tercero-component-table" data-field="searchasignacion1_tercero">
                                    <i class="fa fa-user"></i>
                                </button>
                            </span>
                            <input id="searchasignacion1_tercero" placeholder="Documento Cliente" class="form-control tercero-koi-component input-sm" name="searchasignacion1_tercero" type="text" maxlength="15" data-wrapper="modal-asiento-wrapper-ordenp" data-type="cliente" data-name="searchasignacion1_tercero_nombre" value="{{ session('searchasignacion1_tercero') }}">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <input id="searchasignacion1_tercero_nombre" name="searchasignacion1_tercero_nombre" placeholder="Cliente beneficiario" class="form-control input-sm" type="text" maxlength="15" readonly value="{{ session('searchasignacion1_tercero_nombre') }}">
                    </div>

                    <label for="searchasignacion1_tecnico" class="col-sm-1 control-label">Tecnico</label>
                    <div class="col-sm-2">
                        <div class="input-group input-group-sm">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-default btn-flat btn-koi-search-tercero-component-table" data-field="searchasignacion1_tecnico">
                                    <i class="fa fa-user"></i>
                                </button>
                            </span>
                            <input id="searchasignacion1_tecnico" placeholder="Documento Tecnico" class="form-control tercero-koi-component input-sm" name="searchasignacion1_tecnico" type="text" maxlength="15" data-wrapper="modal-asiento-wrapper-ordenp" data-type="tecnico" data-name="searchasignacion1_tecnico_nombre" value="{{ session('searchasignacion1_tecnico') }}">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <input id="searchasignacion1_tecnico_nombre" name="searchasignacion1_tecnico_nombre" placeholder="Nombre Tecnico" class="form-control input-sm" type="text" maxlength="15" readonly value="{{ session('searchasignacion1_tecnico_nombre') }}">
                    </div>
                </div><br>

                <div class="row">
                    <label for="searchasignacion1_tipo" class="col-md-1 col-md-offset-4 control-label">Tipo</label>
                    <div class="col-md-2">
                        <select name="searchasignacion1_tipo" id="searchasignacion1_tipo" class="form-control">
                            <option value="" selected>Todas</option>
                            <option value="E" {{ session('searchasignacion1_tipo') == 'E' ? 'selected': '' }}>Envio</option>
                            <option value="R" {{ session('searchasignacion1_tipo') == 'R' ? 'selected': '' }}>Retiro</option>
                        </select>
                    </div>
                </div>

                <br>

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-2 col-sm-3 col-xs-6">
                        <button type="button" class="btn btn-default btn-block btn-sm btn-clear">Limpiar</button>
                    </div>
                    <div class="col-md-2 col-sm-3 col-xs-6">
                        <button type="button" class="btn btn-primary btn-block btn-sm btn-search">Buscar</button>
                    </div>
                    <div class="col-md-2 col-sm-3 col-xs-6">
                        <a href="{{ route('asignaciones.create', ['tipo' => 'E']) }}" class="btn btn-default btn-block btn-sm">
                            <i class="fa fa-forward"></i> Nuevo Envío
                        </a>
                    </div>
                    <div class="col-md-2 col-sm-3 col-xs-6">
                        <a href="{{ route('asignaciones.create', ['tipo' => 'R']) }}" class="btn btn-default btn-block btn-sm">
                            <i class="fa fa-backward"></i> Nuevo Retiro
                        </a>
                    </div>
                </div>
                {!! Form::close() !!}

                <div class="box-body table-responsive">
                    <table id="asignacion1s-search-table" class="table table-bordered table-striped" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Cliente</th>
                                <th>Tecnico</th>
                                <th>Tipo</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop