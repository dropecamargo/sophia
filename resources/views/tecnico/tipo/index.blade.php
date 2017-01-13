@extends('tecnico.tipo.main')

@section('breadcrumb')
    <li class="active">Marcas</li>
@stop

@section('module')
	<div id="tipos-main">
        <div class="box box-success">
            <div class="box-body table-responsive">
                <table id="tipos-search-table" class="table table-bordered table-striped" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Tipo</th>
                            <th>Nombre</th>
                            <th>Activo</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@stop