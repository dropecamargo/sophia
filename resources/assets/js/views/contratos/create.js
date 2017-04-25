/**
* Class CreateContratoView  of Backbone Router
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

//Global App Backbone
app || (app = {});

(function ($, window, document, undefined){

    app.CreateContratoView = Backbone.View.extend({

        el: '#contratos-create',
        template: _.template( ($('#add-contrato-tpl').html() || '') ),
        events: {
            'submit #form-contrato': 'onStore',
            'submit #form-danoc': 'onStoreDano',
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
            this.msgSuccess = 'Contrato guardado con exito!';
            this.$wraperForm = this.$('#render-form-contrato');

            // Model exist
            if( this.model.id != undefined ) {
                this.contratosList = new app.ContratosList();
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
            this.$form = this.$('#form-contrato');

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
            // Contratos list
            this.contratosListView = new app.ContratosListView( {
                collection: this.contratosList,
                parameters: {
                    edit: true,
                    wrapper: this.$('#wrapper-danos-contrato'),
                    dataFilter: {
                        'contrato_id': this.model.get('id')
                    }
               }
            });
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
        * Event Create Dano
        */
        onStoreDano: function (e) {
            if (!e.isDefaultPrevented()) {
                e.preventDefault();

                // Prepare global data
                var data = window.Misc.formToJson( e.target );
                this.contratosList.trigger( 'store', data );
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

            if( typeof window.initComponent.initICheck == 'function' )
                window.initComponent.initICheck();

            if( typeof window.initComponent.initValidator == 'function' )
                window.initComponent.initValidator();

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

                alertify.success(this.msgSuccess);

                // ContratoView undelegateEvents
                if ( this.createContratoView instanceof Backbone.View ){
                    this.createContratoView.stopListening();
                    this.createContratoView.undelegateEvents();
                }

                // Redirect to edit contrato
                Backbone.history.navigate(Route.route('contratos.edit', { contratos: resp.id}), { trigger:true });
            }
        }
    });

})(jQuery, this, this.document);
