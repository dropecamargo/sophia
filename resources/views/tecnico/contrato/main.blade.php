@extends('layout.layout')

@section('title') Contrato @stop

@section('content')
<section class="content-header">
    <h1>
        Contrato<small>Administración de Contratos</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i>{{ trans('app.home') }}</a></li>
        @yield('breadcrumb')
    </ol>
</section>

<section class="content">
    @yield ('module')
</section>

<script type="text/template" id="add-contrato-tpl">
    <div class="box-body">
        <form method="POST" accept-charset="UTF-8" id="form-contrato" data-toggle="validator">
            <div class="row">
                <div class="form-group col-md-2">
                    <label for="contrato_numero" class="control-label">Número</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-paper-plane"></i>
                        </div>
                        <input id="contrato_numero" value="<%- contrato_numero %>" placeholder="Número Contrato" class="form-control  input-sm input-toupper" name="contrato_numero" type="text" maxlength="10" required>
                    </div>                                        
                </div>
                <div class="form-group col-md-3">
                    <label for="contrato_fecha" class="control-label">F. Inicio</label>
                    <input type="text" id="contrato_fecha" name="contrato_fecha" placeholder="Fecha inicio" class="form-control input-sm datepicker" value="<%- contrato_fecha %>" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="contrato_vencimiento" class="control-label">F. Vencimiento</label>
                    <input type="text" id="contrato_vencimiento" name="contrato_vencimiento" placeholder="Fecha entrega" class="form-control input-sm datepicker" value="<%- contrato_vencimiento %>" required>
                </div>     
            </div>

            <div class="row">
                <div class="form-group col-md-8">
                    <label for="contrato_condiciones" class="control-label">Condiciones</label>
                    <textarea id="contrato_condiciones" name="contrato_condiciones" class="form-control" rows="2" placeholder="Condiciones Contrato"><%- contrato_condiciones %></textarea>
                </div>
            </div> 
              
            <div class="row">
                <div class="form-group col-md-2">
                    <label for="contrato_tercero" class="control-label">Cliente</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default btn-flat btn-koi-search-tercero-component-table" data-field="contrato_tercero">
                                <i class="fa fa-user"></i>
                            </button>
                        </span>
                        <input id="contrato_tercero" placeholder="Cliente" class="form-control tercero-koi-component" name="contrato_tercero" type="text" maxlength="15" data-wrapper="contratos-create" data-name="contrato_terecero_nombre" data-contacto="btn-add-contact" value="<%- tercero_nit %>" required>
                    </div>
                </div>
                <div class="col-sm-5 col-xs-10">
                    <br>
                    <input id="contrato_terecero_nombre" name="contrato_terecero_nombre" placeholder="Nombre cliente" class="form-control input-sm" type="text" maxlength="15" value="<%- tercero_nombre %>" readonly required>
                </div>
            
                <br>
                <label class="checkbox-inline control-label col-sm-2" for="contrato_activo" >
                <input type="checkbox" id="contrato_activo" name="contrato_activo" value="contrato_activo" <%- contrato_activo ? 'checked': ''%>> <b>Activo</b></label>
            </div> 

            <div class="box-footer with-border">
                <div class="row">
                    <div class="col-md-2 col-md-offset-4 col-sm-6 col-xs-6">
                        <a href="{{ route('contratos.index') }}" class="btn btn-default btn-sm btn-block">{{ trans('app.cancel') }}</a>
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-6">
                        <button type="submit" class="btn btn-primary btn-sm btn-block">{{ trans('app.save') }}</button>
                    </div>
                </div>    
            </div>
        </form>
    </div>

    <% if( typeof(id) !== 'undefined' && !_.isUndefined(id) && !_.isNull(id) && id != '') { %> 
        <div class="row">
            <div class="form-group col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                         <li class="active"><a href="#tab_danos" data-toggle="tab">Daños</a></li>            
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_danos">
                            <div class="box box-danger" id="wrapper-danos-contrato">
                                <div class="box-body">
                                    <form method="POST" accept-charset="UTF-8" id="form-danoc" data-toggle="validator">
                                        <div class="row">
                                            <label for="contratodano_dano" class="control-label col-sm-1 hidden-xs">Nombre</label>
                                            <div class="form-group col-sm-6 col-xs-10">
                                                <select name="contratodano_dano" id="contratodano_dano" class="form-control select2-default" required>
                                                   @foreach( App\Models\Tecnico\Dano::getDanos() as $key => $value)
                                                       <option value="{{ $key }}">{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <label for="contratodano_tiempo" class="control-label col-sm-1 col-sm-offset hidden-xs">Tiempo</label>
                                            <div class="form-group col-sm-1">
                                            <input id="contratodano_tiempo" name="contratodano_tiempo" class="form-control input-sm" type="number" required="" min="1   ">
                                            </div>
                                            <div class="form-group col-sm-1 col-xs-2 text-right">
                                                <button type="button" class="btn btn-default btn-flat btn-sm btn-add-resource-koi-component" data-resource="dano" data-field="contratodano_dano">
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
                                        <table id="browse-contratos-danos-list" class="table table-hover table-bordered" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th width="5px"></th>
                                                    
                                                    <th width="90px">Nombre</th>
                                                    <th width="5px">Tiempo</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- Render content dano --}}
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
    <% } %>     
</script>   

<script type="text/template" id="contrato-item-list-tpl">
        <% if(edit) { %>
        <td class="text-center">
            <a class="btn btn-default btn-xs item-contratodano-remove" data-resource="<%- id %>">
                <span><i class="fa fa-times"></i></span>
            </a>
        </td>
        <% } %>
        <td><%- dano_nombre %></td>
        <td><%- contratodano_tiempo %> hr(s)</td>
        < 
</script>                  
@stop