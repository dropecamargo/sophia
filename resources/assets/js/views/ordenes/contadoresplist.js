/**
* Class ContadorespView  of Backbone Router
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

//Global App Backbone
app || (app = {});

(function ($, window, document, undefined) {

    app.ContadorespView = Backbone.View.extend({

       el: '#browse-orden-contadoresp-list',
        events: {
               'click .item-contadoresp-remove': 'removeOne'
        },
        parameters: {
            wrapper:false,
            edit:false,
            dataFilter: {}
        },

        /**
        * Constructor Method
        */
        initialize : function(opts){
            
            // extends parameters
            if( opts !== undefined && _.isObject(opts.parameters) )
                this.parameters = $.extend({},this.parameters, opts.parameters);
            
         
            // Events Listeners
            this.listenTo( this.collection, 'add', this.addOne );
            this.listenTo( this.collection, 'reset', this.addAll );
            this.listenTo( this.collection, 'store', this.storeOne );
            this.listenTo( this.collection, 'request', this.loadSpinner);
            this.listenTo( this.collection, 'sync', this.responseServer);

            this.collection.fetch({ data: {producto_id: this.parameters.dataFilter.producto_id}, reset: true });

        },

        /*
        * Render View Element
        */
        render: function() {

        },

        /**
        * Render view contact by model
        * @param Object contadorespModel Model instance
        */
        addOne: function (contadorespModel) {
            var view = new app.ContadoresItemView({
                model: contadorespModel,
                parameters: {
                    edit: this.parameters.edit
                }
            });
            contadorespModel.view = view;
         
            this.$el.append( view.render().el );
         
        },

        /**
        * Render all view Marketplace of the collection
        */
        addAll: function () {
            
             this.collection.forEach( this.addOne, this );
        },

        storeOne: function (data) {
           var _this = this;

            // Set Spinner
            window.Misc.setSpinner( this.parameters.wrapper );

            // Prepare data
            data.producto_id = this.parameters.dataFilter.producto_id;

            // Add model in collection
            var contadorespModel = new app.ContadorespModel();
            contadorespModel.save(data, {
                success : function(model, resp) {
                    if(!_.isUndefined(resp.success)) {
                        window.Misc.removeSpinner( _this.parameters.wrapper );

                        // response success or error
                        var text = resp.success ? '' : resp.errors;
                        if( _.isObject( resp.errors ) ) {
                            text = window.Misc.parseErrors(resp.errors);
                        }

                        if( !resp.success ) {
                            alertify.error(text);
                            return;
                        }

                        // Add model in collection
                        //_this.collection.add(model);
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

            var resource = $(e.currentTarget).attr("data-resource"),
                model = this.collection.get(resource),
                _this = this;

            if ( model instanceof Backbone.Model ) {
                model.destroy({
                    success : function(model, resp) {
                        if(!_.isUndefined(resp.success)) {
                            window.Misc.removeSpinner( _this.parameters.wrapper );

                            if( !resp.success ) {
                                alertify.error(resp.errors);
                                return;
                            }

                            model.view.remove();
                        }
                    }
                });

            }
        },

        /**
        * Load spinner on the request
        */
        loadSpinner: function ( target, xhr, opts ) {
            window.Misc.setSpinner( this.parameters.wrapper );
        },

        /**
        * response of the server
        */
        responseServer: function ( target, resp, opts ) {
            window.Misc.removeSpinner( this.parameters.wrapper );
        }
   });

})(jQuery, this, this.document);
