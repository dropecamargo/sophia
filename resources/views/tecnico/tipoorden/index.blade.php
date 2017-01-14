@extends('tecnico.tipoorden.main')

@section('breadcrumb')
    <li class="active">Tipos de Orden</li>
@stop

@section('module')
	<div id="tiposorden-main">
        <div class="box box-danger">
            <div class="box-body table-responsive">
                <table id="tiposorden-search-table" class="table table-bordered table-striped" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Activo</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@stop