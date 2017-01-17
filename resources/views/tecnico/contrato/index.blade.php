@extends('tecnico.contrato.main')

@section('breadcrumb')
    <li class="active">Contratos</li>
@stop

@section('module')
	<div id="contrato-main">
        <div class="box box-danger">
            <div class="box-body table-responsive">
                <table id="contrato-search-table" class="table table-bordered table-striped" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Número de contrato</th>
                            <th>Activo</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@stop