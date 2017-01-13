@extends('admin.estado.main')

@section('breadcrumb')
    <li class="active">Estados</li>
@stop

@section('module')
	<div id="estados-main">
        <div class="box box-danger">
            <div class="box-body table-responsive">
                <table id="estados-search-table" class="table table-bordered table-striped" cellspacing="0" width="100%">
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