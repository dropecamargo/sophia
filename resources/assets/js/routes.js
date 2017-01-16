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

            //Estados
            'estados(/)': 'getEstadosMain',
            'estados/create(/)': 'getEstadosCreate',
            'estados/:modelo/edit(/)': 'getEstadosEdit',

            //Contadores
            'contadores(/)': 'getContadoresMain',
            'contadores/create(/)': 'getContadoresCreate',
            'contadores/:contadores/edit(/)': 'getContadoresEdit',

            //Tipo de Orden
            'tiposorden(/)': 'getTiposOrdenMain',
            'tiposorden/create(/)': 'getTiposOrdenCreate',
            'tiposorden/:tiposorden/edit(/)': 'getTiposOrdenEdit',
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
            this.componentReportView = new app.ComponentReportView();
            this.componentTerceroView = new app.ComponentTerceroView();
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

        /**
        * show view main terceros
        */
        getTercerosMain: function () {

            if ( this.mainTerceroView instanceof Backbone.View ){
                this.mainTerceroView.stopListening();
                this.mainTerceroView.undelegateEvents();
            }

            this.mainTerceroView = new app.MainTerceroView( );
        },

        /**
        * show view create terceros
        */
        getTercerosCreate: function () {
            this.terceroModel = new app.TerceroModel();

            if ( this.createTerceroView instanceof Backbone.View ){
                this.createTerceroView.stopListening();
                this.createTerceroView.undelegateEvents();
            }

            this.createTerceroView = new app.CreateTerceroView({ model: this.terceroModel });
            this.createTerceroView.render();
        },

        /**
        * show view show tercero
        */
        getTercerosShow: function (tercero) {
            this.terceroModel = new app.TerceroModel();
            this.terceroModel.set({'id': tercero}, {'silent':true});

            if ( this.showTerceroView instanceof Backbone.View ){
                this.showTerceroView.stopListening();
                this.showTerceroView.undelegateEvents();
            }

            this.showTerceroView = new app.ShowTerceroView({ model: this.terceroModel });
        },

        /**
        * show view edit terceros
        */
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

        /**
        * show view create actividades
        */
        getActividadesCreate: function () {
            this.actividadModel = new app.ActividadModel();

            if ( this.createActividadView instanceof Backbone.View ){
                this.createActividadView.stopListening();
                this.createActividadView.undelegateEvents();
            }

            this.createActividadView = new app.CreateActividadView({ model: this.actividadModel });
            this.createActividadView.render();
        },

        /**
        * show view edit actividades
        */
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

        /**
        * show view main sucursales
        */
        getSucursalesMain: function () {

            if ( this.mainSucursalesView instanceof Backbone.View ){
                this.mainSucursalesView.stopListening();
                this.mainSucursalesView.undelegateEvents();
            }

            this.mainSucursalesView = new app.MainSucursalesView( );
        },

        /**
        * show view create sucursales
        */
        getSucursalesCreate: function () {
            this.sucursalModel = new app.SucursalModel();

            if ( this.createSucursalView instanceof Backbone.View ){
                this.createSucursalView.stopListening();
                this.createSucursalView.undelegateEvents();
            }

            this.createSucursalView = new app.CreateSucursalView({ model: this.sucursalModel });
            this.createSucursalView.render();
        },

        /**
        * show view edit sucursales
        */
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

         /**
        * show view main departamentos
        */
        getDepartamentosMain: function () {

            if ( this.mainDepartamentoView instanceof Backbone.View ){
                this.mainDepartamentoView.stopListening();
                this.mainDepartamentoView.undelegateEvents();
            }

            this.mainDepartamentoView = new app.MainDepartamentoView( );
        },

        /**
        * show view main municipios
        */
        getMunicipiosMain: function () {

            if ( this.mainMunicipioView instanceof Backbone.View ){
                this.mainMunicipioView.stopListening();
                this.mainMunicipioView.undelegateEvents();
            }

            this.mainMunicipioView = new app.MainMunicipioView( );
        },

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

        /**
        * show view main Inventario
        */
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
        
    }) );

})(jQuery, this, this.document);