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
                        <select name="producto_marca" id="producto_marca" class="form-control select2-default">
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
                        <select name="producto_modelo" id="producto_modelo" class="form-control select2-default">
                            <option value="" selected>Seleccione</option>
                            @foreach( App\Models\Inventario\Modelo::getModelos() as $key => $value)
                                <option value="{{ $key }}" <%- producto_modelo == '{{ $value }}' ? 'selected': ''%> >{{ $value }}</option>
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
                    <label for="producto_tipo" class="control-label">Tipo</label>
                        <select name="producto_tipo" id="producto_tipo" class="form-control select2-default">
                            <option value="" selected>Seleccione</option>
                            @foreach( App\Models\Inventario\Tipo::getTipos() as $key => $value)
                                <option value="{{ $key }}" <%- producto_tipo == '{{ $key }}' ? 'selected': ''%> >{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-1">
                    <br>
                        <button type="button" class="btn btn-default btn-flat btn-sm btn-add-resource-koi-component" data-resource="tipo" data-field="producto_tipo">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>

                    
                    <div class="form-group col-md-3">
                    <label for="producto_estado" class="control-label">Estado</label>
                        <select name="producto_estado" id="producto_estado" class="form-control select2-default">
                            <option value="" selected>Seleccione</option>
                            @foreach( App\Models\Base\Estado::getEstados() as $key => $value)
                                <option value="{{ $key }}" <%- producto_estado == '{{ $value }}' ? 'selected': ''%> >{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-1">
                    <br>
                        <button type="button" class="btn btn-default btn-flat btn-sm btn-add-resource-koi-component" data-resource="estado" data-field="producto_estado" > <i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-3">
                    <label for="producto_proveedor" class="control-label">Proveedor</label>
                        <select name="producto_proveedor" id="producto_proveedor" class="form-control select2-default">
                            <option value="" selected>Seleccione</option>
                            {{--@foreach( App\Models\Base\Tercero::getTercero() as $key => $value)
                                <option value="{{ $key }}" <%- producto_proveedor == '{{ $value }}' ? 'selected': ''%> >{{ $value }}</option>
                            @endforeach--}}
                        </select>
                    </div>
                    <div class="form-group col-md-1">
                    <br>
                        <button type="button" class="btn btn-default btn-flat btn-sm btn-add-resource-koi-component" data-resource="tercero" data-field="producto_proveedor" > <i class="fa fa-plus"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </script>
@stop