{{-- Js templates --}}
{{--template Base--}}
<script type="text/template" id="add-contacto-tpl">
    <div class="row">
		<div class="form-group col-md-4">
			<label for="tcontacto_nombres" class="control-label">Nombres</label>
			<input type="text" id="tcontacto_nombres" name="tcontacto_nombres" value="<%- tcontacto_nombres %>" placeholder="Nombres" class="form-control input-sm input-toupper" maxlength="200" required>
		</div>

		<div class="form-group col-md-4">
			<label for="tcontacto_apellidos" class="control-label">Apellidos</label>
			<input type="text" id="tcontacto_apellidos" name="tcontacto_apellidos" value="<%- tcontacto_apellidos %>" placeholder="Apellidos" class="form-control input-sm input-toupper" maxlength="200" required>
		</div>
    </div>

    <div class="row">
    	<div class="form-group col-md-4">
			<label for="tcontacto_direccion" class="control-label">Dirección</label> <small id="tcontacto_dir_nomenclatura"><%- tcontacto_direccion_nomenclatura %></small>
      		<div class="input-group input-group-sm">
  		 		<input type="hidden" id="tcontacto_direccion_nomenclatura" name="tcontacto_direccion_nomenclatura" value="<%- tcontacto_direccion_nomenclatura %>">
				<input id="tcontacto_direccion" value="<%- tcontacto_direccion %>" placeholder="Dirección" class="form-control address-koi-component" name="tcontacto_direccion" type="text" maxlength="200" required data-nm-name="tcontacto_dir_nomenclatura" data-nm-value="tcontacto_direccion_nomenclatura">
				<span class="input-group-btn">
					<button type="button" class="btn btn-default btn-flat btn-address-koi-component" data-field="tcontacto_direccion">
						<i class="fa fa-map-signs"></i>
					</button>
				</span>
			</div>
		</div>

    	<div class="form-group col-md-4">
			<label for="tcontacto_municipio" class="control-label">Municipio</label>
			<select name="tcontacto_municipio" id="tcontacto_municipio" class="form-control select2-default" required>
				@foreach( App\Models\Base\Municipio::getMunicipios() as $key => $value)
					<option value="{{ $key }}" <%- tcontacto_municipio == '{{ $key }}' ? 'selected': ''%> >{{ $value }}</option>
				@endforeach
			</select>
		</div>

		<div class="form-group col-md-4">
			<label for="tcontacto_nombres" class="control-label">Email</label>
			<input id="tcontacto_email" value="<%- tcontacto_email %>" placeholder="Email" class="form-control input-sm" name="tcontacto_email" type="email" maxlength="200">
		    <div class="help-block with-errors"></div>
		</div>
    </div>

    <div class="row">
		<div class="form-group col-md-4">
			<label for="tcontacto_cargo" class="control-label">Cargo</label>
			<input type="text" id="tcontacto_cargo" name="tcontacto_cargo" value="<%- tcontacto_cargo %>" placeholder="Cargos" class="form-control input-sm input-toupper" maxlength="200">
		</div>

		<div class="form-group col-md-4">
			<label for="tcontacto_telefono" class="control-label">Teléfono</label>
			<div class="input-group">
				<div class="input-group-addon">
					<i class="fa fa-phone"></i>
				</div>
				<input id="tcontacto_telefono" value="<%- tcontacto_telefono %>" class="form-control input-sm" name="tcontacto_telefono" type="text" data-inputmask="'mask': '(999) 999-99-99'" data-mask required>
			</div>
		</div>

		<div class="form-group col-md-4">
			<label for="tcontacto_celular" class="control-label">Celular</label>
			<div class="input-group">
				<div class="input-group-addon">
					<i class="fa fa-mobile"></i>
				</div>
				<input id="tcontacto_celular" value="<%- tcontacto_celular %>" class="form-control input-sm" name="tcontacto_celular" type="text" data-inputmask="'mask': '(999) 999-9999'" data-mask>
			</div>
		</div>
	</div>
</script>

<script type="text/template" id="add-tercero-tpl">
	<form method="POST" accept-charset="UTF-8" id="form-tercero" data-toggle="validator">
		<div class="row">
			<div class="form-group col-md-3">
				<label for="tercero_nit" class="control-label">Documento</label>
				<div class="row">
					<div class="col-md-9">
						<input id="tercero_nit" value="<%- tercero_nit %>" placeholder="Nit" class="form-control input-sm change-nit-koi-component" name="tercero_nit" type="text" required data-field="tercero_digito">
					</div>
					<div class="col-md-3">
						<input id="tercero_digito" value="<%- tercero_digito %>" class="form-control input-sm" name="tercero_digito" type="text" readonly required>
					</div>
				</div>
			</div>

			<div class="form-group col-md-3">
				<label for="tercero_tipo" class="control-label">Tipo</label>
				<select name="tercero_tipo" id="tercero_tipo" class="form-control" required>
					<option value="" selected>Seleccione</option>
					@foreach( config('koi.terceros.tipo') as $key => $value)
						<option value="{{ $key }}" <%- tercero_tipo == '{{ $key }}' ? 'selected': ''%> >{{ $value }}</option>
					@endforeach
				</select>
			</div>

			<div class="form-group col-md-3">
				<label for="tercero_persona" class="control-label">Persona</label>
				<select name="tercero_persona" id="tercero_persona" class="form-control" required>
					<option value="" selected>Seleccione</option>
					@foreach( config('koi.terceros.persona') as $key => $value)
						<option value="{{ $key }}" <%- tercero_persona == '{{ $key }}' ? 'selected': ''%> >{{ $value }}</option>
					@endforeach
				</select>
			</div>

			<div class="form-group col-md-3">
				<label for="tercero_regimen" class="control-label">Regimen</label>
				<select name="tercero_regimen" id="tercero_regimen" class="form-control" required>
					<option value="" selected>Seleccione</option>
					@foreach( config('koi.terceros.regimen') as $key => $value)
						<option value="{{ $key }}" <%- tercero_regimen == '{{ $key }}' ? 'selected': ''%> >{{ $value }}</option>
					@endforeach
				</select>
			</div>
		</div>

		<div class="row">
			<div class="form-group col-md-3">
				<label for="tercero_nombre1" class="control-label">1er. Nombre</label>
				<input id="tercero_nombre1" value="<%- tercero_nombre1 %>" placeholder="1er. Nombre" class="form-control input-sm input-toupper" name="tercero_nombre1" type="text">
			</div>

			<div class="form-group col-md-3">
				<label for="tercero_nombre2" class="control-label">2do. Nombre</label>
				<input id="tercero_nombre2" value="<%- tercero_nombre2 %>" placeholder="2do. Nombre" class="form-control input-sm input-toupper" name="tercero_nombre2" type="text">
			</div>

			<div class="form-group col-md-3">
				<label for="tercero_apellido1" class="control-label">1er. Apellido</label>
				<input id="tercero_apellido1" value="<%- tercero_apellido1 %>" placeholder="1er. Apellido" class="form-control input-sm input-toupper" name="tercero_apellido1" type="text">
			</div>

			<div class="form-group col-md-3">
				<label for="tercero_apellido2" class="control-label">2do. Apellido</label>
				<input id="tercero_apellido2" value="<%- tercero_apellido2 %>" placeholder="2do. Apellido" class="form-control input-sm input-toupper" name="tercero_apellido2" type="text">
			</div>
		</div>

		<div class="row">
			<div class="form-group col-md-12">
				<label for="tercero_razonsocial" class="control-label">Razón Social, Comercial o Establecimiento</label>
				<input id="tercero_razonsocial" value="<%- tercero_razonsocial %>" placeholder="Razón Social, Comercial o Establecimiento" class="form-control input-sm input-toupper" name="tercero_razonsocial" type="text">
			</div>
		</div>

		<div class="row">
			<div class="form-group col-md-3">
				<label for="tercero_direccion" class="control-label">Dirección</label> <small id="tercero_nomenclatura"><%- tercero_dir_nomenclatura %></small>
	      		<div class="input-group input-group-sm">
      		 		<input type="hidden" id="tercero_dir_nomenclatura" name="tercero_dir_nomenclatura" value="<%- tercero_dir_nomenclatura %>">
					<input id="tercero_direccion" value="<%- tercero_direccion %>" placeholder="Dirección" class="form-control address-koi-component" name="tercero_direccion" type="text" data-nm-name="tercero_nomenclatura" data-nm-value="tercero_dir_nomenclatura" required>
					<span class="input-group-btn">
						<button type="button" class="btn btn-default btn-flat btn-address-koi-component" data-field="tercero_direccion">
							<i class="fa fa-map-signs"></i>
						</button>
					</span>
				</div>
			</div>

			<div class="form-group col-md-3">
				<label for="tercero_municipio" class="control-label">Municipio</label>
				<select name="tercero_municipio" id="tercero_municipio" class="form-control select2-default" required>
					@foreach( App\Models\Base\Municipio::getMunicipios() as $key => $value)
						<option value="{{ $key }}" <%- tercero_municipio == '{{ $key }}' ? 'selected': ''%> >{{ $value }}</option>
					@endforeach
				</select>
			</div>

			<div class="form-group col-md-3">
				<label for="tercero_email" class="control-label">Email</label>
				<input id="tercero_email" value="<%- tercero_email %>" placeholder="Email" class="form-control input-sm" name="tercero_email" type="email">
			    <div class="help-block with-errors"></div>
			</div>
	    </div>

	    <div class="row">
	    	<div class="form-group col-md-3">
				<label for="tercero_telefono1" class="control-label">Teléfono</label>
				<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-phone"></i>
					</div>
					<input id="tercero_telefono1" value="<%- tercero_telefono1 %>" class="form-control input-sm" name="tercero_telefono1" type="text" data-inputmask="'mask': '(999) 999-99-99'" data-mask>
				</div>
			</div>

			<div class="form-group col-md-3">
				<label for="tercero_telefono2" class="control-label">2do. Teléfono</label>
				<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-phone"></i>
					</div>
					<input id="tercero_telefono2" value="<%- tercero_telefono2 %>" class="form-control input-sm" name="tercero_telefono2" type="text" data-inputmask="'mask': '(999) 999-99-99'" data-mask>
				</div>
			</div>

			<div class="form-group col-md-3">
				<label for="tercero_fax" class="control-label">Fax</label>
				<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-fax"></i>
					</div>
					<input id="tercero_fax" value="<%- tercero_fax %>" class="form-control input-sm" name="tercero_fax" type="text" data-inputmask="'mask': '(999) 999-99-99'" data-mask>
				</div>
			</div>

			<div class="form-group col-md-3">
				<label for="tercero_celular" class="control-label">Celular</label>
				<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-mobile"></i>
					</div>
					<input id="tercero_celular" value="<%- tercero_celular %>" class="form-control input-sm" name="tercero_celular" type="text" data-inputmask="'mask': '(999) 999-9999'" data-mask>
				</div>
			</div>
		</div>

	    <div class="row">
			<div class="form-group col-md-6">
				<label for="tercero_representante" class="control-label">Representante Legal</label>
				<input id="tercero_representante" value="<%- tercero_representante %>" placeholder="Representante Legal" class="form-control input-sm input-toupper" name="tercero_representante" type="text" maxlength="200">
			</div>
			<div class="form-group col-md-3">
	    		<label for="tercero_cc_representante" class="control-label">Cédula</label>
	    		<input id="tercero_cc_representante" value="<%- tercero_cc_representante %>" placeholder="Cédula" class="form-control input-sm" name="tercero_cc_representante" type="text" maxlength="15">
	    	</div>
		</div>

	    <div class="row">
            <div class="col-md-offset-4 col-md-2 col-sm-6 col-xs-6">
                <a href="<%- window.Misc.urlFull( (typeof(id) !== 'undefined' && !_.isUndefined(id) && !_.isNull(id) && id != '') ? Route.route('terceros.show', { terceros: id}) : Route.route('terceros.index') ) %>" class="btn btn-default btn-sm btn-block">{{ trans('app.comeback') }}</a>
            </div>
            <div class="col-md-2 col-sm-6 col-xs-6">
                <button type="submit" class="btn btn-primary btn-sm btn-block">{{ trans('app.save') }}</button>
            </div>
        </div>
	</form>

	<br/>
	<div class="row">
    	<div class="form-group col-md-12">
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#tab_contabilidad" data-toggle="tab">Contabilidad</a></li>
					<% if( !_.isUndefined(tercero_nit) && !_.isNull(tercero_nit) && tercero_nit != ''){ %>
						<li><a id="wrapper-empleados" href="#tab_empleados" data-toggle="tab" class="<%- parseInt(tercero_empleado) || parseInt(tercero_interno) ? '' : 'hide' %>">Empleado</a></li>
						<li><a href="#tab_contactos" data-toggle="tab">Contactos</a></li>
					<% } %>
				</ul>

				<div class="tab-content">
					{{-- Tab contabilidad --}}
					<div class="tab-pane active" id="tab_contabilidad">
						<form method="POST" accept-charset="UTF-8" id="form-accounting" data-toggle="validator">
				    	    <div class="row">
						    	<div class="form-group col-md-10">
						    		<label for="tercero_actividad" class="control-label">Actividad Económica</label>
						    		<select name="tercero_actividad" id="tercero_actividad" class="form-control select2-default change-actividad-koi-component" required data-field="tercero_retecree">
										@foreach( App\Models\Base\Actividad::getActividades() as $key => $value)
											<option value="{{ $key }}" <%- tercero_actividad == '{{ $key }}' ? 'selected': ''%> >{{ $value }}</option>
										@endforeach
									</select>
						    	</div>
						    	<div class="form-group col-md-2">
						    		<label for="tercero_retecree" class="control-label">% Cree</label>
						    		<div id="tercero_retecree"><%- actividad_tarifa %></div>
						    	</div>
						    </div>

						    <div class="row">
						    	<div class="form-group col-md-2">
									<label class="checkbox-inline" for="tercero_cliente">
										<input type="checkbox" id="tercero_cliente" name="tercero_cliente" value="tercero_cliente" <%- parseInt(tercero_cliente) ? 'checked': ''%>> Cliente
									</label>
								</div>
								<div class="form-group col-md-2">
									<label class="checkbox-inline" for="tercero_acreedor">
										<input type="checkbox" id="tercero_acreedor" name="tercero_acreedor" value="tercero_acreedor" <%- parseInt(tercero_acreedor) ? 'checked': ''%>> Acreedor
									</label>
								</div>
								<div class="form-group col-md-2">
									<label class="checkbox-inline" for="tercero_proveedor">
										<input type="checkbox" id="tercero_proveedor" name="tercero_proveedor" value="tercero_proveedor" <%- parseInt(tercero_proveedor) ? 'checked': ''%>> Proveedor
									</label>
								</div>
								<div class="form-group col-md-2">
									<label class="checkbox-inline" for="tercero_autoretenedor_ica">
										<input type="checkbox" id="tercero_autoretenedor_ica" name="tercero_autoretenedor_ica" value="tercero_autoretenedor_ica" <%- parseInt(tercero_autoretenedor_ica) ? 'checked': ''%>> Autorretenedor ICA
									</label>
								</div>
								<div class="form-group col-md-3">
									<label class="checkbox-inline" for="tercero_responsable_iva">
										<input type="checkbox" id="tercero_responsable_iva" name="tercero_responsable_iva" value="tercero_responsable_iva" <%- parseInt(tercero_responsable_iva) ? 'checked': ''%>> Responsable de IVA
									</label>
								</div>
						    </div>

						    <div class="row">
						    	<div class="form-group col-md-2">
							    	<label class="checkbox-inline" for="tercero_empleado">
										<input type="checkbox" id="tercero_empleado" name="tercero_empleado" value="tercero_empleado" <%- parseInt(tercero_empleado) ? 'checked': ''%> class="change_employee"> Empleado
									</label>
								</div>
								<div class="form-group col-md-2">
									<label class="checkbox-inline" for="tercero_interno">
										<input type="checkbox" id="tercero_interno" name="tercero_interno" value="tercero_interno" <%- parseInt(tercero_interno) ? 'checked': ''%> class="change_employee"> Interno
									</label>
								</div>
								<div class="form-group col-md-2">
									<label class="checkbox-inline" for="tercero_extranjero">
										<input type="checkbox" id="tercero_extranjero" name="tercero_extranjero" value="tercero_extranjero" <%- parseInt(tercero_extranjero) ? 'checked': ''%>> Extranjero
									</label>
								</div>
								<div class="form-group col-md-2">
									<label class="checkbox-inline" for="tercero_afiliado">
										<input type="checkbox" id="tercero_afiliado" name="tercero_afiliado" value="tercero_afiliado" <%- parseInt(tercero_afiliado) ? 'checked': ''%>> Afiliado
									</label>
								</div>
								<div class="form-group col-md-3">
									<label class="checkbox-inline" for="tercero_autoretenedor_cree">
										<input type="checkbox" id="tercero_autoretenedor_cree" name="tercero_autoretenedor_cree" value="tercero_autoretenedor_cree" <%- parseInt(tercero_autoretenedor_cree) ? 'checked': ''%>> Autorretenedor CREE
									</label>
								</div>
						    </div>

							<div class="row">
								<div class="form-group col-md-2">
									<label class="checkbox-inline" for="tercero_socio">
										<input type="checkbox" id="tercero_socio" name="tercero_socio" value="tercero_socio" <%- parseInt(tercero_socio) ? 'checked': ''%>> Socio
									</label>
								</div>
								<div class="form-group col-md-2">
									<label class="checkbox-inline" for="tercero_mandatario">
										<input type="checkbox" id="tercero_mandatario" name="tercero_mandatario" value="tercero_mandatario" <%- parseInt(tercero_mandatario) ? 'checked': ''%>> Mandatario
									</label>
								</div>
								<div class="form-group col-md-2">
									<label class="checkbox-inline" for="tercero_gran_contribuyente">
										<input type="checkbox" id="tercero_gran_contribuyente" name="tercero_gran_contribuyente" value="tercero_gran_contribuyente" <%- parseInt(tercero_gran_contribuyente) ? 'checked': ''%>> Gran contribuyente
									</label>
								</div>
								<div class="form-group col-md-2">
									<label class="checkbox-inline" for="tercero_autoretenedor_renta">
										<input type="checkbox" id="tercero_autoretenedor_renta" name="tercero_autoretenedor_renta" value="tercero_autoretenedor_renta" <%- parseInt(tercero_autoretenedor_renta) ? 'checked': ''%>> Autorretenedor renta
									</label>
								</div>
								<div class="form-group col-md-2">
									<label class="checkbox-inline" for="tercero_otro">
										<input type="checkbox" id="tercero_otro" name="tercero_otro" value="tercero_otro" <%- parseInt(tercero_otro) ? 'checked': ''%>> Otro
									</label>
								</div>

								<div class="form-group col-md-2">
									<input id="tercero_cual" value="<%- tercero_cual %>" placeholder="¿Cual?" class="form-control input-sm" name="tercero_cual" type="text" maxlength="15">
								</div>
						    </div>
						</form>
					</div>

					<% if( !_.isUndefined(tercero_nit) && !_.isNull(tercero_nit) && tercero_nit != ''){ %>
						{{-- Tab empleados --}}
						<div class="tab-pane" id="tab_empleados">
							<form method="POST" accept-charset="UTF-8" id="form-employee" data-toggle="validator">
								<div class="row">
							    	<div class="form-group col-md-2">
								    	<label class="checkbox-inline" for="tercero_activo">
											<input type="checkbox" id="tercero_activo" name="tercero_activo" value="tercero_activo" <%- tercero_activo ? 'checked': ''%>> Activo
										</label>
									</div>
							    	<div class="form-group col-md-2">
								    	<label class="checkbox-inline" for="tercero_tecnico">
											<input type="checkbox" id="tercero_tecnico" name="tercero_tecnico" value="tercero_tecnico" <%- tercero_tecnico ? 'checked': ''%>> Técnico
										</label>
									</div>
								</div>

								<div class="row">
									<div class="form-group col-md-2">
								    	<label class="checkbox-inline" for="tercero_coordinador">
											<input type="checkbox" id="tercero_coordinador" name="tercero_coordinador" value="tercero_coordinador" <%- tercero_coordinador ? 'checked': ''%>> Coordinador
										</label>
									</div>

	                               	<div id="wrapper-coordinador" class="form-group col-md-6 <%- parseInt(tercero_tecnico) ? '' : 'hide' %>">
										<label for="tercero_coordinador_por" class="control-label">Coordinado por</label>
										<select name="tercero_coordinador_por" id="tercero_coordinador_por" class="form-control select2-default">
		                                    @foreach( App\Models\Base\Tercero::getTechnicalAdministrators() as $key => $value)
		                                        <option value="{{ $key }}" <%- tercero_coordinador_por == '{{ $key }}' ? 'selected': ''%>>{{ $value }}</option>
		                                    @endforeach
		                                </select>
		                                
		                                <label for="tercero_zona" class="control-label">Zona</label>
										<select name="tercero_zona" id="tercero_zona" class="form-control select2-default">
		                                    @foreach( App\Models\Tecnico\Zona::getZonas() as $key => $value)
		                                        <option value="{{ $key }}" <%- tercero_zona == '{{ $key }}' ? 'selected': ''%>>{{ $value }}</option>
		                                    @endforeach
		                                </select>
			                        </div>
								</div>
							</form>

							<br />
							<div class="row">
								<div class="form-group col-md-6">
					            	<div class="box box-danger" id="wrapper-password">
										<div class="box-header with-border">
											<h3 class="box-title">Datos de acceso</h3>
										</div>
										<div class="box-body">
											<form method="POST" accept-charset="UTF-8" id="form-changed-password" data-toggle="validator">
												<div class="row">
													<div class="form-group col-md-12">
														<label for="username" class="control-label">Cuenta de usuario</label>
														<input type="text" name="username" id="username" class="form-control input-lower" value="<%- username %>" minlength="4" maxlength="20" required>
													</div>
												</div>

												<div class="row">
													<div class="form-group col-md-6">
													<label for="password" class="control-label">Contraseña</label>
														<input type="password" name="password" id="password" class="form-control" minlength="6" maxlength="15">
														<div class="help-block">Minimo de 6 caracteres</div>
													</div>

													<div class="form-group col-md-6">
													<label for="password_confirmation" class="control-label">Verificar contraseña</label>
														<input type="password" name="password_confirmation" id="password_confirmation" class="form-control" data-match="#password" data-match-error="Oops, no coinciden la contraseña" minlength="6" maxlength="15">
														<div class="help-block with-errors"></div>
													</div>
												</div>

												<div class="row">
													<div class="col-md-12 text-center">
														<button type="submit" class="btn btn-success change-pass">Cambiar</button>
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
						    	<div class="form-group col-md-6">
									<div class="box box-danger" id="wrapper-roles">
										<div class="box-header with-border">
											<h3 class="box-title">Roles de usuario</h3>
										</div>
							            <div class="box-body">
						                    <form method="POST" accept-charset="UTF-8" id="form-item-roles" data-toggle="validator">
						                        <div class="row">
						                        	<label for="role_id" class="control-label col-sm-1 col-md-offset-1 hidden-xs">Rol</label>
						                            <div class="form-group col-md-7 col-xs-9">
						                                <select name="role_id" id="role_id" class="form-control select2-default" required>
						                                    @foreach( App\Models\Base\Rol::getRoles() as $key => $value)
						                                        <option value="{{ $key }}">{{ $value }}</option>
						                                    @endforeach
						                                </select>
						                            </div>
						                            <div class="form-group col-md-2 col-xs-3">
						                                <button type="submit" class="btn btn-success btn-sm btn-block">
						                                    <i class="fa fa-plus"></i>
						                                </button>
						                            </div>
						                        </div>
						                    </form>
						                    <!-- table table-bordered table-striped -->
						                    <div class="table-responsive no-padding">
						                        <table id="browse-roles-list" class="table table-hover table-bordered" cellspacing="0">
						                            <thead>
						                                <tr>
						                                    <th width="5%"></th>
						                                    <th width="95%">Nombre</th>
						                                </tr>
						                            </thead>
						                            <tbody>
						                                {{-- Render content roles --}}
						                            </tbody>
						                        </table>
						                    </div>
						                </div>
						            </div>
					            </div>
							</div>
						</div>

						{{-- Tab contactos --}}
						<div class="tab-pane" id="tab_contactos">
						    <div class="row">
								<div class="col-md-offset-4 col-md-4 col-sm-offset-2 col-sm-8 col-xs-12">
									<button type="button" class="btn btn-primary btn-block btn-sm btn-add-tcontacto" data-resource="contacto" data-tercero="<%- id %>">
										<i class="fa fa-user-plus"></i>  Nuevo contacto
									</button>
								</div>
							</div>
							<br />

							<div class="box box-danger">
								<div class="box-body table-responsive no-padding">
									<table id="browse-contact-list" class="table table-hover table-bordered" cellspacing="0" width="100%">
							            <thead>
								            <tr>
								                <th>Nombre</th>
								                <th>Dirección</th>
								                <th>Teléfono</th>
								                <th>Celular</th>
								            </tr>
							           </thead>
							           <tbody>
											{{-- Render contact list --}}
							           </tbody>
									</table>
								</div>
							</div>
						</div>
					<% } %>
				</div>
			</div>
		</div>
	</div>
</script>

<script type="text/template" id="contact-item-list-tpl">
	<td><%- tcontacto_nombres %> <%- tcontacto_apellidos %></td>
	<td><%- tcontacto_direccion %></td>
	<td><%- tcontacto_telefono %></td>
	<td><%- tcontacto_celular %></td>

	<td class="text-center">
		<a class="btn btn-default btn-xs btn-edit-tcontacto" data-resource="<%- id %>">
			<span><i class="fa fa-pencil-square-o"></i></span>
		</a>
	</td>
</script>

{{--template Sucursal--}}
<script type="text/template" id="add-sucursal-tpl">
    <div class="row">
		<div class="form-group col-md-8">
			<label for="sucursal_nombre" class="control-label">Nombre</label>
			<input type="text" id="sucursal_nombre" name="sucursal_nombre" value="<%- sucursal_nombre %>" placeholder="Nombre" class="form-control input-sm input-toupper" maxlength="100" required>
		</div>

		<div class="form-group col-md-4">
			<label for="sucursal_direccion" class="control-label">Dirección</label> <small id="sucursal_dir_nomenclatura"><%- sucursal_direccion_nomenclatura %></small>
      		<div class="input-group input-group-sm">
  		 		<input type="hidden" id="sucursal_direccion_nomenclatura" name="sucursal_direccion_nomenclatura" value="<%- sucursal_direccion_nomenclatura %>">
				<input id="sucursal_direccion" value="<%- sucursal_direccion %>" placeholder="Dirección" class="form-control address-koi-component" name="sucursal_direccion" type="text" maxlength="200" required data-nm-name="sucursal_dir_nomenclatura" data-nm-value="sucursal_direccion_nomenclatura">
				<span class="input-group-btn">
					<button type="button" class="btn btn-default btn-flat btn-address-koi-component" data-field="sucursal_direccion">
						<i class="fa fa-map-signs"></i>
					</button>
				</span>
			</div>
		</div>
	</div>
</script>

{{-- templeates Administrador --}}
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
			<label for="actividad_categoria" class="control-label">Categoria</label>
			<input type="text" id="actividad_categoria" name="actividad_categoria" value="<%- actividad_categoria %>" placeholder="Categoria" class="form-control input-sm input-toupper" maxlength="3">
		</div>
		<div class="form-group col-md-2">
			<label for="actividad_tarifa" class="control-label">% Cree</label><br>
			<input type="text" id="actividad_tarifa" name="actividad_tarifa" value="<%- actividad_tarifa %>" placeholder="% Cree" class="form-control input-sm spinner-percentage" maxlength="4" required>
		</div>
	</div>
</script>

{{-- templeates Inventarios --}}
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

<script type="text/template" id="add-contador-tpl">
	<div class="row">
		<div class="form-group col-md-8">
			<label for="contador_nombre" class="control-label">Nombre</label>
			<input type="text" id="contador_nombre" name="contador_nombre" value="<%- contador_nombre %>" placeholder="Contador" class="form-control input-sm input-toupper" maxlength="100" required>
		</div>

		<div class="form-group col-md-2 col-xs-8 col-sm-3">
			<br><label class="checkbox-inline" for="contador_activo">
				<input type="checkbox" id="contador_activo" name="contador_activo" value="contador_activo" <%- contador_activo ? 'checked': ''%>> Activo
			</label>
		</div>
    </div>
</script>

{{-- templeates Tecnicos --}}
<script type="text/template" id="add-tipoorden-tpl">
	<div class="row">
		<div class="form-group col-md-8">
			<label for="tipoorden_nombre" class="control-label">Nombre</label>
			<input type="text" id="tipoorden_nombre" name="tipoorden_nombre" value="<%- tipoorden_nombre %>" placeholder="Tipo de Orden" class="form-control input-sm input-toupper" maxlength="200" required>
		</div>

		<div class="form-group col-md-2 col-xs-8 col-sm-3">
			<br><label class="checkbox-inline" for="tipoorden_activo">
				<input type="checkbox" id="tipoorden_activo" name="tipoorden_activo" value="tipoorden_activo" <%- tipoorden_activo ? 'checked': ''%>> Activo
			</label>
		</div>
    </div>
</script>

<script type="text/template" id="add-solicitante-tpl">
	<div class="row">
		<div class="form-group col-md-8">
			<label for="solicitante_nombre" class="control-label">Nombre</label>
			<input type="text" id="solicitante_nombre" name="solicitante_nombre" value="<%- solicitante_nombre %>" placeholder="Solicitante" class="form-control input-sm input-toupper" maxlength="200" required>
		</div>

		<div class="form-group col-md-2 col-xs-8 col-sm-3">
			<br><label class="checkbox-inline" for="solicitante_activo">
				<input type="checkbox" id="solicitante_activo" name="solicitante_activo" value="solicitante_activo" <%- solicitante_activo ? 'checked': ''%>> Activo
			</label>
		</div>
    </div>
</script>

<script type="text/template" id="add-dano-tpl">
	<div class="row">
		<div class="form-group col-md-8">
			<label for="dano_nombre" class="control-label">Nombre</label>
			<input type="text" id="dano_nombre" name="dano_nombre" value="<%- dano_nombre %>" placeholder="Daño" class="form-control input-sm input-toupper" maxlength="200" required>
		</div>

		<div class="form-group col-md-2 col-xs-8 col-sm-3">
			<br><label class="checkbox-inline" for="dano_activo">
				<input type="checkbox" id="dano_activo" name="dano_activo" value="dano_activo" <%- dano_activo ? 'checked': ''%>> Activo
			</label>
		</div>
    </div>
</script>

<script type="text/template" id="add-prioridad-tpl">
	<div class="row">
		<div class="form-group col-md-8">
			<label for="prioridad_nombre" class="control-label">Nombre</label>
			<input type="text" id="prioridad_nombre" name="prioridad_nombre" value="<%- prioridad_nombre %>" placeholder="prioridad" class="form-control input-sm input-toupper" maxlength="200" required>
		</div>

		<div class="form-group col-md-2 col-xs-8 col-sm-3">
			<br><label class="checkbox-inline" for="prioridad_activo">
				<input type="checkbox" id="prioridad_activo" name="prioridad_activo" value="prioridad_activo" <%- prioridad_activo ? 'checked': ''%>> Activo
			</label>
		</div>
    </div>
</script>

<script type="text/template" id="add-zona-tpl">
	<div class="row">
		<div class="form-group col-md-8">
			<label for="zona_nombre" class="control-label">Nombre</label>
			<input type="text" id="zona_nombre" name="zona_nombre" value="<%- zona_nombre %>" placeholder="Zona" class="form-control input-sm input-toupper" maxlength="10" required>
		</div>

		<div class="form-group col-md-2 col-xs-8 col-sm-3">
			<br><label class="checkbox-inline" for="zona_activo">
				<input type="checkbox" id="zona_activo" name="zona_activo" value="zona_activo" <%- zona_activo ? 'checked': ''%>> Activo
			</label>
		</div>
    </div>
</script>

<script type="text/template" id="roles-item-list-tpl">
	<% if(edit) { %>
        <td class="text-center">
            <a class="btn btn-default btn-xs item-roles-remove" data-resource="<%- id %>">
                <span><i class="fa fa-times"></i></span>
            </a>
    	</td>
    <% } %>
	<td><%- display_name %></td>
</script>
