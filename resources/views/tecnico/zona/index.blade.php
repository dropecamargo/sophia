@extends('tecnico.zona.main')

@section('breadcrumb')
    <li class="active">Zonas</li>
@stop

@section('module')
	<div id="zonas-main">
        <div class="box box-danger">
            <div class="box-body table-responsive">
                <table id="zonas-search-table" class="table table-bordered table-striped" cellspacing="0" width="100%">
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