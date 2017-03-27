@extends('layout.layout')

@section('title') Productos @stop

@section('content')
<section class="content-header">
    <h1>
        Productos <small>Administración de productos</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> {{trans('app.home')}}</a></li>
        @yield('breadcrumb')
    </ol>
</section>

<section class="content">
    @yield ('module')
</section>

<script type="text/template" id="add-producto-tpl">
    <div class="box-body">
        <form method="POST" accept-charset="UTF-8" id="form-producto" data-toggle="validator">
            <div class="row">
                <div class="form-group col-md-9">
                    <label for="producto_nombre" class="control-label">Nombre del Producto</label>
                    <input type="text" id="producto_nombre" name="producto_nombre" value="<%- producto_nombre %>" placeholder="Nombre Producto" class="form-control input-sm input-toupper" maxlength="100" required>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-3 div-placa" <%- tipo_codigo != 'EQ' ? 'hidden' : '' %> >
                    <label for="producto_placa" class="control-label">Placa</label>
                    <input type="number" id="producto_placa" min="1" max="99999999" name="producto_placa" value="<%- producto_placa %>" placeholder="Placa" class="form-control input-sm input-toupper">
                </div>

                <div class="form-group col-md-3 div-serie" <%- tipo_codigo != 'EQ' && tipo_codigo != 'AC' ? 'hidden' : '' %> >
                    <label for="producto_serie" class="control-label">Serie</label>
                    <input type="text" id="producto_serie" name="producto_serie" value="<%- producto_serie %>" placeholder="Serie" class="form-control input-sm input-toupper" maxlength="20">
                </div>

                <div class="form-group col-md-3">
                    <label for="producto_referencia" class="control-label">Referencia de Proveedor</label>
                    <input type="text" id="producto_referencia" name="producto_referencia" value="<%- producto_referencia %>" placeholder="Referencia" class="form-control input-sm input-toupper" maxlength="20" required>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-3">
                    <label for="producto_codigo" class="control-label">Codigo contable</label>
                    <input type="text" id="producto_codigo" name="producto_codigo" value="<%- producto_codigo %>" placeholder="Codigo" class="form-control input-sm input-toupper" maxlength="20" required></i>
                </div>
                <div class="form-group col-md-3 div-vidautil" <%- tipo_codigo != 'IN' && tipo_codigo != 'CO' ? 'hidden' : '' %> >
                    <label for="producto_vida_util" class="control-label">Vida util</label>
                    <input type="text" id="producto_vida_util" name="producto_vida_util" value="<%- producto_vida_util %>" placeholder="Vida util" class="form-control input-sm" maxlength="20" min="0" data-currency-numeric>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-3">
                <label for="producto_tipo" class="control-label">Tipo</label>
                    <select name="producto_tipo" id="producto_tipo" class="form-control select2-default select-tipo" required>
                        <option value="" selected>Seleccione</option>
                        @foreach( App\Models\Inventario\Tipo::getTipos() as $key => $value)
                            <option value="{{ $key }}" <%- producto_tipo == '{{ $key }}' ? 'selected': ''%>>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-offset-1 col-md-3 div-modelo" <%- tipo_codigo != 'EQ' ? 'hidden' : '' %> >
                <label for="producto_modelo" class="control-label">Modelo</label>
                    <select name="producto_modelo" id="producto_modelo" class="form-control select2-default">
                        <option value="" selected>Seleccione</option>
                        @foreach( App\Models\Inventario\Modelo::getModelos() as $key => $value)
                            <option value="{{ $key }}" <%- producto_modelo == '{{ $key }}' ? 'selected': ''%> >{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-1 div-modelo" <%- tipo_codigo != 'EQ' ? 'hidden' : '' %> >
                <br>
                    <button type="button" class="btn btn-default btn-flat btn-sm btn-add-resource-koi-component" data-resource="modelo" data-field="producto_modelo" > <i class="fa fa-plus"></i></button>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-3 div-marca" <%- tipo_codigo != 'EQ' && tipo_codigo != 'AC' && tipo_codigo != 'IN' && tipo_codigo != 'CO' && tipo_codigo != 'RP' ? 'hidden' : '' %> >
                <label for="producto_marca" class="control-label">Marca</label>
                    <select name="producto_marca" id="producto_marca" class="form-control select2-default">
                        <option value="" selected>Seleccione</option>
                        @foreach( App\Models\Inventario\Marca::getMarcas() as $key => $value)
                            <option value="{{ $key }}" <%- producto_marca == '{{ $key }}' ? 'selected': ''%> >{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-1 div-marca" <%- tipo_codigo != 'EQ' && tipo_codigo != 'AC' && tipo_codigo != 'IN' && tipo_codigo != 'CO' && tipo_codigo != 'RP' ? 'hidden' : '' %> >
                <br>
                    <button type="button" class="btn btn-default btn-flat btn-sm btn-add-resource-koi-component" data-resource="marca" data-field="producto_marca">
                        <i class="fa fa-plus"></i>
                    </button>
                </div>

                <div class="form-group col-md-3 div-estado" <%- tipo_codigo != 'EQ' && tipo_codigo != 'AC' && tipo_codigo != 'IN' && tipo_codigo != 'CO' && tipo_codigo != 'RP' ? 'hidden' : '' %> >
                    <label for="producto_estado" class="control-label">Estado</label>
                    <select name="producto_estado" id="producto_estado" class="form-control select2-default">
                        <option value="" selected>Seleccione</option>
                        @foreach( App\Models\Base\Estado::getEstados() as $key => $value)
                            <option value="{{ $key }}" <%- producto_estado == '{{ $key }}' ? 'selected': ''%> >{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-1 div-estado" <%- tipo_codigo != 'EQ' && tipo_codigo != 'AC' && tipo_codigo != 'IN' && tipo_codigo != 'CO' && tipo_codigo != 'RP' ? 'hidden' : '' %> >
                <br>
                    <button type="button" class="btn btn-default btn-flat btn-sm btn-add-resource-koi-component" data-resource="estado" data-field="producto_estado"> <i class="fa fa-plus"></i></button>
                </div>
            </div>

                <div class="row">
                    <div class="form-group col-md-2">
                    <label for="producto_proveedor" class="control-label">Proveedor</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-default btn-flat btn-koi-search-tercero-component-table" data-field="producto_proveedor">
                                    <i class="fa fa-user"></i>
                                </button>
                            </span>
                            <input id="producto_proveedor" placeholder="Cliente" class="form-control tercero-koi-component" name="producto_proveedor" type="text" maxlength="15" data-wrapper="producto-create" data-name="producto_tercero_nombre" data-contacto="btn-add-contact" value="<%- tercero_nit %>">
                        </div>
                    </div>
                    <br>
                    <div class="col-sm-5 col-xs-10">
                        <input id="producto_tercero_nombre" name="producto_tercero_nombre" placeholder="Nombre cliente" class="form-control input-sm" type="text" maxlength="15" value="<%- tercero_nombre %>" readonly>
                    </div>
                    <div class="col-sm-1 col-xs-2">
                        <button type="button" class="btn btn-default btn-flat btn-sm btn-add-resource-koi-component" data-resource="tercero" data-field="producto_proveedor" > <i class="fa fa-plus"></i></button>

                    </div>
                </div>
                <br>
            </div>
        </form>

        <div class="box-header with-border">
            <div class="row">
                <div class="col-md-2 col-md-offset-4 col-sm-6 col-xs-6">
                    <a href="{{ route('productos.index') }}" class="btn btn-default btn-sm btn-block">{{ trans('app.cancel') }}</a>
                </div>
                <div class="col-md-2 col-sm-6 col-xs-6">
                    <button type="button" class="btn btn-primary btn-sm btn-block submit-producto">{{ trans('app.save') }}</button>
                </div>
            </div>
        </div>

        <% if( typeof(id) !== 'undefined' && !_.isUndefined(id) && !_.isNull(id) && id != '') { %>
            <div class="row">
                <div class="form-group col-md-12">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <% if(tipo_codigo != 'EQ'){ %>
                                <li class="active"><a href="#tab_sirveas" data-toggle="tab">Sirve a</a></li>
                            <% }else{ %>
                                <li class="active"><a href="#tab_productoscontador" data-toggle="tab">Contador</a></li>
                            <% } %>
                        </ul>

                        <div class="tab-content">
                            {{-- Content sirveas --}}
                            <div class="tab-pane<%- tipo_codigo != 'EQ' ? '-active' : '' %>" id="tab_sirveas">
                                <div class="box box-danger" id="wrapper-producto-sirveas">
                                    <div class="box-body">
                                        <form method="POST" accept-charset="UTF-8" id="form-item-sirvea" data-toggle="validator">
                                            <div class="row">
                                                <div class="form-group col-sm-2 col-md-offset-1">
                                                    <div class="input-group input-group-sm">
                                                        <span class="input-group-btn">
                                                            <button type="button" class="btn btn-default btn-flat btn-koi-search-producto-component" data-field="sirvea_codigo">
                                                                <i class="fa fa-barcode"></i>
                                                            </button>
                                                        </span>
                                                        <input id="sirvea_codigo" placeholder="Serie" class="form-control producto-koi-component" name="sirvea_codigo" type="text" maxlength="15" data-wrapper="producto_create" data-tipo="<%- producto_tipo == 1 ? 'AC,CO,IN,RP' : '' %>" data-name="sirvea_codigo_nombre" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-7 col-xs-10">
                                                    <input id="sirvea_codigo_nombre" name="sirvea_codigo_nombre" placeholder="Nombre producto" class="form-control input-sm" type="text" maxlength="15" readonly required>
                                                </div>
                                                <div class="form-group col-sm-1">
                                                    <button type="submit" class="btn btn-danger btn-sm btn-block">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- table table-bordered table-striped -->
                                        <div class="box-body table-responsive no-padding">
                                            <table id="browse-sirveas-producto-list" class="table table-hover table-bordered" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th width="5px"></th>
                                                        <th width="5px">Serie</th>
                                                        <th width="95px">Nombre</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    {{-- Render content sirveas --}}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Content contadores --}}
                            <div class="tab-pane<%- tipo_codigo == 'EQ' ? '-active' : '' %>" id="tab_productoscontador">
                                <div class="box box-danger" id="wrapper-producto-productoscontador">
                                    <div class="box-body">
                                        <form method="POST" accept-charset="UTF-8" id="form-item-productocontador" data-toggle="validator">
                                            <div class="row">
                                                <label for="productocontador_contador" class="control-label col-sm-1 col-sm-offset-1 hidden-xs">Contador</label>
                                                    <div class="form-group col-sm-7 col-xs-10">
                                                        <select name="productocontador_contador" id="productocontador_contador" class="form-control select2-default" required>
                                                            @foreach( App\Models\Inventario\Contador::getContadores() as $key => $value)
                                                                <option value="{{ $key }}" <%- contador_nombre == '{{ $value }}' ? 'selected': ''%> >{{ $value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-sm-1 col-xs-2 text-right">
                                                        <button type="button" class="btn btn-default btn-flat btn-sm btn-add-resource-koi-component" data-resource="pcontador" data-field="productocontador_contador">
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                    </div>
                                                    <div class="form-group col-sm-1">
                                                        <button type="submit" class="btn btn-danger btn-sm btn-block">
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                            <!-- table table-bordered table-striped -->
                                            <div class="box-body table-responsive no-padding">
                                                <table id="browse-productoscontador-producto-list" class="table table-hover table-bordered" cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th width="5px"></th>
                                                            <th width="95px">Contador</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        {{-- Render content productoscontador --}}
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <% } %>
    </div>
</script>

<script type="text/template" id="add-sirvea-item-tpl">
    <% if(edit) { %>
    <td class="text-center">
        <a class="btn btn-default btn-xs item-sirvea-remove" data-resource="<%- id %>">
            <span><i class="fa fa-times"></i></span>
        </a>
    </td>
    <% } %>
    <td><%- serie %></td>
    <td><%- nombre %></td>
</script>

<script type="text/template" id="add-productocontador-item-tpl">
    <% if(edit) { %>
    <td class="text-center">
        <a class="btn btn-default btn-xs <%- productocontador_contador == {{ App\Models\Inventario\Contador::$ctr_machines }} ? 'hide' : 'item-productocontador-remove' %>" data-resource="<%- id %>">
            <span><i class="fa fa-times"></i></span>
        </a>
    </td>
    <% } %>

    <td><%- contador_nombre %></td>
</script>
@stop