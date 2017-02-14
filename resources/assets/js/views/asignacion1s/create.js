/**
* Class CreateAsignacion1View  of Backbone Router
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

//Global App Backbone
app || (app = {});

(function ($, window, document, undefined) {

    app.CreateAsignacion1View = Backbone.View.extend({

        el: '#asignacion1-create',
        template: _.template( ($('#add-asignacion1-tpl').html() || '') ),
        events: {
            'click .submit-asignacion1': 'submitAsignacion1',
            'click .btn-koi-search-tercero-component-table': 'limpiar',
            'submit #form-asignacion1': 'onStore',
            'submit #form-asignacion2': 'onStoreA2'
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
            this.$wraperForm = this.$('#render-form-asignacion1');

            this.asignacion2sList = new app.Asignacion2sList();

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

            // References
            this.$form = this.$('#form-asignacion1');
            this.$formItem = this.$('#form-asignacion2');

            this.$inputContacto = $('#tcontacto_nombre');
            this.$inputTcontacto = $('#tcontacto_telefono');
            this.$inputContrato = $('#nombre_contrato');

            // Reference views
            this.referenceViews();
        },


        /**
        * reference to views
        */
        referenceViews: function () {
            // Detalle traslado list
            this.asignacion2sListView = new app.Asignacion2sListView({
                collection: this.asignacion2sList,
                parameters: {
                    wrapper: this.el,
                    edit: true
                }
            });
        },

        /**
        * Event submit asignacion1
        */
        submitAsignacion1: function (e) {
            this.$form.submit();
        },

        limpiar: function(){
            this.$inputContrato.val('');
            this.$inputTcontacto.val('');
            this.$inputContacto.val('');
        },

        /**
        * Event Create Folder
        */
        onStore: function (e) {

            if (!e.isDefaultPrevented()) {

                e.preventDefault();
                var data = window.Misc.formToJson( e.target );
                data.asignacion2 = this.asignacion2sList.toJSON();

                this.model.save( data, {patch: true, silent: true} );
            }
        },

        /**
        * Event add item detalle traslado
        */
        onStoreA2: function (e) {
            if (!e.isDefaultPrevented()) {

                e.preventDefault();
                this.asignacion2sList.trigger( 'store', this.$(e.target) );
            }
        },

        /**
        * fires libraries js
        */
        ready: function () {
            // to fire plugins
            if( typeof window.initComponent.initICheck == 'function' )
                window.initComponent.initICheck();
            
            if( typeof window.initComponent.initToUpper == 'function' )
                window.initComponent.initToUpper();
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

                window.Misc.redirect( window.Misc.urlFull( Route.route('asignaciones.show', { asignaciones: resp.id})) );
            }
        }
    });

})(jQuery, this, this.document);
