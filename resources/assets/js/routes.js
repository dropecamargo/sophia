/**
* Class AppRouter  of Backbone Router
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

//Global App Backbone
app || (app = {});

(function ($, window, document, undefined) {

    app.AppRouter = new( Backbone.Router.extend({
        routes : {
            //Login
            'login(/)': 'getLogin',

            /*
            |-----------------------
            | Administracion
            |-----------------------
            */

            //Terceros
            'terceros(/)': 'getTercerosMain',
            'terceros/create(/)': 'getTercerosCreate',
            'terceros/:tercero(/)': 'getTercerosShow',
            'terceros/:tercero/edit(/)': 'getTercerosEdit',

            //Actividades
            'actividades(/)': 'getActividadesMain',
            'actividades/create(/)': 'getActividadesCreate',
            'actividades/:actividad/edit(/)': 'getActividadesEdit',

            //Sucursales
            'sucursales(/)': 'getSucursalesMain',
            'sucursales/create(/)': 'getSucursalesCreate',
            'sucursales/:sucursal/edit(/)': 'getSucursalesEdit',

            //Departamentos & Municipios
            'departamentos(/)': 'getDepartamentosMain',
            'municipios(/)': 'getMunicipiosMain',

            //Estados
            'estados(/)': 'getEstadosMain',
            'estados/create(/)': 'getEstadosCreate',
            'estados/:modelo/edit(/)': 'getEstadosEdit',

            /*
            |----------------------
            | Inventario
            |----------------------
            */

            //Productos
            'productos(/)': 'getProductosMain',
            'productos/create(/)': 'getProductosCreate',
            'productos/:productos/edit(/)': 'getProductosEdit',
            'productos/:productos(/)': 'getProductosShow',

            //Marcas
            'marcas(/)': 'getMarcasMain',
            'marcas/create(/)': 'getMarcasCreate',
            'marcas/:marcas/edit(/)': 'getMarcasEdit',

            //Tipos
            'tipos(/)': 'getTiposMain',
            'tipos/create(/)': 'getTiposCreate',
            'tipos/:tipos/edit(/)': 'getTiposEdit',

            //Modelos
            'modelos(/)': 'getModelosMain',
            'modelos/create(/)': 'getModelosCreate',
            'modelos/:modelo/edit(/)': 'getModelosEdit',

            //Contadores
            'contadores(/)': 'getContadoresMain',
            'contadores/create(/)': 'getContadoresCreate',
            'contadores/:contadores/edit(/)': 'getContadoresEdit',

            /*
            |----------------------
            | Tecnico
            |----------------------
            */

            //Tipo de Orden
            'tiposorden(/)': 'getTiposOrdenMain',
            'tiposorden/create(/)': 'getTiposOrdenCreate',
            'tiposorden/:tiposorden/edit(/)': 'getTiposOrdenEdit',

            //Solicitante
            'solicitantes(/)': 'getSolicitantesMain',
            'solicitantes/create(/)': 'getSolicitantesCreate',
            'solicitantes/:solicitantes/edit(/)': 'getSolicitantesEdit',

            //Daño
            'danos(/)': 'getDanosMain',
            'danos/create(/)': 'getDanosCreate',
            'danos/:danos/edit(/)': 'getDanosEdit',

            //Contratos
            'contratos(/)': 'getContratosMain',
            'contratos/create(/)': 'getContratosCreate',
            'contratos/:contrato(/)': 'getContratoShow',
            'contratos/:contrato/edit(/)': 'getContratosEdit',

            //Ordenes
            'ordenes(/)': 'getOrdenesMain',
            'ordenes/create(/)': 'getOrdenesCreate',
            'ordenes/:orden/edit(/)': 'getOrdenesEdit',

            //Prioridad
            'prioridades(/)': 'getPrioridadesMain',
            'prioridades/create(/)': 'getPrioridadesCreate',
            'prioridades/:prioridades/edit(/)': 'getPrioridadesEdit',

            //Zona
            'zonas(/)': 'getZonasMain',
            'zonas/create(/)': 'getZonasCreate',
            'zonas/:zonas/edit(/)': 'getZonasEdit',

            //Asignacion #1
            'asignaciones(/)': 'getAsignacionMain',
            'asignaciones/create(/)(?*queryString)': 'getAsignacionCreate',
            'asignaciones/:asignaciones(/)': 'getAsignacionShow',
        },

        /**
        * Parse queryString to object
        */
        parseQueryString : function(queryString) {
            var params = {};
            if(queryString) {
                _.each(
                    _.map(decodeURI(queryString).split(/&/g),function(el,i){
                        var aux = el.split('='), o = {};
                        if(aux.length >= 1){
                            var val = undefined;
                            if(aux.length == 2)
                                val = aux[1];
                            o[aux[0]] = val;
                        }
                        return o;
                    }),
                    function(o){
                        _.extend(params,o);
                    }
                );
            }
            return params;
        },

        /**
        * Constructor Method
        */
        initialize : function ( opts ){
            // Initialize resources
            this.componentGlobalView = new app.ComponentGlobalView();
            this.componentSearchTerceroView = new app.ComponentSearchTerceroView();
            this.componentTerceroView = new app.ComponentTerceroView();
            this.componentAddressView = new app.ComponentAddressView();
            this.componentCreateResourceView = new app.ComponentCreateResourceView();
            this.componentSearchProductoView = new app.ComponentSearchProductoView();
            this.componentSearchContactoView = new app.ComponentSearchContactoView();
            this.componentSearchContratoView = new app.ComponentSearchContratoView();
      	},

        /**
        * Start Backbone history
        */
        start: function () {
            var config = { pushState: true };

            if( document.domain.search(/(104.236.57.82|localhost)/gi) != '-1' )
                config.root = '/sophia/public/';

            Backbone.history.start( config );
        },

        /**
        * show view in Calendar Event
        * @param String show
        */
        getLogin: function () {

            if ( this.loginView instanceof Backbone.View ){
                this.loginView.stopListening();
                this.loginView.undelegateEvents();
            }

            this.loginView = new app.UserLoginView( );
        },

        /*------------------------
        | Administracion
        /*-----------------------*/

        // Tercero
        getTercerosMain: function () {

            if ( this.mainTerceroView instanceof Backbone.View ){
                this.mainTerceroView.stopListening();
                this.mainTerceroView.undelegateEvents();
            }

            this.mainTerceroView = new app.MainTerceroView( );
        },

        getTercerosCreate: function () {
            this.terceroModel = new app.TerceroModel();

            if ( this.createTerceroView instanceof Backbone.View ){
                this.createTerceroView.stopListening();
                this.createTerceroView.undelegateEvents();
            }

            this.createTerceroView = new app.CreateTerceroView({ model: this.terceroModel });
            this.createTerceroView.render();
        },

        getTercerosShow: function (tercero) {
            this.terceroModel = new app.TerceroModel();
            this.terceroModel.set({'id': tercero}, {'silent':true});

            if ( this.showTerceroView instanceof Backbone.View ){
                this.showTerceroView.stopListening();
                this.showTerceroView.undelegateEvents();
            }

            this.showTerceroView = new app.ShowTerceroView({ model: this.terceroModel });
        },

        getTercerosEdit: function (tercero) {
            this.terceroModel = new app.TerceroModel();
            this.terceroModel.set({'id': tercero}, {'silent':true});

            if ( this.createTerceroView instanceof Backbone.View ){
                this.createTerceroView.stopListening();
                this.createTerceroView.undelegateEvents();
            }

            this.createTerceroView = new app.CreateTerceroView({ model: this.terceroModel });
            this.terceroModel.fetch();
        },

        /**
        * show view main actividades
        */
        getActividadesMain: function () {

            if ( this.mainActividadView instanceof Backbone.View ){
                this.mainActividadView.stopListening();
                this.mainActividadView.undelegateEvents();
            }

            this.mainActividadView = new app.MainActividadView( );
        },

        getActividadesCreate: function () {
            this.actividadModel = new app.ActividadModel();

            if ( this.createActividadView instanceof Backbone.View ){
                this.createActividadView.stopListening();
                this.createActividadView.undelegateEvents();
            }

            this.createActividadView = new app.CreateActividadView({ model: this.actividadModel });
            this.createActividadView.render();
        },

        getActividadesEdit: function (actividad) {
            this.actividadModel = new app.ActividadModel();
            this.actividadModel.set({'id': actividad}, {silent: true});

            if ( this.createActividadView instanceof Backbone.View ){
                this.createActividadView.stopListening();
                this.createActividadView.undelegateEvents();
            }

            this.createActividadView = new app.CreateActividadView({ model: this.actividadModel });
            this.actividadModel.fetch();
        },

        // Sucursales
        getSucursalesMain: function () {

            if ( this.mainSucursalesView instanceof Backbone.View ){
                this.mainSucursalesView.stopListening();
                this.mainSucursalesView.undelegateEvents();
            }

            this.mainSucursalesView = new app.MainSucursalesView( );
        },

        getSucursalesCreate: function () {
            this.sucursalModel = new app.SucursalModel();

            if ( this.createSucursalView instanceof Backbone.View ){
                this.createSucursalView.stopListening();
                this.createSucursalView.undelegateEvents();
            }

            this.createSucursalView = new app.CreateSucursalView({ model: this.sucursalModel });
            this.createSucursalView.render();
        },

        getSucursalesEdit: function (sucursal) {
            this.sucursalModel = new app.SucursalModel();
            this.sucursalModel.set({'id': sucursal}, {silent: true});

            if ( this.createSucursalView instanceof Backbone.View ){
                this.createSucursalView.stopListening();
                this.createSucursalView.undelegateEvents();
            }

            this.createSucursalView = new app.CreateSucursalView({ model: this.sucursalModel });
            this.sucursalModel.fetch();
        },

        // Vistas de Departamentos
        getDepartamentosMain: function () {

            if ( this.mainDepartamentoView instanceof Backbone.View ){
                this.mainDepartamentoView.stopListening();
                this.mainDepartamentoView.undelegateEvents();
            }

            this.mainDepartamentoView = new app.MainDepartamentoView( );
        },

        // Vistas de Municipios
        getMunicipiosMain: function () {

            if ( this.mainMunicipioView instanceof Backbone.View ){
                this.mainMunicipioView.stopListening();
                this.mainMunicipioView.undelegateEvents();
            }

            this.mainMunicipioView = new app.MainMunicipioView( );
        },

        // Estados
        getEstadosMain: function () {

            if ( this.mainEstadoView instanceof Backbone.View ){
                this.mainEstadoView.stopListening();
                this.mainEstadoView.undelegateEvents();
            }

            this.mainEstadoView = new app.MainEstadosView( );
        },

        getEstadosCreate: function () {
            this.estadoModel = new app.EstadoModel();

            if ( this.createEstadoView instanceof Backbone.View ){
                this.createEstadoView.stopListening();
                this.createEstadoView.undelegateEvents();
            }

            this.createEstadoView = new app.CreateEstadoView({ model: this.estadoModel });
            this.createEstadoView.render();
        },

        getEstadosEdit: function (estados) {
            this.estadoModel = new app.EstadoModel();
            this.estadoModel.set({'id': estados}, {'silent':true});

            if ( this.createEstadoView instanceof Backbone.View ){
                this.createEstadoView.stopListening();
                this.createEstadoView.undelegateEvents();
            }

            this.createEstadoView = new app.CreateEstadoView({ model: this.estadoModel });
            this.estadoModel.fetch();
        },

        /*------------------------
        | Inventario
        /*----------------------*/

        // Producto
        getProductosMain: function () {

            if ( this.mainProductoView instanceof Backbone.View ){
                this.mainProductoView.stopListening();
                this.mainProductoView.undelegateEvents();
            }

            this.mainProductoView = new app.MainProductosView( );
        },

        getProductosCreate: function () {
            this.productoModel = new app.ProductoModel();

            if ( this.createProductoView instanceof Backbone.View ){
                this.createProductoView.stopListening();
                this.createProductoView.undelegateEvents();
            }

            this.createProductoView = new app.CreateProductoView({ model: this.productoModel });
            this.createProductoView.render();
        },

        getProductosEdit: function (productos) {
            this.productoModel = new app.ProductoModel();
            this.productoModel.set({'id': productos}, {'silent':true});

            if ( this.createProductoView instanceof Backbone.View ){
                this.createProductoView.stopListening();
                this.createProductoView.undelegateEvents();
            }

            this.createProductoView = new app.CreateProductoView({ model: this.productoModel });
            this.productoModel.fetch();
        },

        /**
        * show view show tercero
        */
        getProductosShow: function (productos) {
            this.productoModel = new app.ProductoModel();
            this.productoModel.set({'id': productos}, {silent: true});

            if ( this.showProductoView instanceof Backbone.View ){
                this.showProductoView.stopListening();
                this.showProductoView.undelegateEvents();
            }

            this.showProductoView = new app.ShowProductoView({ model: this.productoModel });
        },

        // Marca
        getMarcasMain: function () {

            if ( this.mainMarcaView instanceof Backbone.View ){
                this.mainMarcaView.stopListening();
                this.mainMarcaView.undelegateEvents();
            }

            this.mainMarcaView = new app.MainMarcasView( );
        },

        getMarcasCreate: function () {
            this.marcaModel = new app.MarcaModel();

            if ( this.createMarcaView instanceof Backbone.View ){
                this.createMarcaView.stopListening();
                this.createMarcaView.undelegateEvents();
            }

            this.createMarcaView = new app.CreateMarcaView({ model: this.marcaModel });
            this.createMarcaView.render();
        },

        getMarcasEdit: function (marcas) {
            this.marcaModel = new app.MarcaModel();
            this.marcaModel.set({'id': marcas}, {'silent':true});

            if ( this.createMarcaView instanceof Backbone.View ){
                this.createMarcaView.stopListening();
                this.createMarcaView.undelegateEvents();
            }

            this.createMarcaView = new app.CreateMarcaView({ model: this.marcaModel });
            this.marcaModel.fetch();
        },

        // Tipo
        getTiposMain: function () {

            if ( this.mainTipoView instanceof Backbone.View ){
                this.mainTipoView.stopListening();
                this.mainTipoView.undelegateEvents();
            }

            this.mainTipoView = new app.MainTiposView( );
        },

        getTiposCreate: function () {
            this.tipoModel = new app.TipoModel();

            if ( this.createTipoView instanceof Backbone.View ){
                this.createTipoView.stopListening();
                this.createTipoView.undelegateEvents();
            }

            this.createTipoView = new app.CreateTipoView({ model: this.tipoModel });
            this.createTipoView.render();
        },

        getTiposEdit: function (tipos) {
            this.tipoModel = new app.TipoModel();
            this.tipoModel.set({'id': tipos}, {'silent':true});

            if ( this.createTipoView instanceof Backbone.View ){
                this.createTipoView.stopListening();
                this.createTipoView.undelegateEvents();
            }

            this.createTipoView = new app.CreateTipoView({ model: this.tipoModel });
            this.tipoModel.fetch();
        },

        // Modelo
        getModelosMain: function () {

            if ( this.mainModeloView instanceof Backbone.View ){
                this.mainModeloView.stopListening();
                this.mainModeloView.undelegateEvents();
            }

            this.mainModeloView = new app.MainModelosView( );
        },

        getModelosCreate: function () {
            this.modeloModel = new app.ModeloModel();

            if ( this.createModeloView instanceof Backbone.View ){
                this.createModeloView.stopListening();
                this.createModeloView.undelegateEvents();
            }

            this.createModeloView = new app.CreateModeloView({ model: this.modeloModel });
            this.createModeloView.render();
        },

        getModelosEdit: function (modelos) {
            this.modeloModel = new app.ModeloModel();
            this.modeloModel.set({'id': modelos}, {'silent':true});

            if ( this.createModeloView instanceof Backbone.View ){
                this.createModeloView.stopListening();
                this.createModeloView.undelegateEvents();
            }

            this.createModeloView = new app.CreateModeloView({ model: this.modeloModel });
            this.modeloModel.fetch();
        },

        // Contador
        getContadoresMain: function () {

            if ( this.mainContadorView instanceof Backbone.View ){
                this.mainContadorView.stopListening();
                this.mainContadorView.undelegateEvents();
            }

            this.mainContadorView = new app.MainContadoresView( );
        },

        getContadoresCreate: function () {
            this.contadorModel = new app.ContadorModel();

            if ( this.createContadorView instanceof Backbone.View ){
                this.createContadorView.stopListening();
                this.createContadorView.undelegateEvents();
            }

            this.createContadorView = new app.CreateContadorView({ model: this.contadorModel });
            this.createContadorView.render();
        },

        getContadoresEdit: function (contadores) {
            this.contadorModel = new app.ContadorModel();
            this.contadorModel.set({'id': contadores}, {'silent':true});

            if ( this.createContadorView instanceof Backbone.View ){
                this.createContadorView.stopListening();
                this.createContadorView.undelegateEvents();
            }

            this.createContadorView = new app.CreateContadorView({ model: this.contadorModel });
            this.contadorModel.fetch();
        },

        /*---------------------
        | Tecnicos
        /*--------------------*/

        // Tipo de Orden
        getTiposOrdenMain: function () {

            if ( this.mainTipoOrdenView instanceof Backbone.View ){
                this.mainTipoOrdenView.stopListening();
                this.mainTipoOrdenView.undelegateEvents();
            }

            this.mainTipoOrdenView = new app.MainTiposOrdenView( );
        },

        getTiposOrdenCreate: function () {
            this.tipoordenModel = new app.TipoOrdenModel();

            if ( this.createTipoOrdenView instanceof Backbone.View ){
                this.createTipoOrdenView.stopListening();
                this.createTipoOrdenView.undelegateEvents();
            }

            this.createTipoOrdenView = new app.CreateTipoOrdenView({ model: this.tipoordenModel });
            this.createTipoOrdenView.render();
        },

        getTiposOrdenEdit: function (tiposorden) {
            this.tipoordenModel = new app.TipoOrdenModel();
            this.tipoordenModel.set({'id': tiposorden}, {'silent':true});

            if ( this.createTipoOrdenView instanceof Backbone.View ){
                this.createTipoOrdenView.stopListening();
                this.createTipoOrdenView.undelegateEvents();
            }

            this.createTipoOrdenView = new app.CreateTipoOrdenView({ model: this.tipoordenModel });
            this.tipoordenModel.fetch();
        },

        // Solicitante
        getSolicitantesMain: function () {

            if ( this.mainSolicitanteView instanceof Backbone.View ){
                this.mainSolicitanteView.stopListening();
                this.mainSolicitanteView.undelegateEvents();
            }

            this.mainSolicitanteView = new app.MainSolicitantesView( );
        },

        getSolicitantesCreate: function () {
            this.solicitanteModel = new app.SolicitanteModel();

            if ( this.createSolicitanteView instanceof Backbone.View ){
                this.createSolicitanteView.stopListening();
                this.createSolicitanteView.undelegateEvents();
            }

            this.createSolicitanteView = new app.CreateSolicitanteView({ model: this.solicitanteModel });
            this.createSolicitanteView.render();
        },

        getSolicitantesEdit: function (solicitantes) {
            this.solicitanteModel = new app.SolicitanteModel();
            this.solicitanteModel.set({'id': solicitantes}, {'silent':true});

            if ( this.createSolicitanteView instanceof Backbone.View ){
                this.createSolicitanteView.stopListening();
                this.createSolicitanteView.undelegateEvents();
            }

            this.createSolicitanteView = new app.CreateSolicitanteView({ model: this.solicitanteModel });
            this.solicitanteModel.fetch();
        },

        // Daños
        getDanosMain: function () {

            if ( this.mainDanoView instanceof Backbone.View ){
                this.mainDanoView.stopListening();
                this.mainDanoView.undelegateEvents();
            }

            this.mainDanoView = new app.MainDanosView( );
        },

        getDanosCreate: function () {
            this.danoModel = new app.DanoModel();

            if ( this.createDanoView instanceof Backbone.View ){
                this.createDanoView.stopListening();
                this.createDanoView.undelegateEvents();
            }

            this.createDanoView = new app.CreateDanoView({ model: this.danoModel });
            this.createDanoView.render();
        },

        getDanosEdit: function (danos) {
            this.danoModel = new app.DanoModel();
            this.danoModel.set({'id': danos}, {'silent':true});

            if ( this.createDanoView instanceof Backbone.View ){
                this.createDanoView.stopListening();
                this.createDanoView.undelegateEvents();
            }

            this.createDanoView = new app.CreateDanoView({ model: this.danoModel });
            this.danoModel.fetch();
        },

        // Prioridad
        getPrioridadesMain: function () {

            if ( this.mainPrioridadView instanceof Backbone.View ){
                this.mainPrioridadView.stopListening();
                this.mainPrioridadView.undelegateEvents();
            }

            this.mainPrioridadView = new app.MainPrioridadesView( );
        },

        getPrioridadesCreate: function () {
            this.prioridadModel = new app.PrioridadModel();

            if ( this.createPrioridadView instanceof Backbone.View ){
                this.createPrioridadView.stopListening();
                this.createPrioridadView.undelegateEvents();
            }

            this.createPrioridadView = new app.CreatePrioridadView({ model: this.prioridadModel });
            this.createPrioridadView.render();
        },

        getPrioridadesEdit: function (prioridades) {
            this.prioridadModel = new app.PrioridadModel();
            this.prioridadModel.set({'id': prioridades}, {'silent':true});

            if ( this.createPrioridadView instanceof Backbone.View ){
                this.createPrioridadView.stopListening();
                this.createPrioridadView.undelegateEvents();
            }

            this.createPrioridadView = new app.CreatePrioridadView({ model: this.prioridadModel });
            this.prioridadModel.fetch();
        },

        //Contratos
        getContratosMain: function(){
            if ( this.mainContratoView instanceof Backbone.View ){
                this.mainContratoView.stopListening();
                this.mainContratoView.undelegateEvents();
            }
            this.mainContratoView = new app.MainContratosView( );

        },

        /**
        * show view show contratos
        */
        getContratoShow: function (contrato) {
            this.contratoModel = new app.ContratoModel();
            this.contratoModel.set({'id': contrato}, {silent: true});

            if ( this.showContratoView instanceof Backbone.View ){
                this.showContratoView.stopListening();
                this.showContratoView.undelegateEvents();
            }

           this.showContratoView = new app.ShowContratoView({ model: this.contratoModel });
        },

        /**
        * show view create Contratos
        */


       getContratosCreate:function(){
            this.contratoModel = new app.ContratoModel();

            if ( this.createContratoView instanceof Backbone.View ){
                this.createContratoView.stopListening();
                this.createContratoView.undelegateEvents();
            }

            this.createContratoView = new app.CreateContratoView({ model: this.contratoModel });
            this.createContratoView.render();
        },

         getContratosEdit: function (contrato) {
            this.contratoModel = new app.ContratoModel();
            this.contratoModel.set({'id': contrato}, {'silent':true});

            if ( this.createContratoView instanceof Backbone.View ){
                this.createContratoView.stopListening();
                this.createContratoView.undelegateEvents();
            }

            this.createContratoView = new app.CreateContratoView({ model: this.contratoModel });
            this.contratoModel.fetch();
        },

        /**
        * show view main ordenes
        */
        getOrdenesMain: function () {
            if ( this.mainOrdenesView instanceof Backbone.View ){
                this.mainOrdenesView.stopListening();
                this.mainOrdenesView.undelegateEvents();
            }

            this.mainOrdenesView = new app.MainOrdenesView( );
        },

        /**
        * show view create ordenes
        */
        getOrdenesCreate: function () {
            this.ordenModel = new app.OrdenModel();

            if ( this.createOrdenView instanceof Backbone.View ){
                this.createOrdenView.stopListening();
                this.createOrdenView.undelegateEvents();
            }

            this.createOrdenView = new app.CreateOrdenView({ model: this.ordenModel });
            this.createOrdenView.render();
        },

        /**
        * show view edit ordenes
        */
        getOrdenesEdit: function (orden) {
            this.ordenModel = new app.OrdenModel();
            this.ordenModel.set({'id': orden}, {'silent':true});

            if ( this.createOrdenView instanceof Backbone.View ){
                this.createOrdenView.stopListening();
                this.createOrdenView.undelegateEvents();
            }

            this.createOrdenView = new app.CreateOrdenView({ model: this.ordenModel });
            this.ordenModel.fetch();
        },

        // Zonas
        getZonasMain: function () {

            if ( this.mainZonaView instanceof Backbone.View ){
                this.mainZonaView.stopListening();
                this.mainZonaView.undelegateEvents();
            }

            this.mainZonaView = new app.MainZonasView( );
        },

        getZonasCreate: function () {
            this.zonaModel = new app.ZonaModel();

            if ( this.createZonaView instanceof Backbone.View ){
                this.createZonaView.stopListening();
                this.createZonaView.undelegateEvents();
            }

            this.createZonaView = new app.CreateZonaView({ model: this.zonaModel });
            this.createZonaView.render();
        },

        getZonasEdit: function (zonas) {
            this.zonaModel = new app.ZonaModel();
            this.zonaModel.set({'id': zonas}, {'silent':true});

            if ( this.createZonaView instanceof Backbone.View ){
                this.createZonaView.stopListening();
                this.createZonaView.undelegateEvents();
            }

            this.createZonaView = new app.CreateZonaView({ model: this.zonaModel });
            this.zonaModel.fetch();
        },

        // Envio Equipo
        getAsignacionMain: function () {

            if (this.mainAsignacionView instanceof Backbone.View ){
                this.mainAsignacionView.stopListening();
                this.mainAsignacionView.undelegateEvents();
            }

            this.mainAsignacionView = new app.MainAsignacionView();
        },

        getAsignacionCreate: function (queryString) {
            var queries = this.parseQueryString(queryString);
            this.envioequipoModel = new app.AsignacionModel();

            if ( this.createAsignacionView instanceof Backbone.View ){
                this.createAsignacionView.stopListening();
                this.createAsignacionView.undelegateEvents();
            }

            this.createAsignacionView = new app.CreateAsignacionView({
                model: this.envioequipoModel,
                parameters: {
                    type: queries.tipo
                }
            });
            this.createAsignacionView.render();
        },

        getAsignacionShow: function (asignacion) {
            this.asignacionModel = new app.AsignacionModel();
            this.asignacionModel.set({'id': asignacion}, {'silent':true});

            if ( this.showAsignacionView instanceof Backbone.View ){
                this.showAsignacionView.stopListening();
                this.showAsignacionView.undelegateEvents();
            }

            this.showEquipoEnvioView = new app.ShowAsignacionView({ model: this.asignacionModel });
        },

    }) );

})(jQuery, this, this.document);