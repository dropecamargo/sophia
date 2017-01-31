@extends('layout.layout')

@section('title') Ordenes @stop

@section('content')
<section class="content-header">
    <h1>
        Orden<small>Administración de Ordenes</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i>{{ trans('app.home') }}</a></li>
        @yield('breadcrumb')
    </ol>
</section>

<section class="content">
    @yield ('module')
</section>


<script type="text/template" id="add-orden-tpl">

<div class="box-header with-border">
        <form method="POST" accept-charset="UTF-8" id="form-orden" data-toggle="validator">
            <% if( typeof(id) !== 'undefined' && !_.isUndefined(id) && !_.isNull(id) && id != '') { %>
            <div class="row">
                <label class="col-sm-1 control-label">Id</label>
                <div class="form-group col-md-1">
                       <%-id%>
                </div>
            </div>
            <br/>
            <% } %>

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
       

            <div class="row">
                <label for="orden_fecha" class="col-sm-1 control-label">Fecha</label>
                <div class="form-group col-md-3">
                    <input type="text" id="orden_fecha" name="orden_fecha" class="form-control input-sm datepicker" value="<%- orden_fecha %>" required>
                </div>  
            </div>
            
            {{--producto--}}

            <div class="row">
                <label for="orden_fecha" class="col-sm-1 control-label">Producto</label>
                <div class="form-group col-sm-3">
                    <div class="input-group input-group-sm">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default btn-flat btn-koi-search-producto-component" data-field="sirvea_codigo">
                                <i class="fa fa-barcode"></i>
                            </button>
                        </span>
                        <input id="sirvea_codigo" placeholder="Serie" class="form-control producto-koi-component" name="sirvea_codigo" type="text" maxlength="15" data-wrapper="producto_create" data-name="sirvea_maquina" value="<%- producto_serie %>" required>
                    </div>
                </div>
                <div class="col-sm-5 col-xs-10">
                    <input id="sirvea_maquina" name="sirvea_maquina" placeholder="Nombre producto" class="form-control input-sm" type="text" value="<%- producto_nombre %>"readonly required>
                </div>
            </div>

            {{--selects--}}

            <div class="row">
                <label for="orden_tipoorden" class="control-label col-sm-1">Tipo</label>
                <div class="form-group col-md-3">
                
                    <select name="orden_tipoorden" id="orden_tipoorden" class="form-control select2-default" required>
                        <option value="" selected>Seleccione</option>
                        @foreach( App\Models\Tecnico\TipoOrden::getTiposOrden() as $key => $value)
                            <option value="{{ $key }}" <%- orden_tipoorden == '{{ $key }}' ? 'selected': ''%> >{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-1">
                    <button type="button" class="btn btn-default btn-flat btn-sm btn-add-resource-koi-component" data-resource="tipoorden" data-field="orden_tipoorden">
                        <i class="fa fa-plus"></i>
                    </button>
                </div>


                <label for="orden_solicitante" class="control-label col-sm-1">Solicitante</label>
                <div class="form-group col-md-3">
                
                    <select name="orden_solicitante" id="orden_solicitante" class="form-control select2-default" required>
                        <option value="" selected>Seleccione</option>
                        @foreach( App\Models\Tecnico\Solicitante::getSolicitantes() as $key => $value)
                            <option value="{{ $key }}" <%- orden_solicitante == '{{ $key }}' ? 'selected': ''%> >{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-1">
                
                    <button type="button" class="btn btn-default btn-flat btn-sm btn-add-resource-koi-component" data-resource="solicitante" data-field="orden_solicitante">
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>
            
            
            <div class="row">
                <label for="orden_dano" class="control-label col-sm-1">Daño</label>
                <div class="form-group col-md-3">
                
                    <select name="orden_dano" id="orden_dano" class="form-control select2-default" required>
                        <option value="" selected>Seleccione</option>
                        @foreach( App\Models\Tecnico\Dano::getDanos() as $key => $value)
                            <option value="{{ $key }}" <%- orden_dano == '{{ $key }}' ? 'selected': ''%> >{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-1">
                    <button type="button" class="btn btn-default btn-flat btn-sm btn-add-resource-koi-component" data-resource="dano" data-field="orden_dano">
                        <i class="fa fa-plus"></i>
                    </button>
                </div>


                <label for="orden_prioridad" class="control-label col-sm-1">Prioridad</label>
                <div class="form-group col-md-3">
                
                    <select name="orden_prioridad" id="orden_prioridad" class="form-control select2-default" required>
                        <option value="" selected="">Seleccione</option>
                        @foreach( App\Models\Tecnico\Prioridad::getPrioridad() as $key => $value)
                            <option value="{{ $key }}" <%- orden_prioridad == '{{ $key }}' ? 'selected': ''%> >{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-1">
                
                    <button type="button" class="btn btn-default btn-flat btn-sm btn-add-resource-koi-component" data-resource="prioridad" data-field="orden_prioridad">
                        <i class="fa fa-plus"></i>
                    </button>
                </div>

            </div>
         
            
            <div class="row">
                <label for="orden_persona" class="col-sm-1 control-label">Persona</label>
                <div class="form-group col-md-7">
                    <input id="orden_persona" type="text" name="orden_persona" class="form-control" placeholder="Persona" value="<%- orden_persona %>">
                </div>
            </div> 

            <div class="row">
                <label for="orden_problema" class="col-sm-1 control-label">Problema</label>
                <div class="form-group col-md-7">
                    <textarea id="orden_problema" name="orden_problema" class="form-control" rows="2" placeholder="Problema ..."><%- orden_problema %></textarea>
                </div>
            </div>
         
                 
            
            <div class="row">
                <br><label class="checkbox-inline control-label col-sm-1" for="orden_abierta" >
                 <input type="checkbox" id="orden_abierta" name="orden_abierta" value="orden_abierta" <%- orden_abierta ? 'checked': ''%>> <b>Activa</b>
                </label>
            </div>
      

            <div class="row">
                <div class="col-md-2 col-md-offset-4 col-sm-6 col-xs-6">
                    <a href="{{ route('ordenes.index') }}" class="btn btn-default btn-sm btn-block">{{ trans('app.cancel') }}</a>
                </div>
                <div class="col-md-2 col-sm-6 col-xs-6">
                    <button type="submit" class="btn btn-primary btn-sm btn-block">{{ trans('app.save') }}</button>
                </div>
            </div>     
           
            
        </form> 
        <br/>
           
    </div>

</script>  

@stop