@extends('layout.layout')

@section('title') Tipo de Orden @stop

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
                <div class="nav-tabs-custom tab-success tab-whithout-box-shadow">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_contrato" data-toggle="tab">Contrato</a></li>
                        {{--<% if( typeof(id) !== 'undefined' && !_.isUndefined(id) && !_.isNull(id) && id != '') { %>
                            <li><a href="#tab_despachos" data-toggle="tab">Distribución por clientes</a></li>
                        <% } %> --}}
                    </ul>

                    <div class="tab-content">
                        {{-- Content contrato --}}
                        <div class="tab-pane active" id="tab_orden">
                            <div class="box box-whithout-border">
                                <div class="box-body">
                                    <form method="POST" accept-charset="UTF-8" id="form-contratos" data-toggle="validator">
                                        <div class="row">
                                            {{--<% if( typeof(contrato_codigo) !== 'undefined' && !_.isUndefined(contrato_codigo) && !_.isNull(contrato_codigo) && contrato_codigo != '') { %>
                                                <label class="col-sm-1 control-label">Código</label>
                                                <div class="form-group col-md-1">
                                                    <%- contrato_codigo %>
                                                </div>
                                            <% } %>--}}

                                            <label for="contrato_numero" class="col-sm-1 control-label">Número De Contrato</label>
                                            <div class="form-group col-md-8">
                                                <input id="contrato_numero" value="<%- contrato_numero %>" placeholder="numero" class="form-control input-sm input-toupper" name="contrato_numero" type="text" maxlength="200" required>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <label for="contrato_fecha" class="col-sm-1 control-label">F. Inicio</label>
                                            <div class="form-group col-md-2">
                                                <input type="text" id="contrato_fecha" name="contrato_fecha" placeholder="Fecha inicio" class="form-control input-sm datepicker" value="<%- contrato_fecha %>" required>
                                            </div>

                                            <label for="contrato_vencimiento" class="col-sm-1 control-label">F. Vencimiento</label>
                                            <div class="form-group col-md-2">
                                                <input type="text" id="contrato_vencimiento" name="contrato_vencimiento" placeholder="Fecha entrega" class="form-control input-sm datepicker" value="<%- contrato_vencimiento %>" required>
                                            </div>
                                            
                                        </div>
                                        
                                        <div class="row">
                                            <label for="contrato_condiciones" class="col-sm-1 control-label">Condiciones Contrato</label>
                                            <div class="form-group col-md-2">
                                                <textarea id="contrato_condiciones" name="contrato_condiciones" class="form-control" rows="2" placeholder="Condiciones COntrato"><%- contrato_condiciones %></textarea>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <label for="orden_cliente" class="col-sm-1 control-label">Cliente</label>
                                            <div class="form-group col-sm-3">
                                                <div class="input-group input-group-sm">
                                                    <span class="input-group-btn">
                                                        <button type="button" class="btn btn-default btn-flat btn-koi-search-tercero-component-table" data-field="orden_cliente">
                                                            <i class="fa fa-user"></i>
                                                        </button>
                                                    </span>
                                                    <input id="orden_cliente" placeholder="Cliente" class="form-control tercero-koi-component" name="orden_cliente" type="text" maxlength="15" data-wrapper="crontatos-create" data-name="orden_cliente_nombre" data-contacto="btn-add-contact" value="<%- tercero_nit %>" required>
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
                                        </div>

                                        <div class="row">
                                            <label for="tcontacto_nombre" class="col-sm-1 control-label">Contacto</label>
                                            <div class="form-group col-sm-5 col-xs-10">
                                                <div class="input-group input-group-sm">
                                                    <span class="input-group-btn">
                                                        <button type="button" class="btn btn-default btn-flat btn-koi-search-contacto-component-table" data-field="orden_contacto" data-name="tcontacto_nombre" data-phone="tcontacto_telefono" data-tercero="btn-add-contact">
                                                            <i class="fa fa-address-book"></i>
                                                        </button>
                                                    </span>
                                                    <input id="orden_contacto" name="orden_contacto" type="hidden" value="<%- orden_contacto %>">
                                                    <input id="tcontacto_nombre" placeholder="Contacto" class="form-control" name="tcontacto_nombre" type="text" value="<%- tcontacto_nombre %>" readonly required>
                                                </div>
                                            </div>
                                            <div class="col-sm-1 col-xs-2">
                                                <button type="button" id="btn-add-contact" class="btn btn-default btn-flat btn-sm btn-add-resource-koi-component" data-resource="contacto" data-field="orden_contacto" data-name="tcontacto_nombre" data-tercero="<%- orden_cliente %>" data-phone="tcontacto_telefono">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>

                                            <label for="tcontacto_telefono" class="col-sm-1 control-label">Teléfono</label>
                                            <div class="form-group col-md-3">
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-phone"></i>
                                                    </div>
                                                    <input id="tcontacto_telefono" class="form-control input-sm" name="tcontacto_telefono" type="text" data-inputmask="'mask': '(999) 999-99-99'" data-mask value="<%- tcontacto_telefono %>" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <label for="orden_suministran" class="col-sm-1 control-label">Suministran</label>
                                            <div class="form-group col-sm-7">
                                                <input id="orden_suministran" placeholder="Suministran" class="form-control" name="orden_suministran" type="text" value="<%- orden_suministran %>" required maxlength="200">
                                            </div>

                                            <label for="orden_formapago" class="col-sm-1 control-label">Forma pago</label>
                                            <div class="form-group col-md-2">
                                                <select name="orden_formapago" id="orden_formapago" class="form-control" required>
                                                    @foreach( config('koi.produccion.formaspago') as $key => $value)
                                                        <option value="{{ $key }}" <%- orden_formapago == '{{ $key }}' ? 'selected': ''%> >{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <label for="orden_observaciones" class="col-sm-1 control-label">Detalle</label>
                                            <div class="form-group col-sm-10">
                                                <textarea id="orden_observaciones" name="orden_observaciones" class="form-control" rows="2" placeholder="Detalle"><%- orden_observaciones %></textarea>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <label for="orden_terminado" class="col-sm-1 control-label">Terminado</label>
                                            <div class="form-group col-sm-10">
                                                <textarea id="orden_terminado" name="orden_terminado" class="form-control" rows="2" placeholder="Terminado"><%- orden_terminado %></textarea>
                                            </div>
                                        </div>
                                    </form>

                                    <div class="row">
                                        <div class="col-md-2 col-md-offset-4 col-sm-6 col-xs-6">
                                            <a href="{{ route('contratos.index') }}" class="btn btn-default btn-sm btn-block">{{ trans('app.cancel') }}</a>
                                        </div>
                                        <div class="col-md-2 col-sm-6 col-xs-6">
                                            <button type="button" class="btn btn-primary btn-sm btn-block submit-ordenp">{{ trans('app.save') }}</button>
                                        </div>
                                    </div>
                                    <br />

                                 </div>
                            </div>
                        </div>

                      
@stop