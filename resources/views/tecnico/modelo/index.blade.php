@extends('tecnico.modelo.main')

@section('breadcrumb')
    <li class="active">Modelos</li>
@stop

@section('module')
    <div id="areasp-main">
        <div class="box box-success">
            <div class="box-body table-responsive">
                <table id="areasp-search-table" class="table table-bordered table-striped" cellspacing="0" width="100%">
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