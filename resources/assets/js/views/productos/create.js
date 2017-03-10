/**
* Class CreateProductoView  of Backbone Router
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

//Global App Backbone
app || (app = {});

(function ($, window, document, undefined) {

    app.CreateProductoView = Backbone.View.extend({

        el: '#producto-create',
        template: _.template( ($('#add-producto-tpl').html() || '') ),
        events: {
            'click .submit-producto': 'submitProducto',
            'submit #form-producto': 'onStore',
            'submit #form-item-sirvea': 'onStoreItem',
            'submit #form-item-productocontador': 'onStorePcontador'
        },
        parameters: {
        },

        /**
        * Constructor Method
        */
        initialize : function(opts) {
            // Initialize
            if( opts !== undefined && _.isObject(opts.parameters) )
                this.parameters = $.extend({}, this.parameters, opts.parameters);

            // Attributes
            this.$wraperForm = this.$('#render-form-producto');

             // Model exist
            if( this.model.id != undefined ) {
                this.sirveasList = new app.SirveasList();
                this.productoscontadorList = new app.ProductosContadorList();
            }

            // Events
            this.listenTo( this.model, 'change', this.render );
            this.listenTo( this.model, 'sync', this.responseServer );
            this.listenTo( this.model, 'request', this.loadSpinner );
        },

        /*
        * Render View Element
        */
        render: function() {

            var attributes = this.model.toJSON();
            this.$wraperForm.html( this.template(attributes) );
            this.$form = this.$('#form-producto');
            // Model exist
            if( this.model.id != undefined ) {

                // Reference views
                this.referenceViews();
            }

            this.ready();
        },

        /**
        * reference to views
        */
        referenceViews: function () {

            if (this.model.get('tipo_codigo') != 'EQ') 
            {

                //Sirvea list
                this.sirveasListView = new app.SirveasListView( {
                    collection: this.sirveasList,
                    parameters: {
                        edit: true,
                        wrapper: this.$('#wrapper-producto-sirveas'),
                        dataFilter: {
                            'producto_id': this.model.get('id')
                        }
                   }
                });

            }else{

                //ProductoContador list
                this.productoscontadorListView = new app.ProductosContadorListView( {
                    collection: this.productoscontadorList,
                    parameters: {
                        edit: true,
                        wrapper: this.$('#wrapper-producto-productoscontador'),
                        dataFilter: {
                            'producto_id': this.model.get('id')
                        }
                   }
                });
            }
        },

        /**
        * Event submit producto
        */
        submitProducto: function (e) {
            this.$form.submit();
        },

        /**
        * Event Create Folder
        */
        onStore: function (e) {

            if (!e.isDefaultPrevented()) {

                e.preventDefault();
                var data = window.Misc.formToJson( e.target );
                this.model.save( data, {patch: true, silent: true} );
            }
        },

        /**
        * Event add item detalle traslado
        */
        onStoreItem: function (e) {

            if (!e.isDefaultPrevented()) {

                e.preventDefault();

                // Prepare global data
                var data = window.Misc.formToJson( e.target );
                this.sirveasList.trigger( 'store', data );
            }
        },

        /**
        * Event add productoitem detalle traslado
        */
        onStorePcontador: function (e) {

            if (!e.isDefaultPrevented()) {

                e.preventDefault();

                // Prepare global data
                var data = window.Misc.formToJson( e.target );
                this.productoscontadorList.trigger( 'store', data );
            }
        },

        /**
        * fires libraries js
        */
        ready: function () {
            // to fire plugins            
            if( typeof window.initComponent.initToUpper == 'function' )
                window.initComponent.initToUpper();

            if( typeof window.initComponent.initSelect2 == 'function' )
                window.initComponent.initSelect2();

            if( typeof window.initComponent.initValidator == 'function' )
                window.initComponent.initValidator();

            if( typeof window.initComponent.initInputMask == 'function' )
                window.initComponent.initInputMask();
        },

        /**
        * Load spinner on the request
        */
        loadSpinner: function (model, xhr, opts) {
            window.Misc.setSpinner( this.el );
        },

        /**
        * response of the server
        */
        responseServer: function ( model, resp, opts ) {
            window.Misc.removeSpinner( this.el );

            if(!_.isUndefined(resp.success)) {
                // response success or error
                var text = resp.success ? '' : resp.errors;
                if( _.isObject( resp.errors ) ) {
                    text = window.Misc.parseErrors(resp.errors);
                }

                if( !resp.success ) {
                    alertify.error(text);
                    return;
                }

                // ProductoView undelegateEvents
                if ( this.createProductoView instanceof Backbone.View ){
                    this.createProductoView.stopListening();
                    this.createProductoView.undelegateEvents();
                }

                // Redirect to edit producto
                Backbone.history.navigate(Route.route('productos.edit', { productos: resp.id}), { trigger:true });
            
            }
        }
    });

})(jQuery, this, this.document);
