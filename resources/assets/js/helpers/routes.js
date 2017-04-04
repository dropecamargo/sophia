(function () {

    var laroute = (function () {

        var routes = {

            absolute: false,
            rootUrl: 'http://localhost',
            routes : [{"host":null,"methods":["POST"],"uri":"login","name":"login","action":"App\Http\Controllers\Auth\AuthController@postLogin"},{"host":null,"methods":["GET","HEAD"],"uri":"login","name":"login","action":"App\Http\Controllers\Auth\AuthController@getLogin"},{"host":null,"methods":["GET","HEAD"],"uri":"logout","name":"logout","action":"App\Http\Controllers\Auth\AuthController@getLogout"},{"host":null,"methods":["GET","HEAD"],"uri":"\/","name":"dashboard","action":"App\Http\Controllers\HomeController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"terceros\/dv","name":"terceros.dv","action":"App\Http\Controllers\Admin\TerceroController@dv"},{"host":null,"methods":["GET","HEAD"],"uri":"terceros\/rcree","name":"terceros.rcree","action":"App\Http\Controllers\Admin\TerceroController@rcree"},{"host":null,"methods":["GET","HEAD"],"uri":"terceros\/search","name":"terceros.search","action":"App\Http\Controllers\Admin\TerceroController@search"},{"host":null,"methods":["POST"],"uri":"terceros\/setpassword","name":"terceros.setpassword","action":"App\Http\Controllers\Admin\TerceroController@setpassword"},{"host":null,"methods":["GET","HEAD"],"uri":"terceros\/contactos","name":"terceros.contactos.index","action":"App\Http\Controllers\Admin\ContactoController@index"},{"host":null,"methods":["POST"],"uri":"terceros\/contactos","name":"terceros.contactos.store","action":"App\Http\Controllers\Admin\ContactoController@store"},{"host":null,"methods":["PUT"],"uri":"terceros\/contactos\/{contactos}","name":"terceros.contactos.update","action":"App\Http\Controllers\Admin\ContactoController@update"},{"host":null,"methods":["PATCH"],"uri":"terceros\/contactos\/{contactos}","name":null,"action":"App\Http\Controllers\Admin\ContactoController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"terceros\/roles","name":"terceros.roles.index","action":"App\Http\Controllers\Admin\UsuarioRolController@index"},{"host":null,"methods":["POST"],"uri":"terceros\/roles","name":"terceros.roles.store","action":"App\Http\Controllers\Admin\UsuarioRolController@store"},{"host":null,"methods":["DELETE"],"uri":"terceros\/roles\/{roles}","name":"terceros.roles.destroy","action":"App\Http\Controllers\Admin\UsuarioRolController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"terceros","name":"terceros.index","action":"App\Http\Controllers\Admin\TerceroController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"terceros\/create","name":"terceros.create","action":"App\Http\Controllers\Admin\TerceroController@create"},{"host":null,"methods":["POST"],"uri":"terceros","name":"terceros.store","action":"App\Http\Controllers\Admin\TerceroController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"terceros\/{terceros}","name":"terceros.show","action":"App\Http\Controllers\Admin\TerceroController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"terceros\/{terceros}\/edit","name":"terceros.edit","action":"App\Http\Controllers\Admin\TerceroController@edit"},{"host":null,"methods":["PUT"],"uri":"terceros\/{terceros}","name":"terceros.update","action":"App\Http\Controllers\Admin\TerceroController@update"},{"host":null,"methods":["PATCH"],"uri":"terceros\/{terceros}","name":null,"action":"App\Http\Controllers\Admin\TerceroController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"actividades","name":"actividades.index","action":"App\Http\Controllers\Admin\ActividadController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"actividades\/create","name":"actividades.create","action":"App\Http\Controllers\Admin\ActividadController@create"},{"host":null,"methods":["POST"],"uri":"actividades","name":"actividades.store","action":"App\Http\Controllers\Admin\ActividadController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"actividades\/{actividades}","name":"actividades.show","action":"App\Http\Controllers\Admin\ActividadController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"actividades\/{actividades}\/edit","name":"actividades.edit","action":"App\Http\Controllers\Admin\ActividadController@edit"},{"host":null,"methods":["PUT"],"uri":"actividades\/{actividades}","name":"actividades.update","action":"App\Http\Controllers\Admin\ActividadController@update"},{"host":null,"methods":["PATCH"],"uri":"actividades\/{actividades}","name":null,"action":"App\Http\Controllers\Admin\ActividadController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"departamentos","name":"departamentos.index","action":"App\Http\Controllers\Admin\DepartamentoController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"departamentos\/{departamentos}","name":"departamentos.show","action":"App\Http\Controllers\Admin\DepartamentoController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"municipios","name":"municipios.index","action":"App\Http\Controllers\Admin\MunicipioController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"sucursales","name":"sucursales.index","action":"App\Http\Controllers\Admin\SucursalController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"sucursales\/create","name":"sucursales.create","action":"App\Http\Controllers\Admin\SucursalController@create"},{"host":null,"methods":["POST"],"uri":"sucursales","name":"sucursales.store","action":"App\Http\Controllers\Admin\SucursalController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"sucursales\/{sucursales}","name":"sucursales.show","action":"App\Http\Controllers\Admin\SucursalController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"sucursales\/{sucursales}\/edit","name":"sucursales.edit","action":"App\Http\Controllers\Admin\SucursalController@edit"},{"host":null,"methods":["PUT"],"uri":"sucursales\/{sucursales}","name":"sucursales.update","action":"App\Http\Controllers\Admin\SucursalController@update"},{"host":null,"methods":["PATCH"],"uri":"sucursales\/{sucursales}","name":null,"action":"App\Http\Controllers\Admin\SucursalController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"estados","name":"estados.index","action":"App\Http\Controllers\Admin\EstadoController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"estados\/create","name":"estados.create","action":"App\Http\Controllers\Admin\EstadoController@create"},{"host":null,"methods":["POST"],"uri":"estados","name":"estados.store","action":"App\Http\Controllers\Admin\EstadoController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"estados\/{estados}","name":"estados.show","action":"App\Http\Controllers\Admin\EstadoController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"estados\/{estados}\/edit","name":"estados.edit","action":"App\Http\Controllers\Admin\EstadoController@edit"},{"host":null,"methods":["PUT"],"uri":"estados\/{estados}","name":"estados.update","action":"App\Http\Controllers\Admin\EstadoController@update"},{"host":null,"methods":["PATCH"],"uri":"estados\/{estados}","name":null,"action":"App\Http\Controllers\Admin\EstadoController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"roles\/permisos","name":"roles.permisos.index","action":"App\Http\Controllers\Admin\PermisoRolController@index"},{"host":null,"methods":["PUT"],"uri":"roles\/permisos\/{permisos}","name":"roles.permisos.update","action":"App\Http\Controllers\Admin\PermisoRolController@update"},{"host":null,"methods":["PATCH"],"uri":"roles\/permisos\/{permisos}","name":null,"action":"App\Http\Controllers\Admin\PermisoRolController@update"},{"host":null,"methods":["DELETE"],"uri":"roles\/permisos\/{permisos}","name":"roles.permisos.destroy","action":"App\Http\Controllers\Admin\PermisoRolController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"roles","name":"roles.index","action":"App\Http\Controllers\Admin\RolController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"roles\/create","name":"roles.create","action":"App\Http\Controllers\Admin\RolController@create"},{"host":null,"methods":["POST"],"uri":"roles","name":"roles.store","action":"App\Http\Controllers\Admin\RolController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"roles\/{roles}","name":"roles.show","action":"App\Http\Controllers\Admin\RolController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"roles\/{roles}\/edit","name":"roles.edit","action":"App\Http\Controllers\Admin\RolController@edit"},{"host":null,"methods":["PUT"],"uri":"roles\/{roles}","name":"roles.update","action":"App\Http\Controllers\Admin\RolController@update"},{"host":null,"methods":["PATCH"],"uri":"roles\/{roles}","name":null,"action":"App\Http\Controllers\Admin\RolController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"permisos","name":"permisos.index","action":"App\Http\Controllers\Admin\PermisoController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"modulos","name":"modulos.index","action":"App\Http\Controllers\Admin\ModuloController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"modelos","name":"modelos.index","action":"App\Http\Controllers\Inventario\ModeloController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"modelos\/create","name":"modelos.create","action":"App\Http\Controllers\Inventario\ModeloController@create"},{"host":null,"methods":["POST"],"uri":"modelos","name":"modelos.store","action":"App\Http\Controllers\Inventario\ModeloController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"modelos\/{modelos}","name":"modelos.show","action":"App\Http\Controllers\Inventario\ModeloController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"modelos\/{modelos}\/edit","name":"modelos.edit","action":"App\Http\Controllers\Inventario\ModeloController@edit"},{"host":null,"methods":["PUT"],"uri":"modelos\/{modelos}","name":"modelos.update","action":"App\Http\Controllers\Inventario\ModeloController@update"},{"host":null,"methods":["PATCH"],"uri":"modelos\/{modelos}","name":null,"action":"App\Http\Controllers\Inventario\ModeloController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"marcas","name":"marcas.index","action":"App\Http\Controllers\Inventario\MarcaController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"marcas\/create","name":"marcas.create","action":"App\Http\Controllers\Inventario\MarcaController@create"},{"host":null,"methods":["POST"],"uri":"marcas","name":"marcas.store","action":"App\Http\Controllers\Inventario\MarcaController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"marcas\/{marcas}","name":"marcas.show","action":"App\Http\Controllers\Inventario\MarcaController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"marcas\/{marcas}\/edit","name":"marcas.edit","action":"App\Http\Controllers\Inventario\MarcaController@edit"},{"host":null,"methods":["PUT"],"uri":"marcas\/{marcas}","name":"marcas.update","action":"App\Http\Controllers\Inventario\MarcaController@update"},{"host":null,"methods":["PATCH"],"uri":"marcas\/{marcas}","name":null,"action":"App\Http\Controllers\Inventario\MarcaController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"tipos","name":"tipos.index","action":"App\Http\Controllers\Inventario\TipoController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"tipos\/create","name":"tipos.create","action":"App\Http\Controllers\Inventario\TipoController@create"},{"host":null,"methods":["POST"],"uri":"tipos","name":"tipos.store","action":"App\Http\Controllers\Inventario\TipoController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"tipos\/{tipos}","name":"tipos.show","action":"App\Http\Controllers\Inventario\TipoController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"tipos\/{tipos}\/edit","name":"tipos.edit","action":"App\Http\Controllers\Inventario\TipoController@edit"},{"host":null,"methods":["PUT"],"uri":"tipos\/{tipos}","name":"tipos.update","action":"App\Http\Controllers\Inventario\TipoController@update"},{"host":null,"methods":["PATCH"],"uri":"tipos\/{tipos}","name":null,"action":"App\Http\Controllers\Inventario\TipoController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"contadores","name":"contadores.index","action":"App\Http\Controllers\Inventario\ContadorController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"contadores\/create","name":"contadores.create","action":"App\Http\Controllers\Inventario\ContadorController@create"},{"host":null,"methods":["POST"],"uri":"contadores","name":"contadores.store","action":"App\Http\Controllers\Inventario\ContadorController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"contadores\/{contadores}","name":"contadores.show","action":"App\Http\Controllers\Inventario\ContadorController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"contadores\/{contadores}\/edit","name":"contadores.edit","action":"App\Http\Controllers\Inventario\ContadorController@edit"},{"host":null,"methods":["PUT"],"uri":"contadores\/{contadores}","name":"contadores.update","action":"App\Http\Controllers\Inventario\ContadorController@update"},{"host":null,"methods":["PATCH"],"uri":"contadores\/{contadores}","name":null,"action":"App\Http\Controllers\Inventario\ContadorController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"productos\/search","name":"productos.search","action":"App\Http\Controllers\Inventario\ProductoController@search"},{"host":null,"methods":["GET","HEAD"],"uri":"productos\/sirveas","name":"productos.sirveas.index","action":"App\Http\Controllers\Inventario\SirveaController@index"},{"host":null,"methods":["POST"],"uri":"productos\/sirveas","name":"productos.sirveas.store","action":"App\Http\Controllers\Inventario\SirveaController@store"},{"host":null,"methods":["DELETE"],"uri":"productos\/sirveas\/{sirveas}","name":"productos.sirveas.destroy","action":"App\Http\Controllers\Inventario\SirveaController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"productos\/productoscontador","name":"productos.productoscontador.index","action":"App\Http\Controllers\Inventario\ProductoContadorController@index"},{"host":null,"methods":["POST"],"uri":"productos\/productoscontador","name":"productos.productoscontador.store","action":"App\Http\Controllers\Inventario\ProductoContadorController@store"},{"host":null,"methods":["DELETE"],"uri":"productos\/productoscontador\/{productoscontador}","name":"productos.productoscontador.destroy","action":"App\Http\Controllers\Inventario\ProductoContadorController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"productos","name":"productos.index","action":"App\Http\Controllers\Inventario\ProductoController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"productos\/create","name":"productos.create","action":"App\Http\Controllers\Inventario\ProductoController@create"},{"host":null,"methods":["POST"],"uri":"productos","name":"productos.store","action":"App\Http\Controllers\Inventario\ProductoController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"productos\/{productos}","name":"productos.show","action":"App\Http\Controllers\Inventario\ProductoController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"productos\/{productos}\/edit","name":"productos.edit","action":"App\Http\Controllers\Inventario\ProductoController@edit"},{"host":null,"methods":["PUT"],"uri":"productos\/{productos}","name":"productos.update","action":"App\Http\Controllers\Inventario\ProductoController@update"},{"host":null,"methods":["PATCH"],"uri":"productos\/{productos}","name":null,"action":"App\Http\Controllers\Inventario\ProductoController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"contratos\/danoc","name":"contratos.danoc.index","action":"App\Http\Controllers\Tecnico\ContratoDanoController@index"},{"host":null,"methods":["POST"],"uri":"contratos\/danoc","name":"contratos.danoc.store","action":"App\Http\Controllers\Tecnico\ContratoDanoController@store"},{"host":null,"methods":["DELETE"],"uri":"contratos\/danoc\/{danoc}","name":"contratos.danoc.destroy","action":"App\Http\Controllers\Tecnico\ContratoDanoController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"ordenes\/visitas","name":"ordenes.visitas.index","action":"App\Http\Controllers\Tecnico\VisitaController@index"},{"host":null,"methods":["POST"],"uri":"ordenes\/visitas","name":"ordenes.visitas.store","action":"App\Http\Controllers\Tecnico\VisitaController@store"},{"host":null,"methods":["DELETE"],"uri":"ordenes\/visitas\/{visitas}","name":"ordenes.visitas.destroy","action":"App\Http\Controllers\Tecnico\VisitaController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"ordenes\/visitasp","name":"ordenes.visitasp.index","action":"App\Http\Controllers\Tecnico\VisitapController@index"},{"host":null,"methods":["POST"],"uri":"ordenes\/visitasp","name":"ordenes.visitasp.store","action":"App\Http\Controllers\Tecnico\VisitapController@store"},{"host":null,"methods":["DELETE"],"uri":"ordenes\/visitasp\/{visitasp}","name":"ordenes.visitasp.destroy","action":"App\Http\Controllers\Tecnico\VisitapController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"ordenes\/contadoresp","name":"ordenes.contadoresp.index","action":"App\Http\Controllers\Tecnico\ContadorespController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"contratos","name":"contratos.index","action":"App\Http\Controllers\Tecnico\ContratoController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"contratos\/create","name":"contratos.create","action":"App\Http\Controllers\Tecnico\ContratoController@create"},{"host":null,"methods":["POST"],"uri":"contratos","name":"contratos.store","action":"App\Http\Controllers\Tecnico\ContratoController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"contratos\/{contratos}","name":"contratos.show","action":"App\Http\Controllers\Tecnico\ContratoController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"contratos\/{contratos}\/edit","name":"contratos.edit","action":"App\Http\Controllers\Tecnico\ContratoController@edit"},{"host":null,"methods":["PUT"],"uri":"contratos\/{contratos}","name":"contratos.update","action":"App\Http\Controllers\Tecnico\ContratoController@update"},{"host":null,"methods":["PATCH"],"uri":"contratos\/{contratos}","name":null,"action":"App\Http\Controllers\Tecnico\ContratoController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"ordenes","name":"ordenes.index","action":"App\Http\Controllers\Tecnico\OrdenController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"ordenes\/create","name":"ordenes.create","action":"App\Http\Controllers\Tecnico\OrdenController@create"},{"host":null,"methods":["POST"],"uri":"ordenes","name":"ordenes.store","action":"App\Http\Controllers\Tecnico\OrdenController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"ordenes\/{ordenes}","name":"ordenes.show","action":"App\Http\Controllers\Tecnico\OrdenController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"ordenes\/{ordenes}\/edit","name":"ordenes.edit","action":"App\Http\Controllers\Tecnico\OrdenController@edit"},{"host":null,"methods":["PUT"],"uri":"ordenes\/{ordenes}","name":"ordenes.update","action":"App\Http\Controllers\Tecnico\OrdenController@update"},{"host":null,"methods":["PATCH"],"uri":"ordenes\/{ordenes}","name":null,"action":"App\Http\Controllers\Tecnico\OrdenController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"tiposorden","name":"tiposorden.index","action":"App\Http\Controllers\Tecnico\TipoOrdenController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"tiposorden\/create","name":"tiposorden.create","action":"App\Http\Controllers\Tecnico\TipoOrdenController@create"},{"host":null,"methods":["POST"],"uri":"tiposorden","name":"tiposorden.store","action":"App\Http\Controllers\Tecnico\TipoOrdenController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"tiposorden\/{tiposorden}","name":"tiposorden.show","action":"App\Http\Controllers\Tecnico\TipoOrdenController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"tiposorden\/{tiposorden}\/edit","name":"tiposorden.edit","action":"App\Http\Controllers\Tecnico\TipoOrdenController@edit"},{"host":null,"methods":["PUT"],"uri":"tiposorden\/{tiposorden}","name":"tiposorden.update","action":"App\Http\Controllers\Tecnico\TipoOrdenController@update"},{"host":null,"methods":["PATCH"],"uri":"tiposorden\/{tiposorden}","name":null,"action":"App\Http\Controllers\Tecnico\TipoOrdenController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"solicitantes","name":"solicitantes.index","action":"App\Http\Controllers\Tecnico\SolicitanteController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"solicitantes\/create","name":"solicitantes.create","action":"App\Http\Controllers\Tecnico\SolicitanteController@create"},{"host":null,"methods":["POST"],"uri":"solicitantes","name":"solicitantes.store","action":"App\Http\Controllers\Tecnico\SolicitanteController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"solicitantes\/{solicitantes}","name":"solicitantes.show","action":"App\Http\Controllers\Tecnico\SolicitanteController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"solicitantes\/{solicitantes}\/edit","name":"solicitantes.edit","action":"App\Http\Controllers\Tecnico\SolicitanteController@edit"},{"host":null,"methods":["PUT"],"uri":"solicitantes\/{solicitantes}","name":"solicitantes.update","action":"App\Http\Controllers\Tecnico\SolicitanteController@update"},{"host":null,"methods":["PATCH"],"uri":"solicitantes\/{solicitantes}","name":null,"action":"App\Http\Controllers\Tecnico\SolicitanteController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"danos","name":"danos.index","action":"App\Http\Controllers\Tecnico\DanoController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"danos\/create","name":"danos.create","action":"App\Http\Controllers\Tecnico\DanoController@create"},{"host":null,"methods":["POST"],"uri":"danos","name":"danos.store","action":"App\Http\Controllers\Tecnico\DanoController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"danos\/{danos}","name":"danos.show","action":"App\Http\Controllers\Tecnico\DanoController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"danos\/{danos}\/edit","name":"danos.edit","action":"App\Http\Controllers\Tecnico\DanoController@edit"},{"host":null,"methods":["PUT"],"uri":"danos\/{danos}","name":"danos.update","action":"App\Http\Controllers\Tecnico\DanoController@update"},{"host":null,"methods":["PATCH"],"uri":"danos\/{danos}","name":null,"action":"App\Http\Controllers\Tecnico\DanoController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"prioridades","name":"prioridades.index","action":"App\Http\Controllers\Tecnico\PrioridadController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"prioridades\/create","name":"prioridades.create","action":"App\Http\Controllers\Tecnico\PrioridadController@create"},{"host":null,"methods":["POST"],"uri":"prioridades","name":"prioridades.store","action":"App\Http\Controllers\Tecnico\PrioridadController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"prioridades\/{prioridades}","name":"prioridades.show","action":"App\Http\Controllers\Tecnico\PrioridadController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"prioridades\/{prioridades}\/edit","name":"prioridades.edit","action":"App\Http\Controllers\Tecnico\PrioridadController@edit"},{"host":null,"methods":["PUT"],"uri":"prioridades\/{prioridades}","name":"prioridades.update","action":"App\Http\Controllers\Tecnico\PrioridadController@update"},{"host":null,"methods":["PATCH"],"uri":"prioridades\/{prioridades}","name":null,"action":"App\Http\Controllers\Tecnico\PrioridadController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"zonas","name":"zonas.index","action":"App\Http\Controllers\Tecnico\ZonaController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"zonas\/create","name":"zonas.create","action":"App\Http\Controllers\Tecnico\ZonaController@create"},{"host":null,"methods":["POST"],"uri":"zonas","name":"zonas.store","action":"App\Http\Controllers\Tecnico\ZonaController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"zonas\/{zonas}","name":"zonas.show","action":"App\Http\Controllers\Tecnico\ZonaController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"zonas\/{zonas}\/edit","name":"zonas.edit","action":"App\Http\Controllers\Tecnico\ZonaController@edit"},{"host":null,"methods":["PUT"],"uri":"zonas\/{zonas}","name":"zonas.update","action":"App\Http\Controllers\Tecnico\ZonaController@update"},{"host":null,"methods":["PATCH"],"uri":"zonas\/{zonas}","name":null,"action":"App\Http\Controllers\Tecnico\ZonaController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"asignaciones\/detalle","name":"asignaciones.detalle.index","action":"App\Http\Controllers\Tecnico\AsignacionDetalleController@index"},{"host":null,"methods":["POST"],"uri":"asignaciones\/detalle","name":"asignaciones.detalle.store","action":"App\Http\Controllers\Tecnico\AsignacionDetalleController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"asignaciones\/contratos","name":"asignaciones.contratos.index","action":"App\Http\Controllers\Tecnico\ContratoController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"asignaciones","name":"asignaciones.index","action":"App\Http\Controllers\Tecnico\AsignacionController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"asignaciones\/create","name":"asignaciones.create","action":"App\Http\Controllers\Tecnico\AsignacionController@create"},{"host":null,"methods":["POST"],"uri":"asignaciones","name":"asignaciones.store","action":"App\Http\Controllers\Tecnico\AsignacionController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"asignaciones\/{asignaciones}","name":"asignaciones.show","action":"App\Http\Controllers\Tecnico\AsignacionController@show"},{"host":null,"methods":["PUT"],"uri":"asignaciones\/{asignaciones}","name":"asignaciones.update","action":"App\Http\Controllers\Tecnico\AsignacionController@update"},{"host":null,"methods":["PATCH"],"uri":"asignaciones\/{asignaciones}","name":null,"action":"App\Http\Controllers\Tecnico\AsignacionController@update"}],
            prefix: '',

            route : function (name, parameters, route) {
                route = route || this.getByName(name);

                if ( ! route ) {
                    return undefined;
                }

                return this.toRoute(route, parameters);
            },

            url: function (url, parameters) {
                parameters = parameters || [];

                var uri = url + '/' + parameters.join('/');

                return this.getCorrectUrl(uri);
            },

            toRoute : function (route, parameters) {
                var uri = this.replaceNamedParameters(route.uri, parameters);
                var qs  = this.getRouteQueryString(parameters);

                if (this.absolute && this.isOtherHost(route)){
                    return "//" + route.host + "/" + uri + qs;
                }

                return this.getCorrectUrl(uri + qs);
            },

            isOtherHost: function (route){
                return route.host && route.host != window.location.hostname;
            },

            replaceNamedParameters : function (uri, parameters) {
                uri = uri.replace(/\{(.*?)\??\}/g, function(match, key) {
                    if (parameters.hasOwnProperty(key)) {
                        var value = parameters[key];
                        delete parameters[key];
                        return value;
                    } else {
                        return match;
                    }
                });

                // Strip out any optional parameters that were not given
                uri = uri.replace(/\/\{.*?\?\}/g, '');

                return uri;
            },

            getRouteQueryString : function (parameters) {
                var qs = [];
                for (var key in parameters) {
                    if (parameters.hasOwnProperty(key)) {
                        qs.push(key + '=' + parameters[key]);
                    }
                }

                if (qs.length < 1) {
                    return '';
                }

                return '?' + qs.join('&');
            },

            getByName : function (name) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].name === name) {
                        return this.routes[key];
                    }
                }
            },

            getByAction : function(action) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].action === action) {
                        return this.routes[key];
                    }
                }
            },

            getCorrectUrl: function (uri) {
                var url = this.prefix + '/' + uri.replace(/^\/?/, '');

                if ( ! this.absolute) {
                    return url;
                }

                return this.rootUrl.replace('/\/?$/', '') + url;
            }
        };

        var getLinkAttributes = function(attributes) {
            if ( ! attributes) {
                return '';
            }

            var attrs = [];
            for (var key in attributes) {
                if (attributes.hasOwnProperty(key)) {
                    attrs.push(key + '="' + attributes[key] + '"');
                }
            }

            return attrs.join(' ');
        };

        var getHtmlLink = function (url, title, attributes) {
            title      = title || url;
            attributes = getLinkAttributes(attributes);

            return '<a href="' + url + '" ' + attributes + '>' + title + '</a>';
        };

        return {
            // Generate a url for a given controller action.
            // Route.action('HomeController@getIndex', [params = {}])
            action : function (name, parameters) {
                parameters = parameters || {};

                return routes.route(name, parameters, routes.getByAction(name));
            },

            // Generate a url for a given named route.
            // Route.route('routeName', [params = {}])
            route : function (route, parameters) {
                parameters = parameters || {};

                return routes.route(route, parameters);
            },

            // Generate a fully qualified URL to the given path.
            // Route.route('url', [params = {}])
            url : function (route, parameters) {
                parameters = parameters || {};

                return routes.url(route, parameters);
            },

            // Generate a html link to the given url.
            // Route.link_to('foo/bar', [title = url], [attributes = {}])
            link_to : function (url, title, attributes) {
                url = this.url(url);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given route.
            // Route.link_to_route('route.name', [title=url], [parameters = {}], [attributes = {}])
            link_to_route : function (route, title, parameters, attributes) {
                var url = this.route(route, parameters);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given controller action.
            // Route.link_to_action('HomeController@getIndex', [title=url], [parameters = {}], [attributes = {}])
            link_to_action : function(action, title, parameters, attributes) {
                var url = this.action(action, parameters);

                return getHtmlLink(url, title, attributes);
            }

        };

    }).call(this);

    /**
     * Expose the class either via AMD, CommonJS or the global object
     */
    if (typeof define === 'function' && define.amd) {
        define(function () {
            return laroute;
        });
    }
    else if (typeof module === 'object' && module.exports){
        module.exports = laroute;
    }
    else {
        window.Route = laroute;
    }

}).call(this);

