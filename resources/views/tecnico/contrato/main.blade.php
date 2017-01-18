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
                                                <textarea id="contrato_condiciones" name="contrato_condiciones" class="form-control" rows="2" placeholder="Condiciones Contrato"><%- contrato_condiciones %></textarea>
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