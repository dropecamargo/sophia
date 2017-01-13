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
            'login(/)': 'getLogin',

            // Tecnico
            'marcas(/)': 'getMarcasMain',
            'marcas/create(/)': 'getMarcasCreate',
            'marcas/:marcas/edit(/)': 'getMarcasEdit',

            'modelos(/)': 'getModelosMain',
            'modelos/create(/)': 'getModelosCreate',
            'modelos/:modelo/edit(/)': 'getModelosEdit',
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

            if( document.domain.search("localhost") != '-1')
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
        * show view main TECNICO
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
                this.createMarcalView.undelegateEvents();
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

    }) );

})(jQuery, this, this.document);