/**
* Class TrasladoProductosListView of Backbone Router
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

//Global App Backbone
app || (app = {});

(function ($, window, document, undefined) {

    app.AsignacionDetalleListView = Backbone.View.extend({

        el: '#browse-asignacion2-list',
        events: {
            'click .item-asignacion2-remove': 'removeOne'
        },
        parameters: {
            wrapper: null,
            edit: false,
            dataFilter: {}
        },

        /**
        * Constructor Method
        */
        initialize : function(opts){
            // extends parameters
            if( opts !== undefined && _.isObject(opts.parameters) )
                this.parameters = $.extend({},this.parameters, opts.parameters);

            this.parameters.wrapper

            // Init Attributes
            this.confCollection = { reset: true, data: {} };

            // // Events Listeners
            this.listenTo( this.collection, 'add', this.addOne );
            this.listenTo( this.collection, 'reset', this.addAll );
            this.listenTo( this.collection, 'request', this.loadSpinner );
            this.listenTo( this.collection, 'store', this.storeOne );
            this.listenTo( this.collection, 'sync', this.responseServer );

            /* if was passed asignacion2 code */
            if( !_.isUndefined(this.parameters.dataFilter.asignacion2) && !_.isNull(this.parameters.dataFilter.asignacion2) ){
                this.confCollection.data.asignacion2 = this.parameters.dataFilter.asignacion2;
                this.collection.fetch( this.confCollection );
            }
        },

        /**
        * Render view task by model
        * @param Object mentoringTaskModel Model instance
        */
        addOne: function (asignacionDetalleModel) {
            var view = new app.AsignacionDetalleItemView({
                model: asignacionDetalleModel,
                parameters: {
                    edit: this.parameters.edit
                }
            });
            asignacionDetalleModel.view = view;
            this.$el.append( view.render().el );
        },

        /**
        * Render all view tast of the collection
        */
        addAll: function () {
            this.collection.forEach( this.addOne, this );
        },

        /**
        * storescuenta
        * @param form element
        */
        storeOne: function (form, resource) {
            var _this = this;
            data = window.Misc.formToJson( form );
            data.tipo = this.parameters.dataFilter.tipo;
            data.tercero_id = resource.tercero_id;
            data.contrato_id = resource.contrato_id;

            // Validar carrito temporal
            var valid = this.collection.validar(data, resource);
            if(!valid.success) {
                alertify.error(valid.message);
                return;
            }

            // Set Spinner
            window.Misc.setSpinner( this.parameters.wrapper );

            // Add model in collection
            var asignaciondetalleModel = new app.AsignacionDetalleModel();
            asignaciondetalleModel.save(data, {
                success : function(model, resp) {
                    if(!_.isUndefined(resp.success)) {
                        window.Misc.removeSpinner( _this.parameters.wrapper );
                        var text = resp.success ? '' : resp.errors;
                        if( _.isObject( resp.errors ) ) {
                            text = window.Misc.parseErrors(resp.errors);
                        }

                        if( !resp.success ) {
                            alertify.error(text);
                            return;
                        }
                        // Add model in collection
                        _this.collection.add(model);

                        // Agregar accesorios de equipo en la collection
                        _.each(resp.accesorio, function(childs){
                            childs.idFather = resp.id;
                            _this.collection.add(childs);
                        });
                    }
                },
                error : function(model, error) {
                    window.Misc.removeSpinner( _this.parameters.wrapper );
                    alertify.error(error.statusText)
                }
            });
        },

        /**
        * Event remove item
        */
        removeOne: function (e) {
            e.preventDefault();

            var resource = $(e.currentTarget).attr("data-resource");
            var model = this.collection.get(resource);

            this.collection.eliminar( model );

            if ( model instanceof Backbone.Model ) {
                model.view.remove();
                this.collection.remove(model);
            }
        },

        /**
        * Load spinner on the request
        */
        loadSpinner: function (model, xhr, opts) {
            window.Misc.setSpinner( this.parameters.wrapper );
        },

        /**
        * response of the server
        */
        responseServer: function ( model, resp, opts ) {
            window.Misc.removeSpinner( this.parameters.wrapper );
        }
   });
})(jQuery, this, this.document);