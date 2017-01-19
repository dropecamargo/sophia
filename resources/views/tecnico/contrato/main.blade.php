@extends('layout.layout')

@section('title') Creacion Contrato @stop

@section('content')
<section class="content-header">
    <h1>
        Contrato<small>Administración de Contratos</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> {{trans('app.home')}}</a></li>
        @yield('breadcrumb')
    </ol>
</section>

<section class="content">
    @yield ('module')
</section>

<script type="text/template" id="add-contrato-tpl">
    <div class="row">
        <div class="form-group col-md-12">
            <div class="nav-tabs-custom tab-danger tab-whithout-box-shadow">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#tab_contrato" data-toggle="tab"> Contrato</a>
                    </li>
                </ul>
                <div class="tab-content">
                    {{-- Content contrato --}}
                    <div class="tab-pane active" id="tab_contrato" >
                        <div class="box box-whithout-border">
                            <div class="box-body">
                                <form method="POST" accept-charset="UTF-8" id="form-contratos" data-toggle="validator">
                                
                                        {{--<div class="row">
                                            <label for="contrato_tercero" class="col-sm-1 control-label">Cliente</label>
                                            <div class="form-group col-sm-3">
                                                <div class="input-group input-group-sm">
                                                    <span class="input-group-btn">
                                                        <button type="button" class="btn btn-default btn-flat btn-koi-search-tercero-component-table" data-field="contrato_tercero">
                                                            <i class="fa fa-user"></i>
                                                        </button>
                                                    </span>
                                                    <input id="contrato_tercero" placeholder="Cliente" class="form-control tercero-koi-component" name="contrato_tercero" type="text" maxlength="15" data-wrapper="ordenes-create" data-name="contrato_tercero_nombre" data-contacto="btn-add-contact" value="<%- contrato_tercero %>" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-5 col-xs-10">
                                                <input id="orden_cliente_nombre" name="orden_cliente_nombre" placeholder="Nombre cliente" class="form-control input-sm" type="text" maxlength="15" value="<%- tercero_nombre %>" readonly required>
                                            </div>
                                            <div class="col-sm-1 col-xs-2">
                                                <button type="button" class="btn btn-default btn-flat btn-sm btn-add-resource-koi-component" data-resource="tercero" data-field="orden_cliente">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>--}}
                                    <div class="row">

                                        <% if( typeof(id) !== 'undefined' && !_.isUndefined(id) && !_.isNull(id) && id != '') { %>
                                            <label class="col-sm-1 control-label">Id Contrato</label>
                                            <div class="form-group col-md-1">
                                                <%- id %>
                                            </div>

                                        <% } %>

                                        <label for="contrato_numero" class="col-sm-2 control-label">Número De Contrato</label>
                                        <div class="form-group col-md-6">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-paper-plane"></i>
                                                </div>
                                                <input id="contrato_numero" value="<%- contrato_numero %>" placeholder="Número Contrato" class="form-control  input-sm input-toupper" name="contrato_numero" type="text" maxlength="200" required>
                                            </div>                                        

                                        </div>
                                    </div>

                                    
                                    <div class="row">
                                        <label for="contrato_fecha" class="col-sm-2 control-label">F. Inicio</label>
                                        <div class="form-group col-md-2">
                                            <input type="text" id="contrato_fecha" name="contrato_fecha" placeholder="Fecha inicio" class="form-control input-sm datepicker" value="<%- contrato_fecha %>" required>
                                        </div>

                                        <label for="contrato_vencimiento" class="col-sm-2 control-label">F. Vencimiento</label>
                                        <div class="form-group col-md-2">
                                            <input type="text" id="contrato_vencimiento" name="contrato_vencimiento" placeholder="Fecha entrega" class="form-control input-sm datepicker" value="<%- contrato_vencimiento %>" required>
                                        </div>     
                                    </div>
                                     <div class="row">
                                    <label for="contrato_condiciones" class="col-sm-2 control-label">Condiciones Contrato</label>
                                    <div class="form-group col-md-6">
                                        <textarea id="contrato_condiciones" name="contrato_condiciones" class="form-control" rows="2" placeholder="Condiciones Contrato"><%- contrato_condiciones %></textarea>
                                    </div>
                                </div>  

                                <div class="row">
                                    <br><label class="checkbox-inline control-label col-sm-2" for="contrato_activo" >
                                     <input type="checkbox" id="contrato_activo" name="contrato_activo" value="contrato_activo" <%- contrato_activo ? 'checked': ''%>> <b>Activo</b>
                                    </label>
                                </div> 

                                </div>
                                
                                                       
                                
                                </form><br/>    

                                <div class="row">
                                    <div class="col-md-2 col-md-offset-2 col-sm-6 col-xs-6">
                                        <a href="{{ route('contratos.index') }}" class="btn btn-default btn-sm btn-block">{{ trans('app.cancel') }}</a>
                                    </div>
                                    <div class="col-md-2 col-sm-6 col-xs-6">
                                        <button type="submit" class="btn btn-primary btn-sm btn-block ">{{ trans('app.save') }}</button>
                                    </div>

                                   
                                    </div>  
                                    <br/>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</script>                     
@stop