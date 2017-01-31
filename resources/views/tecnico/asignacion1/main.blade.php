@extends('layout.layout')

@section('title') Asignacion @stop

@section('content')
    <section class="content-header">
        <h1>
            Asignaciones <small>Administración de Asignaciones</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> {{trans('app.home')}}</a></li>
            @yield('breadcrumb')
        </ol>
    </section>

    <section class="content">
        @yield ('module')
    </section>

    <script type="text/template" id="add-asignacion1-tpl">
        <div class="box-header with-border">
                <form method="POST" accept-charset="UTF-8" id="form-asignacion1" data-toggle="validator">
                    <div class="row">
                        <label for="orden_tercero" class="col-sm-1 control-label">Cliente</label>
                        <div class="form-group col-sm-3">
                            <div class="input-group input-group-sm">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-default btn-flat btn-koi-search-tercero-component-table" data-field="orden_tercero">
                                        <i class="fa fa-user"></i>
                                    </button>
                                </span>
                                <input id="orden_tercero" placeholder="Cliente" class="form-control tercero-koi-component" name="orden_tercero" type="text" maxlength="15" data-wrapper="ordenes-create" data-name="orden_terecero_nombre" data-contacto="btn-add-contact" value="<%- tercero_nombre%>" required>
                            </div>
                        </div>
                        <div class="col-sm-5 col-xs-10">
                            <input id="orden_terecero_nombre" name="orden_terecero_nombre" placeholder="Nombre cliente" class="form-control input-sm" type="text" maxlength="15" value="<%- tercero_nit %>" readonly required>
                        </div>
                        <div class="col-sm-1 col-xs-2">
                            <button type="button" class="btn btn-default btn-flat btn-sm btn-add-resource-koi-component" data-resource="tercero" data-field="orden_tercero">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>

                    
                </form>
        </div>
    </script>
@stop