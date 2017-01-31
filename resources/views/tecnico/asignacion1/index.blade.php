@extends('tecnico.asignacion1.main')

@section('breadcrumb')
    <li class="active">Asignacion #1</li>
@stop

@section('module')
	<div id="asignacion1s-main">
        <div class="box box-danger">
            <div class="box-body table-responsive">
                <table id="asignacion1s-search-table" class="table table-bordered table-striped" cellspacing="0" width="100%">
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