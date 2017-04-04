@extends('layout.layout')

@section('title') Asignación @stop

@section('content')
    <section class="content-header">
        <h1>
            Asignación <small>Administración de Asignación</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> {{trans('app.home')}}</a></li>
            @yield('breadcrumb')
        </ol>
    </section>

    <section class="content">
        @yield ('module')
    </section>

    <script type="text/template" id="add-asignacion-envio-tpl">
        <div class="box-body">
            <form method="POST" accept-charset="UTF-8" id="form-asignacion1" data-toggle="validator">
                <div class="row">
                    <div class="form-group col-md-2 col-xs-6 col-sm-6">
                    <label for="asignacion1_fecha" class="control-label">Fecha</label>
                        <input type="text" id="asignacion1_fecha" name="asignacion1_fecha" class="form-control input-sm datepicker" value="<%- asignacion1_fecha %>" required>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-2 col-xs-6 col-sm-6">
                    <label for="asignacion1_tercero" class="control-label">Cliente</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-default btn-flat btn-koi-search-tercero-component-table" data-field="asignacion1_tercero">
                                    <i class="fa fa-user"></i>
                                </button>
                            </span>
                            <input id="asignacion1_tercero" placeholder="Cliente" class="form-control tercero-koi-component" name="asignacion1_tercero" type="text" maxlength="15" data-wrapper="asignacion1s-create" data-name="tercero_nombre" data-contacto="btn-add-contact" data-activo="true" required>
                        </div>
                    </div>
                    <div class="col-sm-5 col-md-5 col-xs-10">
                        <br>
                        <input id="tercero_nombre" name="tercero_nombre" placeholder="Nombre cliente" class="form-control input-sm" type="text" readonly required>
                    </div>

                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="asignacion1_contrato" class="control-label">Contrato</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-default btn-flat btn-koi-search-contrato-component-table" data-field="asignacion1_contrato" data-name="nombre_contrato" data-tercero="btn-add-contact">
                                    <i class="fa fa-briefcase"></i>
                                </button>
                            </span>
                            <input id="asignacion1_contrato" name="asignacion1_contrato" type="hidden" value="<%- asignacion1_contrato %>">
                            <input id="nombre_contrato" placeholder="Contacto" class="form-control" name="nombre_contrato" type="text" readonly required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-3 col-sm-2 col-xs-10">
                        <label for="tcontacto_nombre" class="control-label">Contacto</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-default btn-flat btn-koi-search-contacto-component-table" data-field="asignacion1_contacto" data-name="tcontacto_nombre" data-phone="tcontacto_telefono" data-tercero="btn-add-contact">
                                    <i class="fa fa-address-book"></i>
                                </button>
                            </span>
                            <input id="asignacion1_contacto" name="asignacion1_contacto" type="hidden" value="<%- asignacion1_contacto %>">
                            <input id="tcontacto_nombre" placeholder="Contacto" class="form-control" name="tcontacto_nombre" type="text" readonly required>
                        </div>
                    </div>
                    <div class="col-sm-1 col-md-1 col-xs-2">
                        <br>
                        <button type="button" id="btn-add-contact" class="btn btn-default btn-flat btn-sm btn-add-resource-koi-component" data-resource="contacto" data-field="asignacion1_contacto" data-name="tcontacto_nombre" data-tercero="<%- asignacion1_tercero %>" data-phone="tcontacto_telefono">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="tcontacto_telefono" class="control-label">Teléfono</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <input id="tcontacto_telefono" class="form-control input-sm" name="tcontacto_telefono" type="text" data-inputmask="'mask': '(999) 999-99-99'" data-mask readonly required>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="asignacion1_municipio" class="control-label">Municipio</label>
                        <select name="asignacion1_municipio" id="asignacion1_municipio" class="form-control select2-default" required>
                            <option value="" selected>Seleccione</option>
                            @foreach( App\Models\Base\Municipio::getMunicipios() as $key => $value)
                                <option value="{{ $key }}" <%- asignacion1_municipio == '{{ $key }}' ? 'selected': ''%> >{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="asignacion1_area" class="control-label">Area</label>
                        <input type="text" id="asignacion1_area" name="asignacion1_area" value="<%- asignacion1_area %>" placeholder="Area" class="form-control input-sm input-toupper" maxlength="30" required>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="asignacion1_centrocosto" class="control-label">Centro Costo</label>
                        <input type="text" id="asignacion1_centrocosto" name="asignacion1_centrocosto" value="<%- asignacion1_centrocosto %>" placeholder="Centro Costo" class="form-control input-sm input-toupper" maxlength="30" required>
                    </div>
                    
                    <div class="form-group col-md-3">
                        <label for="asignacion1_direccion" class="control-label">Dirección</label> <small id="asignacion1_dir_nomenclatura"><%- asignacion1_direccion_nomenclatura %></small>
                        <div class="input-group input-group-sm">
                            <input type="hidden" id="asignacion1_direccion_nomenclatura" name="asignacion1_direccion_nomenclatura" value="<%- asignacion1_direccion_nomenclatura %>">
                            <input id="asignacion1_direccion" value="<%- asignacion1_direccion %>" placeholder="Dirección" class="form-control address-koi-component" name="asignacion1_direccion" type="text" maxlength="100" required data-nm-name="asignacion1_dir_nomenclatura" data-nm-value="asignacion1_direccion_nomenclatura">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-default btn-flat btn-address-koi-component" data-field="asignacion1_direccion">
                                    <i class="fa fa-map-signs"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="asignacion1_tecnico" class="control-label">Tecnico</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-default btn-flat btn-koi-search-tercero-component-table" data-field="asignacion1_tecnico">
                                    <i class="fa fa-user"></i>
                                </button>
                            </span>
                            <input id="asignacion1_tecnico" placeholder="Tecnico" class="form-control tercero-koi-component" name="asignacion1_tecnico" type="text" maxlength="15" data-wrapper="asignacion1s-create" data-name="tecnico_nombre" required>
                        </div>
                    </div>
                    <br>
                    <div class="col-sm-5 col-md-6 col-xs-12">
                        <input id="tecnico_nombre" name="tecnico_nombre" placeholder="Nombre tecnico" class="form-control input-sm" type="text" readonly required>
                    </div>
                </div>
            </form>

            <div class="box box-danger" id="wrapper-producto">
                <div class="box-body">
                    <form method="POST" accept-charset="UTF-8" id="form-asignacion2" data-toggle="validator">
                        <div class="row">
                            <div class="form-group col-sm-2 col-md-offset-2">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-default btn-flat btn-koi-search-producto-component" data-field="asignacion2_producto">
                                            <i class="fa fa-barcode"></i>
                                        </button>
                                    </span>
                                    <input id="asignacion2_producto" placeholder="Serie" class="form-control producto-koi-component" name="asignacion2_producto" type="text" maxlength="15" data-wrapper="producto_create" data-name="producto_nombre" data-render="wrapper-render-type" data-tipo="AC,EQ" data-tipo-asignacion="E" data-contrato="true" required>
                                </div>
                            </div>
                            <div class="col-sm-5 col-xs-12">
                                <input id="producto_nombre" name="producto_nombre" placeholder="Nombre producto" class="form-control input-sm" type="text" readonly required>
                            </div>

                            <div class="form-group col-sm-1 col-md-1 col-xs-6">
                                <button type="submit" class="btn btn-success btn-sm btn-block">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div id="wrapper-render-type"></div>
                    </form>

                    <!-- table table-bordered table-striped -->
                    <div class="box-body table-responsive no-padding">
                        <table id="browse-asignacion2-list" class="table table-hover table-bordered" cellspacing="0" width="100%">
                            <tr>
                                <th></th>
                                <th>Producto</th>
                                <th>Tipo</th>
                                <th>De</th>
                            </tr>
                            <tfoot>
                                <tr>
                                    {{--render producto--}}
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="box-footer with-border">
            <div class="row">
                <div class="col-md-2 col-sm-6 col-md-offset-4 col-xs-6 text-left">
                    <a href="{{ route('asignaciones.index') }}" class="btn btn-default btn-sm btn-block">{{ trans('app.cancel') }}</a>
                </div>
                <div class="col-md-2  col-sm-6 col-xs-6 text-right">
                    <button type="button" class="btn btn-primary btn-sm btn-block submit-asignacion1">{{ trans('app.save') }}</button>
                </div>
            </div>
        </div>
    </script>

    <script type="text/template" id="add-asignacion-retiro-tpl">
        <div class="box-body">
            <form method="POST" accept-charset="UTF-8" id="form-asignacion1" data-toggle="validator">
                <div class="row">
                    <div class="form-group col-md-2 col-sm-8 col-xs-8">
                    <label for="asignacion1_tercero" class="control-label">Cliente</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-default btn-flat btn-koi-search-tercero-component-table" data-field="asignacion1_tercero">
                                    <i class="fa fa-user"></i>
                                </button>
                            </span>
                            <input id="asignacion1_tercero" placeholder="Cliente" class="form-control tercero-koi-component" name="asignacion1_tercero" type="text" maxlength="15" data-wrapper="asignacion1s-create" data-name="tercero_nombre" data-contacto="btn-add-contact" data-activo="true" required>
                        </div>
                    </div>
                    <div class="col-sm-5 col-md-5 col-xs-10">
                        <br>
                        <input id="tercero_nombre" name="tercero_nombre" placeholder="Nombre cliente" class="form-control input-sm" type="text" readonly required>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-2 col-sm-4 col-xs-4">
                    <label for="asignacion1_fecha" class="control-label">Fecha</label>
                        <input type="text" id="asignacion1_fecha" name="asignacion1_fecha" class="form-control input-sm datepicker" value="<%- asignacion1_fecha %>" required>
                    </div>

                    <div class="form-group col-sm-2 col-xs-10">
                    <label for="tcontacto_nombre" class="control-label">Contacto</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-default btn-flat btn-koi-search-contacto-component-table" data-field="asignacion1_contacto" data-name="tcontacto_nombre" data-phone="tcontacto_telefono" data-tercero="btn-add-contact">
                                    <i class="fa fa-address-book"></i>
                                </button>
                            </span>
                            <input id="asignacion1_contacto" name="asignacion1_contacto" type="hidden" value="<%- asignacion1_contacto %>">
                            <input id="tcontacto_nombre" placeholder="Contacto" class="form-control" name="tcontacto_nombre" type="text" readonly required>
                        </div>
                    </div>
                    <div class="col-sm-1 col-xs-2">
                        <br>
                        <button type="button" id="btn-add-contact" class="btn btn-default btn-flat btn-sm btn-add-resource-koi-component" data-resource="contacto" data-field="asignacion1_contacto" data-name="tcontacto_nombre" data-tercero="<%- asignacion1_tercero %>" data-phone="tcontacto_telefono">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="tcontacto_telefono" class="control-label">Teléfono</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <input id="tcontacto_telefono" class="form-control input-sm" name="tcontacto_telefono" type="text" data-inputmask="'mask': '(999) 999-99-99'" data-mask readonly required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-2 col-sm-3 col-xs-10">
                        <label for="asignacion1_contrato" class="control-label">Contrato</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-default btn-flat btn-koi-search-contrato-component-table" data-field="asignacion1_contrato" data-name="nombre_contrato" data-tercero="btn-add-contact" data-producto="btn-add-contrato">
                                    <i class="fa fa-briefcase"></i>
                                </button>
                            </span>
                            <input id="asignacion1_contrato" name="asignacion1_contrato" type="hidden" value="<%- asignacion1_contrato %>">
                            <input id="nombre_contrato" placeholder="Contacto" class="form-control" name="nombre_contrato" type="text" readonly required>
                        </div>
                    </div>
                </div>
            </form>

            <div class="box box-danger" id="wrapper-producto">
                <div class="box-body">
                    <form method="POST" accept-charset="UTF-8" id="form-asignacion2" data-toggle="validator">
                        <div class="row">
                            <div class="form-group col-md-2 col-sm-6 col-xs-6 col-md-offset-2">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-default btn-flat btn-koi-search-producto-component" data-field="asignacion2_producto" data-contrato="btn-add-producto">
                                            <i class="fa fa-barcode"></i>
                                        </button>
                                    </span>
                                    <input id="asignacion2_producto" placeholder="Serie" class="form-control producto-koi-component" name="asignacion2_producto" type="text" data-wrapper="producto_create" data-name="producto_nombre" data-render="wrapper-render-type" data-tipo="AC,EQ" data-contrato="true" data-tipo-asignacion="R" data-asignaciones="false" required>
                                </div>
                            </div>
                            <div class="col-sm-5 col-md-5 col-xs-10">
                                <input id="producto_nombre" name="producto_nombre" placeholder="Nombre producto" class="form-control input-sm" type="text" readonly required>
                            </div>

                            <div class="form-group col-md-1 col-sm-1">
                                <button type="submit" class="btn btn-success btn-sm btn-block">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- table table-bordered table-striped -->
                    <div class="box-body table-responsive no-padding">
                        <table id="browse-asignacion2-list" class="table table-hover table-bordered" cellspacing="0" width="100%">
                            <tr>
                                <th></th>
                                <th>Producto</th>
                                <th>Tipo</th>
                                <th>De</th>
                            </tr>
                            <tfoot>
                                <tr>
                                    {{--render producto--}}
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="box-footer with-border">
            <div class="row">
                <div class="col-md-2 col-sm-6 col-md-offset-4 col-xs-6 text-left">
                    <a href="{{ route('asignaciones.index') }}" class="btn btn-default btn-sm btn-block">{{ trans('app.cancel') }}</a>
                </div>
                <div class="col-md-2  col-sm-6 col-xs-6 text-right">
                    <button type="button" class="btn btn-primary btn-sm btn-block submit-asignacion1">{{ trans('app.save') }}</button>
                </div>
            </div>
        </div>
    </script>

    <script type="text/template" id="add-asignacion2-item-tpl">
        <% if(edit) { %>
                <td class="text-center">
                <% if( tipo_codigo != 'AC') { %>
                    <a class="btn btn-default btn-xs item-asignacion2-remove" data-resource="<%- id %>">
                        <span><i class="fa fa-times"></i></span>
                    </a>
                <% } %>
                </td>
        <% } %>
        <td><%- producto_nombre %></td>
        <td><%- nombre %></td>
        <td><%- producto_nombre_search %></td>
    </script>
@stop