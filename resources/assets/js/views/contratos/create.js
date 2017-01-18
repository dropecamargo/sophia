/**
* Class CreateContratoView  of Backbone Router
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

//Global App Backbone
app || (app = {});

(function ($, window, document, undefined) {

    app.CreateContratoView = Backbone.View.extend({

        el: '#contratos-create',
        template: _.template( ($('#add-contrato-tpl').html() || '') ),
        events: {
            'click .submit-contrato': 'submitOrdenp',
            'submit #form-contratos': 'onStore'
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
            this.$wraperForm = this.$('#render-form-contrato');

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

            this.$form = this.$('#form-contratos');

            // Model exist
            if( this.model.id != undefined ) {

                // Reference views
                this.referenceViews();
            }

            this.ready();
        },

        /**
        * reference to views
        
        referenceViews: function () {
            // Productos list
            this.productopOrdenListView = new app.ProductopOrdenListView( {
                collection: this.productopOrdenList,
                parameters: {
                    edit: true,
                    wrapper: this.$('#wrapper-productop-orden'),
                    dataFilter: {
                        'orden2_orden': this.model.get('id')
                    }
               }
            });
        },

        /**
        * Event Create orden
        */
        onStore: function (e) {
            if (!e.isDefaultPrevented()) {

                e.preventDefault();
                var data = window.Misc.formToJson( e.target );
                this.model.save( data, {patch: true, silent: true} );
            }
        },

        /**
        * fires libraries js
        */
        ready: function () {
            // to fire plugins
            if( typeof window.initComponent.initToUpper == 'function' )
                window.initComponent.initToUpper();

            if( typeof window.initComponent.initTimePicker == 'function' )
                window.initComponent.initTimePicker();

            if( typeof window.initComponent.initSelect2 == 'function' )
                window.initComponent.initSelect2();

            if( typeof window.initComponent.initValidator == 'function' )
                window.initComponent.initValidator();

            if( typeof window.initComponent.initInputMask == 'function' )
                window.initComponent.initInputMask();

            if( typeof window.initComponent.initDatePicker == 'function' )
                window.initComponent.initDatePicker();
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

                // FacturapView undelegateEvents
                if ( this.createOrdenpView instanceof Backbone.View ){
                    this.createOrdenpView.stopListening();
                    this.createOrdenpView.undelegateEvents();
                }

                // Redirect to edit orden
                Backbone.history.navigate(Route.route('contratos.edit', { contratos: resp.id}), { trigger:true });
            }
        }
    });

})(jQuery, this, this.document);
