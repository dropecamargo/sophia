{{-- Js templates --}}


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