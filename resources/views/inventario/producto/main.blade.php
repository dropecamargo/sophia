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
                    <div class="form-group col-md-3">
                        <label for="producto_placa" class="control-label">Placa</label>
                        <input type="text" id="producto_placa" name="producto_placa" value="<%- producto_placa %>" placeholder="Placa" class="form-control input-sm input-toupper" maxlength="20">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="producto_serie" class="control-label">Serie</label>
                        <input type="text" id="producto_serie" name="producto_serie" value="<%- producto_serie %>" placeholder="Serie" class="form-control input-sm input-toupper" maxlength="20">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="producto_referencia" class="control-label">Referencia</label>
                        <input type="text" id="producto_referencia" name="producto_referencia" value="<%- producto_referencia %>" placeholder="Referencia" class="form-control input-sm input-toupper" maxlength="20" required>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="producto_codigo" class="control-label">Codigo</label>
                        <input type="text" id="producto_codigo" name="producto_codigo" value="<%- producto_codigo %>" placeholder="Codigo" class="form-control input-sm input-toupper" maxlength="20" required></i>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="producto_parte" class="control-label">Parte</label>
                        <input type="text" id="producto_parte" name="producto_parte" value="<%- producto_parte %>" placeholder="Parte" class="form-control input-sm input-toupper" maxlength="20" required>   
                    </div>
                    <div class="form-group col-md-3">
                        <label for="producto_vida_util" class="control-label">Vida util</label>
                        <input type="number" id="producto_vida_util" name="producto_vida_util" value="<%- producto_vida_util %>" placeholder="Vida util" class="form-control input-sm input-toupper" maxlength="20" required min="0">         
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-3">
                    <label for="producto_marca" class="control-label">Marca</label>
                        <select name="producto_marca" id="producto_marca" class="form-control select2-default" required>
                            <option value="" selected>Seleccione</option>
                            @foreach( App\Models\Inventario\Marca::getMarcas() as $key => $value)
                                <option value="{{ $key }}" <%- producto_marca == '{{ $key }}' ? 'selected': ''%> >{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-1">
                    <br>
                        <button type="button" class="btn btn-default btn-flat btn-sm btn-add-resource-koi-component" data-resource="marca" data-field="producto_marca">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>

                    
                    <div class="form-group col-md-3">
                    <label for="producto_modelo" class="control-label">Modelo</label>
                        <select name="producto_modelo" id="producto_modelo" class="form-control select2-default" required>
                            <option value="" selected>Seleccione</option>
                            @foreach( App\Models\Inventario\Modelo::getModelos() as $key => $value)
                                <option value="{{ $key }}" <%- producto_modelo == '{{ $key }}' ? 'selected': ''%> >{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-1">
                    <br>
                        <button type="button" class="btn btn-default btn-flat btn-sm btn-add-resource-koi-component" data-resource="modelo" data-field="producto_modelo" > <i class="fa fa-plus"></i></button>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="producto_estado" class="control-label">Estado</label>
                        <select name="producto_estado" id="producto_estado" class="form-control select2-default" required>
                            <option value="" selected>Seleccione</option>
                            @foreach( App\Models\Base\Estado::getEstados() as $key => $value)
                                <option value="{{ $key }}" <%- producto_estado == '{{ $key }}' ? 'selected': ''%> >{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-1">
                    <br>
                        <button type="button" class="btn btn-default btn-flat btn-sm btn-add-resource-koi-component" data-resource="estado" data-field="producto_estado"> <i class="fa fa-plus"></i></button>
                    </div>

                    <div class="form-group col-md-3">
                    <label for="producto_tipo" class="control-label">Tipo</label>
                        <select name="producto_tipo" id="producto_tipo" class="form-control select2-default" required> 
                            <option value="" selected>Seleccione</option>
                            @foreach( App\Models\Inventario\Tipo::getTipos() as $key => $value)
                                <option value="{{ $key }}" <%- producto_tipo == '{{ $key }}' ? 'selected': ''%> >{{ $value }}</option>
                            @endforeach
                        </select>
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
                            <input id="producto_proveedor" placeholder="Cliente" class="form-control tercero-koi-component" name="producto_proveedor" type="text" maxlength="15" data-wrapper="producto-create" data-name="producto_tercero_nombre" data-contacto="btn-add-contact" value="<%- tercero_nit %>" required>
                        </div>
                    </div>
                    <br>
                    <div class="col-sm-5 col-xs-10">
                        <input id="producto_tercero_nombre" name="producto_tercero_nombre" placeholder="Nombre cliente" class="form-control input-sm" type="text" maxlength="15" value="<%- tercero_nombre %>" readonly required>
                    </div>
                    <div class="col-sm-1 col-xs-2">
                        <button type="button" class="btn btn-default btn-flat btn-sm btn-add-resource-koi-component" data-resource="tercero" data-field="producto_proveedor" > <i class="fa fa-plus"></i></button>
                    </div>
                </div>
            </form>

                        <% if( typeof(id) !== 'undefined' && !_.isUndefined(id) && !_.isNull(id) && id != '') { %>
                            <div class="form-group col-md-12">
                                <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#tab_areas" data-toggle="tab">Sirve a</a></li>
                                    </ul>   
                                    <div class="tab-content">
                                        {{-- Content areas --}}
                                        <div class="tab-pane active" id="tab_areas">    
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
                                                                    <input id="sirvea_codigo" placeholder="Serie" class="form-control producto-koi-component" name="sirvea_codigo" type="text" maxlength="15" data-wrapper="producto_create" data-name="sirvea_maquina" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-xs-10">
                                                                <input id="sirvea_maquina" name="sirvea_maquina" placeholder="Nombre producto" class="form-control input-sm" type="text" maxlength="15" readonly required>
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
@stop