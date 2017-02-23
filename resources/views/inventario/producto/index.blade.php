@extends('inventario.producto.main')

@section('breadcrumb')
    <li class="active">Productos</li>
@stop

@section('module')
	<div id="productos-main">
        <div class="box box-danger">
            <div class="box-body table-responsive">
                {!! Form::open(['id' => 'form-koi-search-producto-component', 'class' => 'form-horizontal', 'data-toggle' => 'validator', 'role' => 'form']) !!}
                    <div class="form-group">
                        <label for="producto_serie" class="col-md-1 control-label">Serie</label>
                        <div class="col-md-2">
                            {!! Form::text('producto_serie',session('search_producto_serie'), ['id' => 'producto_serie', 'class' => 'form-control input-sm']) !!}
                        </div>

                        <label for="producto_nombre" class="col-md-1 control-label">Nombre</label>
                        <div class="col-md-5">
                            {!! Form::text('producto_nombre',session('search_producto_nombre'), ['id' => 'producto_nombre', 'class' => 'form-control input-sm input-toupper' ]) !!}
                        </div>

                        <label for="searchproducto_tipo" class="col-sm-1 control-label">Tipo</label>
                   
                            <div class="col-md-2">
                                <select name="searchproducto_tipo" id="searchproducto_tipo" class="form-control">
                                    <option value="" selected>Todas</option>
                                    <option value="RP" {{ session('searchproducto_tipo') == 'RP' ? 'selected': '' }}>Repuesto</option>
                                    <option value="CO" {{ session('searchproducto_tipo') == 'CO' ? 'selected': '' }}>Consumible</option>
                                    <option value="AC" {{ session('searchproducto_tipo') == 'AC' ? 'selected': '' }}>Accesorio</option>
                                    <option value="EQ" {{ session('searchproducto_tipo') == 'EQ' ? 'selected': '' }}>Equipo</option>
                                    <option value="IN" {{ session('searchproducto_tipo') == 'IN' ? 'selected': '' }}>Insumo</option>
                                </select>
                            </div>
                        
                    </div>

                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-2 col-xs-4">
                            <button type="button" class="btn btn-default btn-block btn-sm btn-clear">Limpiar</button>
                        </div>
                        <div class="col-md-2 col-xs-4">
                            <button type="button" class="btn btn-primary btn-block btn-sm btn-search">Buscar</button>
                        </div>
                        <div class="col-md-2 col-xs-4">
                            <a href="{{ route('productos.create') }}" class="btn btn-default btn-block btn-sm">
                                <i class="fa fa-plus"></i> Nuevo
                            </a>
                        </div>
                    </div>
                {!! Form::close() !!}

                <table id="productos-search-table" class="table table-bordered table-striped" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Placa</th>
                            <th>Serie</th>
                            <th>Nombre del producto</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@stop