@extends('tecnico.marca.main')

@section('breadcrumb')
    <li class="active">Marcas</li>
@stop

@section('module')
	<div id="marcas-main">
        <div class="box box-success">
            <div class="box-body table-responsive">
                <table id="marcas-search-table" class="table table-bordered table-striped" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@stop