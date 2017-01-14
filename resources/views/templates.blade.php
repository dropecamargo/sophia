{{-- Js templates --}}

{{--template Sucursal--}}
<script type="text/template" id="add-sucursal-tpl">
    <div class="row">
		<div class="form-group col-md-8">
			<label for="sucursal_nombre" class="control-label">Nombre</label>
			<input type="text" id="sucursal_nombre" name="sucursal_nombre" value="<%- sucursal_nombre %>" placeholder="Nombre" class="form-control input-sm input-toupper" maxlength="100" required>
		</div>
		<div class="form-group col-md-8">
			<label for="sucursal_direccion" class="control-label">Direccion</label>
			<input type="text" id="sucursal_direccion" name="sucursal_direccion" value="<%- sucursal_direccion %>" placeholder="Direccion" class="form-control input-sm input-toupper" maxlength="100" required>
		</div>
	</div>
</script>

{{-- templeates Administrado --}}

<script type="text/template" id="add-estado-tpl">
	<div class="row">
		<div class="form-group col-md-8">
			<label for="estado_nombre" class="control-label">Nombre</label>
			<input type="text" id="estado_nombre" name="estado_nombre" value="<%- estado_nombre %>" placeholder="Estado" class="form-control input-sm input-toupper" maxlength="200" required>
		</div>

		<div class="form-group col-md-2 col-xs-8 col-sm-3">
			<br><label class="checkbox-inline" for="estado_activo">
				<input type="checkbox" id="estado_activo" name="estado_activo" value="estado_activo" <%- estado_activo ? 'checked': ''%>> Activo
			</label>

		</div>
    </div>
</script>

{{-- templeates Tecnicos --}}
<script type="text/template" id="add-marca-tpl">
	<div class="row">
		<div class="form-group col-md-8">
			<label for="marca_modelo" class="control-label">Nombre</label>
			<input type="text" id="marca_modelo" name="marca_modelo" value="<%- marca_modelo %>" placeholder="Marca" class="form-control input-sm input-toupper" maxlength="200" required>
		</div>

		<div class="form-group col-md-2 col-xs-8 col-sm-3">
			<br><label class="checkbox-inline" for="marca_activo">
				<input type="checkbox" id="marca_activo" name="marca_activo" value="marca_activo" <%- marca_activo ? 'checked': ''%>> Activo
			</label>
		</div>
    </div>
</script>

<script type="text/template" id="add-modelo-tpl">
	<div class="row">
		<div class="form-group col-md-8">
			<label for="modelo_nombre" class="control-label">Nombre</label>
			<input type="text" id="modelo_nombre" name="modelo_nombre" value="<%- modelo_nombre %>" placeholder="Modelo" class="form-control input-sm input-toupper" maxlength="200" required>
		</div>
		<div class="form-group col-md-2 col-xs-8 col-sm-3">
			<br><label class="checkbox-inline" for="modelo_activo">
				<input type="checkbox" id="modelo_activo" name="modelo_activo" value="modelo_activo" <%- modelo_activo ? 'checked': ''%>> Activo
			</label>
		</div>
	</div>
</script>


<script type="text/template" id="add-actividad-tpl">
    <div class="row">
		<div class="form-group col-md-2">
			<label for="actividad_codigo" class="control-label">Código</label>
			<input type="text" id="actividad_codigo" name="actividad_codigo" value="<%- actividad_codigo %>" placeholder="Código" class="form-control input-sm input-toupper" maxlength="11" required>
		</div>
		<div class="form-group col-md-8">
			<label for="actividad_nombre" class="control-label">Nombre</label>
			<input type="text" id="actividad_nombre" name="actividad_nombre" value="<%- actividad_nombre %>" placeholder="Nombre" class="form-control input-sm input-toupper" required>
		</div>
    </div>
    <div class="row">
		<div class="form-group col-md-2">
			<label for="actividad_tarifa" class="control-label">% Cree</label>
			<input type="text" id="actividad_tarifa" name="actividad_tarifa" value="<%- actividad_tarifa %>" placeholder="% Cree" class="form-control input-sm spinner-percentage" maxlength="4" required>
		</div>
    	<div class="form-group col-md-2">
			<label for="actividad_categoria" class="control-label">Categoria</label>
			<input type="text" id="actividad_categoria" name="actividad_categoria" value="<%- actividad_categoria %>" placeholder="Categoria" class="form-control input-sm input-toupper" maxlength="3">
		</div>
	</div>
</script>

<script type="text/template" id="add-tipo-tpl">
	<div class="row">
		<div class="form-group col-md-1">
			<label for="tipo_codigo" class="control-label">Tipo</label>
			<input type="text" id="tipo_codigo" name="tipo_codigo" value="<%- tipo_codigo %>" placeholder="Tipo" class="form-control input-sm input-toupper" maxlength="2" required>
		</div>

		<div class="form-group col-md-8">
			<label for="tipo_nombre" class="control-label">Nombre</label>
			<input type="text" id="tipo_nombre" name="tipo_nombre" value="<%- tipo_nombre %>" placeholder="Nombre" class="form-control input-sm input-toupper" maxlength="200" required>
		</div>

		<div class="form-group col-md-2 col-xs-8 col-sm-3">
			<br><label class="checkbox-inline" for="tipo_activo">
				<input type="checkbox" id="tipo_activo" name="tipo_activo" value="tipo_activo" <%- tipo_activo ? 'checked': ''%>> Activo
			</label>

		</div>
    </div>
</script>