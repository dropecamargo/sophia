<!-- Modal add resource -->
<div class="modal fade" id="modal-add-resource-component" data-backdrop="static" data-keyboard="false" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content" id="content-create-resource-component">
			<div class="modal-header small-box {{ config('koi.template.bg') }}">
				<button type="button" class="close icon-close-koi" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="inner-title-modal modal-title"></h4>
			</div>
			{!! Form::open(['id' => 'form-create-resource-component', 'data-toggle' => 'validator']) !!}
				<div class="modal-body">
					<div id="error-resource-component" class="alert alert-danger"></div>
					<div class="content-modal"></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary btn-sm">Continuar</button>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>

<!-- Modal add tcontacto -->
<div class="modal fade" id="modal-tcontacto-component" data-backdrop="static" data-keyboard="false" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content" id="content-tcontacto-component">
			<div class="modal-header small-box {{ config('koi.template.bg') }}">
				<button type="button" class="close icon-close-koi" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Contactos</h4>
			</div>
			{!! Form::open(['id' => 'form-tcontacto-component', 'data-toggle' => 'validator']) !!}
				<div class="modal-body">
					<div class="content-modal"></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary btn-sm">Continuar</button>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>

<!-- Modal add contrato -->
<div class="modal fade" id="modal-contrato-component" data-backdrop="static" data-keyboard="false" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content" id="content-contrato-component">
			<div class="modal-header small-box {{ config('koi.template.bg') }}">
				<button type="button" class="close icon-close-koi" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Contratos</h4>
			</div>
			{!! Form::open(['id' => 'form-contrato-component', 'data-toggle' => 'validator']) !!}
				<div class="modal-body">
					<div class="content-modal"></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary btn-sm">Continuar</button>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>

<!-- Modal search -->
<div class="modal fade" id="modal-search-component" data-backdrop="static" data-keyboard="false" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="content-modal"></div>
		</div>
	</div>
</div>

<!-- Modal address -->
<div class="modal fade" id="modal-address-component" data-backdrop="static" data-keyboard="false" aria-hidden="true">
	<div class="modal-dialog modal-xlg" role="document">
		<div class="modal-content">
			<div class="content-modal"></div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-address-component-validacion" data-backdrop="static" data-keyboard="false" aria-hidden="true">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="content-modal"></div>
		</div>
	</div>
</div>

<!-- Modal search contacto -->
<div class="modal fade" id="modal-search-contacto-component" data-backdrop="static" data-keyboard="false" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="content-modal"></div>
		</div>
	</div>
</div>

<!-- Modal search modelo -->
<div class="modal fade" id="modal-search-modelo-component" data-backdrop="static" data-keyboard="false" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="content-modal"></div>
		</div>
	</div>
</div>

<!-- Modal search contrato -->
<div class="modal fade" id="modal-search-contrato-component" data-backdrop="static" data-keyboard="false" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="content-modal"></div>
		</div>
	</div>
</div>

<!-- Modal search producto -->
<div class="modal fade" id="modal-search-producto-component" data-backdrop="static" data-keyboard="false" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="content-modal"></div>
		</div>
	</div>
</div>

<!-- Tpls modals-->
<script type="text/template" id="koi-search-tercero-component-tpl">
	<div class="modal-header small-box {{ config('koi.template.bg') }}">
		<button type="button" class="close icon-close-koi" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		<h4 class="modal-title">Buscador de terceros</h4>
	</div>
	{!! Form::open(['id' => 'form-koi-search-tercero-component', 'class' => 'form-horizontal', 'data-toggle' => 'validator', 'role' => 'form']) !!}
		<div class="modal-body">
			<div class="form-group">
				<label for="koi_search_tercero_nit" class="col-md-1 control-label">Documento</label>
				<div class="col-md-2">
					{!! Form::text('koi_search_tercero_nit', null, ['id' => 'koi_search_tercero_nit', 'class' => 'form-control input-sm']) !!}
				</div>

				<label for="koi_search_tercero_nombre" class="col-md-1 control-label">Nombre</label>
				<div class="col-md-8">
					{!! Form::text('koi_search_tercero_nombre', null, ['id' => 'koi_search_tercero_nombre', 'class' => 'form-control input-sm input-toupper']) !!}
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-offset-4 col-md-2 col-xs-6">
					<button type="button" class="btn btn-primary btn-block btn-sm btn-search-koi-search-tercero-component">Buscar</button>
				</div>
				<div class="col-md-2 col-xs-6">
					<button type="button" class="btn btn-default btn-block btn-sm btn-clear-koi-search-tercero-component">Limpiar</button>
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-12 table-responsive">
					<table id="koi-search-tercero-component-table" class="table table-bordered table-striped" cellspacing="0" width="100%">
		                <thead>
		                    <tr>
				                <th>Documento</th>
				                <th>Nombre</th>
				                <th>Razon Social</th>
				                <th>Nombre1</th>
				                <th>Nombre2</th>
				                <th>Apellido1</th>
				                <th>Apellido2</th>
		                    </tr>
		                </thead>
		            </table>
	           	</div>
	     	</div>
		</div>
	{!! Form::close() !!}
</script>

<script type="text/template" id="koi-search-producto-component-tpl">
	<div class="modal-header small-box {{ config('koi.template.bg') }}">
		<button type="button" class="close icon-close-koi" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		<h4 class="modal-title">Buscador de productos</h4>
	</div>
	{!! Form::open(['id' => 'form-koi-search-producto-component', 'class' => 'form-horizontal', 'data-toggle' => 'validator', 'role' => 'form']) !!}
		<div class="modal-body">
			<div class="form-group">
				<label for="koi_search_producto_serie" class="col-md-1 control-label">Serie</label>
				<div class="col-md-2">
					{!! Form::text('koi_search_producto_serie', null, ['id' => 'koi_search_producto_serie', 'class' => 'form-control input-sm', 'placeholder' => 'Serie']) !!}
				</div>

				<label for="koi_search_producto_nombre" class="col-md-1 control-label">Nombre</label>
				<div class="col-md-8">
					{!! Form::text('koi_search_producto_nombre', null, ['id' => 'koi_search_producto_nombre', 'class' => 'form-control input-sm input-toupper', 'placeholder' => 'Nombre']) !!}
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-offset-4 col-md-2 col-xs-6">
					<button type="button" class="btn btn-primary btn-block btn-sm btn-search-koi-search-producto-component">Buscar</button>
				</div>
				<div class="col-md-2 col-xs-6">
					<button type="button" class="btn btn-default btn-block btn-sm btn-clear-koi-search-producto-component">Limpiar</button>
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-12 table-responsive">
					<table id="koi-search-producto-component-table" class="table table-bordered table-striped" cellspacing="0" width="100%">
		                <thead>
				            <tr>	
				                <th>Serie</th>
				                <th>Referencia</th>
				            	<th>Placa</th>
			                	<th>Nombre</th>
			                	<th>Tipo</th>
			                	<th>Codigo tipo</th>
				            </tr>
				        </thead>
		            </table>
	           	</div>
	     	</div>
		</div>
	{!! Form::close() !!}
</script>

<script type="text/template" id="koi-search-producto-type-component-tpl">
	<div class="row">
    	<label for="producto_tipo_search" class="col-md-1 col-md-offset-1 control-label">Sirve a equipo</label>
        <div class="form-group col-sm-2 col-md-2">
            <div class="input-group input-group-sm">
                <span class="input-group-btn">
                    <button type="button" class="btn btn-default btn-flat btn-koi-search-producto-component" data-field="producto_tipo_search">
                        <i class="fa fa-barcode"></i>
                    </button>
                </span>
                <input id="producto_tercero" name="producto_tercero" type="hidden">
                <input id="producto_contrato" name="producto_contrato" type="hidden">
                <input id="producto_tipo_search" placeholder="Serie" class="form-control producto-koi-component" name="producto_tipo_search" type="text" maxlength="15" data-wrapper="producto_create" data-name="producto_nombre_search" data-tipo="EQ" data-asignaciones="true" required>
            </div>
        </div>
        <div class="col-sm-5 col-xs-10">
            <input id="producto_nombre_search" name="producto_nombre_search" placeholder="Nombre producto" class="form-control input-sm" type="text" readonly required>
        </div>
    </div>
</script>

<script type="text/template" id="koi-search-contacto-component-tpl">
	<div class="modal-header small-box {{ config('koi.template.bg') }}">
		<button type="button" class="close icon-close-koi" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		<h4 class="modal-title">Buscador de contactos</h4>
	</div>

	{!! Form::open(['id' => 'form-koi-search-contacto-component', 'class' => 'form-horizontal', 'data-toggle' => 'validator', 'role' => 'form']) !!}
		<div class="modal-body">
			<div class="form-group">
				<label for="koi_search_contacto_nombres" class="col-md-1 control-label">Nombres</label>
				<div class="col-md-5">
					{!! Form::text('koi_search_contacto_nombres', null, ['id' => 'koi_search_contacto_nombres', 'class' => 'form-control input-sm input-toupper']) !!}
				</div>
				<label for="koi_search_contacto_apellidos" class="col-md-1 control-label">Apellidos</label>
				<div class="col-md-5">
					{!! Form::text('koi_search_contacto_apellidos', null, ['id' => 'koi_search_contacto_apellidos', 'class' => 'form-control input-sm input-toupper']) !!}
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-offset-4 col-md-2 col-xs-6">
					<button type="button" class="btn btn-primary btn-block btn-sm btn-search-koi-search-contacto-component">Buscar</button>
				</div>
				<div class="col-md-2 col-xs-6">
					<button type="button" class="btn btn-default btn-block btn-sm btn-clear-koi-search-contacto-component">Limpiar</button>
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-12 table-responsive">
					<table id="koi-search-contacto-component-table" class="table table-bordered table-striped" cellspacing="0" width="100%">
		                <thead>
				            <tr>
				            	<th>Id</th>
			                	<th>Nombres</th>
			                	<th>Apellidos</th>
				                <th>Nombre</th>
				                <th>Teléfono</th>
				                <th>Municipio</th>
				                <th>Dirección</th>
				            </tr>
				        </thead>
		            </table>
	           	</div>
	     	</div>
		</div>
	{!! Form::close() !!}
</script>


<script type="text/template" id="koi-search-contrato-component-tpl">
	<div class="modal-header small-box {{ config('koi.template.bg') }}">
		<button type="button" class="close icon-close-koi" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		<h4 class="modal-title">Buscador de contratos</h4>
	</div>

	{!! Form::open(['id' => 'form-koi-search-contrato-component', 'class' => 'form-horizontal', 'data-toggle' => 'validator', 'role' => 'form']) !!}
		<div class="modal-body">
			<div class="form-group">
				<label for="koi_search_contrato_numero" class="col-md-1 control-label">Numero</label>
				<div class="col-md-3">
					{!! Form::text('koi_search_contrato_numero', null, ['id' => 'koi_search_contrato_numero', 'class' => 'form-control input-sm input-toupper']) !!}
				</div>
			
				<div class="col-md-offset-4 col-md-2 col-xs-6">
					<button type="button" class="btn btn-primary btn-block btn-sm btn-search-koi-search-contrato-component">Buscar</button>
				</div>
				<div class="col-md-2 col-xs-6">
					<button type="button" class="btn btn-default btn-block btn-sm btn-clear-koi-search-contrato-component">Limpiar</button>
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-12 table-responsive">
					<table id="koi-search-contrato-component-table" class="table table-bordered table-striped" cellspacing="0" width="100%">
		                <thead>
				            <tr>
				            	<th>Id</th>
			                	<th>Numero</th>
			                	<th>Tercero</th>
				                <th>F. Inicio</th>
				                <th>F. Vencimiento</th>
				                <th>Activo</th>
				                <th>Condiciones</th>
				            </tr>
				        </thead>
		            </table>
	           	</div>
	     	</div>
		</div>
	{!! Form::close() !!}
</script>

<script type="text/template" id="koi-address-component-tpl">
	<div class="modal-header small-box {{ config('koi.template.bg') }}">
		<button type="button" class="close icon-close-koi" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		<h4 class="modal-title">Generador de direcciones</h4>
	</div>
	{!! Form::open(['id' => 'form-address-component', 'data-toggle' => 'validator', 'role' => 'form']) !!}
	<div class="modal-body koi-component-address-modal-body">
		<div class="row">
			<div class="col-md-offset-2">
				<label for="koi_direccion" class="col-md-1 control-label">Direccion</label>
				<div class="form-group col-md-8">
					{!! Form::text('koi_direccion', null, ['id' => 'koi_direccion', 'class' => 'form-control input-sm','disabled']) !!}
				</div>
			</div>
		</div>

		<div class="row">
			<div class="form-group col-md-12 col-sm-12 col-xs-12">
				@foreach(config('koi.direcciones.nomenclatura') as $key => $value)
					<div class="col-md-2 col-sm-4 col-xs-6 koi-component-add address-nomenclatura">
						<a class="btn btn-default btn-block" data-key="{{$key}}">{{ $value }}</a>
					</div>
				@endforeach
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<ul class="list-inline address-digitos">
					<!-- Leters -->
					@foreach(config('koi.direcciones.alfabeto') as $key => $value)
						<li>
							<a class="btn btn-default btn-block koi-component-add" data-key="{{$key}}">{{ $value }}</a>
						</li>
					@endforeach

					<!-- Numbers -->
					@for($i=0; $i<=9; $i++)
						<li>
							<a class="btn btn-default btn-block koi-component-add">{{ $i }}</a>
						</li>
					@endfor
				</ul>
			</div>
		</div>

		<div class="row other-controls ">
			<label for="koi_direccion" class="col-md-2 col-xs-12 control-label text-right">Dirección DIAN</label>
			<div class="col-md-6">
				{!! Form::text('koi_direccion_nm', null, ['id' => 'koi_direccion_nm', 'class' => 'form-control input-sm','disabled']) !!}
			</div>
			<div class="col-md-2 koi-component-remove-last">
				<a class="btn btn-default btn-block"><i class="fa fa-backward"> Regresar</i></a>
			</div>
			<div class="col-md-2 koi-component-remove">
				<a class="btn btn-default btn-block"><i class="fa fa-trash-o"> Limpiar</i></a>
			</div>
		</div>
	</div>

	<div class="modal-footer">
		<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancelar</button>
		<button type="submit" class="btn btn-primary btn-sm btn-address-component-add-address">Continuar</button>
	</div>
	{!! Form::close() !!}
</script>

<script type="text/template" id="koi-component-select-tpl">
	<div class="modal-header">
		<h4 class="modal-title"></h4>
	</div>
	<div class="modal-body">
		<div class="row">
			<div class="form-group col-md-12">
			<label class="col-md-2 col-xs-12 control-label">Nombre</label>
				<div class="col-md-5">
				    <select name="component-select" id="component-select" class="form-control" required>
	                    <option value="" selected>Seleccione</option>
	                    <option value="si">Si</option>
	                    <option value="no">No</option>
	                </select>
				</div>
				<div class="col-md-5" id="component-input" hidden>
					<input type="text" class="form-control input-sm" name="component-input-text" id="component-input-text">
				</div>
			</div>
		</div>
	</div>
</script>

<script type="text/template" id="koi-search-modelo-component-tpl">
	<div class="modal-header small-box {{ config('koi.template.bg') }}">
		<button type="button" class="close icon-close-koi" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		<h4 class="modal-title">Buscador de modelos</h4>
	</div>
	{!! Form::open(['id' => 'form-koi-search-modelo-component', 'class' => 'form-horizontal', 'data-toggle' => 'validator', 'role' => 'form']) !!}
		<div class="modal-body">
			<div class="form-group">
				<label for="koi_search_modelo" class="col-md-1 control-label">Modelo</label>
				<div class="col-md-5">
					{!! Form::text('koi_search_modelo', null, ['id' => 'koi_search_modelo', 'class' => 'form-control input-sm input-toupper']) !!}
				</div>
				<label for="koi_search_referencia" class="col-md-1 control-label">Referencia</label>
				<div class="col-md-5">
					{!! Form::text('koi_search_referencia', null, ['id' => 'koi_search_referencia', 'class' => 'form-control input-sm input-toupper']) !!}
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-offset-4 col-md-2 col-xs-6">
					<button type="button" class="btn btn-primary btn-block btn-sm btn-search-koi-search-modelo-component">Buscar</button>
				</div>
				<div class="col-md-2 col-xs-6">
					<button type="button" class="btn btn-default btn-block btn-sm btn-clear-koi-search-modelo-component">Limpiar</button>
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-12 table-responsive">
					<table id="koi-search-modelo-component-table" class="table table-bordered table-striped" cellspacing="0" width="100%">
		                <thead>
				            <tr>
			                	<th>Modelo</th>
			                	<th>Referencia producto</th>
				            </tr>
				        </thead>
		            </table>
	           	</div>
	     	</div>
		</div>
	{!! Form::close() !!}
</script>