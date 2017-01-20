@extends('inventario.producto.main')

@section('breadcrumb')
    <li class="active">Productos</li>
@stop

@section('module')
	<div id="productos-main">
        <div class="box box-danger">
            <div class="box-body table-responsive">
                <table id="productos-search-table" class="table table-bordered table-striped" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Codigo</th>
                            <th>Nombre del producto</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@stop