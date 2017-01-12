{{-- Js templates --}}
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