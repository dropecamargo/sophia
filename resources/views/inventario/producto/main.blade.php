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
    <div class="box-header with-border">
        <div class="row">
            <div class="col-md-2 col-sm-6 col-xs-6 text-left">
                <a href="<%- window.Misc.urlFull( (typeof(id) !== 'undefined' && !_.isUndefined(id) && !_.isNull(id) && id != '') ? Route.route('productos.show', { productos: id}) : Route.route('productos.index') ) %>" class="btn btn-default btn-sm btn-block">{{ trans('app.cancel') }}</a>
            </div>
            <div class="col-md-2 col-md-offset-8 col-sm-6 col-xs-6 text-right">
                <button type="button" class="btn btn-primary btn-sm btn-block submit-producto">{{ trans('app.save') }}</button>
            </div>
        </div>
    </div>

    <div class="box-body">
        <form method="POST" accept-charset="UTF-8" id="form-producto" data-toggle="validator">
            <div class="row">
                <div class="form-group col-md-8">
                    <label for="producto_nombre" class="control-label">Nombre del Producto</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-refresh"></i>
                        </div>
                        <input type="text" id="producto_nombre" name="producto_nombre" value="<%- producto_nombre %>" placeholder="Nombre Producto" class="form-control input-sm input-toupper" maxlength="100" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-4">
                    <label for="producto_placa" class="control-label">Placa</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-caret-right"></i>
                            </div>
                            <input type="text" id="producto_placa" name="producto_placa" value="<%- producto_placa %>" placeholder="Placa" class="form-control input-sm input-toupper" maxlength="20">
                        </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="producto_serie" class="control-label">Serie</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-caret-right"></i>
                        </div>
                        <input type="text" id="producto_serie" name="producto_serie" value="<%- producto_serie %>" placeholder="Serie" class="form-control input-sm input-toupper" maxlength="20">
                    </div>
                    
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-4">
                    <label for="producto_referencia" class="control-label">Referencia</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-podcast"></i>
                        </div>
                        <input type="text" id="producto_referencia" name="producto_referencia" value="<%- producto_referencia %>" placeholder="Referencia" class="form-control input-sm input-toupper" maxlength="20" required>
                    </div>      
                </div>

                <div class="form-group col-md-4">
                <label for="producto_codigo" class="control-label">Codigo</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class = "fa fa-barcode"></i>
                        </div>
                        <input type="text" id="producto_codigo" name="producto_codigo" value="<%- producto_codigo %>" placeholder="Codigo" class="form-control input-sm input-toupper" maxlength="20" required></i>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-4">
                    <label for="producto_parte" class="control-label">Parte</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-cogs"></i>
                        </div>
                        <input type="text" id="producto_parte" name="producto_parte" value="<%- producto_parte %>" placeholder="Parte" class="form-control input-sm input-toupper" maxlength="20" required>
                    </div>      
                </div>


                <div class="form-group col-md-4">
                    <label for="producto_vida_util" class="control-label">Vida util</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-lightbulb-o"></i>               
                        </div>
                        <input type="text" id="producto_vida_util" name="producto_vida_util" value="<%- producto_vida_util %>" placeholder="Marca" class="form-control input-sm input-toupper" maxlength="20" required>
                    </div>
                    
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="producto_costo_promedio" class="control-label">Costo promedio</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-usd"></i>
                        </div>
                        <input type="text" id="producto_costo_promedio" name="producto_costo_promedio" value="<%- producto_costo_promedio %>" class="form-control input-sm" data-currency required>
                    </div>
                </div>

                <div class="form-group col-md-4">
                    <label for="producto_ultimo_costo" class="control-label">Ultimo costo</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-usd"></i>
                        </div>
                        <input type="text" id="producto_ultimo_costo" name="producto_ultimo_costo" value="<%- producto_ultimo_costo %>" class="form-control input-sm" data-currency required>
                    </div>
                </div>
            </div>
        </form>

    <% if( typeof(id) !== 'undefined' && !_.isUndefined(id) && !_.isNull(id) && id != '') { %>
        <div class="row">
            <div class="form-group col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_marcas" data-toggle="tab">Marcas</a></li>
                    </ul>

                    <div class="tab-content">
                        {{-- Content Marcas --}}
                        <div class="tab-pane active" id="tab_marcas">
                            <div class="box box-danger" id="wrapper-producto-marcas">
                                <div class="box-body">
                                    <form method="POST" accept-charset="UTF-8" id="form-marca" data-toggle="validator">
                                        <div class="row">
                                            <label for="producto_marca" class="control-label col-sm-1 col-sm-offset-1 hidden-xs">Marca</label>
                                            <div class="form-group col-sm-7 col-xs-10">
                                                <select name="producto_marca" id="producto_marca" class="form-control select2-default" required>
                                                    @foreach( App\Models\Inventario\Marca::getMarcas() as $key => $value)
                                                        <option value="{{ $key }}">{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-sm-1 col-xs-2 text-right">
                                                <button type="button" class="btn btn-default btn-flat btn-sm btn-add-resource-koi-component" data-resource="marca" data-field="producto_marca">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                            <div class="form-group col-sm-1">
                                                <button type="submit" class="btn btn-success btn-sm btn-block">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- table table-bordered table-striped -->
                                    <div class="box-body table-responsive no-padding">
                                        <table id="browse-marcas-producto-list" class="table table-hover table-bordered" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th width="5px"></th>
                                                    <th width="95px">Nombre</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- Render content Marcas --}}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
            <% } %>
        </div>
    </div>
</script>

<script type="text/template" id="producto-marca-item-list-tpl">
        <% if(edit) { %>
        <td class="text-center">
            <a class="btn btn-default btn-xs item-producto-remove" data-resource="<%- id %>">
                <span><i class="fa fa-times"></i></span>
            </a>
        </td>
       <% } %>
    <td><%- marca_modelo %></td>
</script>
@stop