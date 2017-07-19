/**
* Class EditOrdenView  of Backbone Router
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

//Global App Backbone
app || (app = {});

(function ($, window, document, undefined) {

    app.EditOrdenView = Backbone.View.extend({

        el: '#ordenes-create',
        template: _.template( ($('#add-orden-tpl').html() || '') ),
        events: {
        	'click .submit-orden': 'submitOrden',
            'submit #form-orden': 'onStore',
        	'click .submit-visitas': 'submitVisita',
            'submit #form-visitas': 'onStoreVisita',
            'submit #form-contadoresp': 'onStoreContadoresp',
            'submit #form-visitasp': 'onStoreVisitap',
        },

        /**
        * Constructor Method
        */
        initialize : function() {
            _.bindAll(this, 'onCompleteLoadFile', 'onSessionRequestComplete');
            
        	//Model Exists
            this.visita = new app.VisitaCollection();
            this.visitap = new app.VisitapCollection();
            this.contadoresp = new app.ContadorespCollection(); 

            // Initialize
            this.listenTo( this.model, 'change', this.render );
            this.listenTo( this.model, 'sync', this.responseServer );
            this.listenTo( this.model, 'request', this.loadSpinner );
        },

        /*
        * Render View Element
        */
        render: function() {
            var attributes = this.model.toJSON();
            	attributes.edit = true;

            this.$el.html( this.template(attributes) );
            this.$form = this.$('#form-orden');

            // Spinner
            this.spinner = this.$('#spinner-main');

            // forms
            this.$formvisitasp = this.$('#form-visitas');
            this.$formcontadoresp = this.$('#form-contadoresp');
            this.$uploaderFile = this.$('#fine-uploader');

            // Reference views
            this.referenceViews();
            this.uploadPictures();

            // to fire plugins
            this.ready();
		},

		/**
        *Event Click to Button from orden
        */
        submitOrden:function(e){
            this.$form.submit();
        },

        /**
        * Event Create orden
        */
        onStore: function (e) {
            if (!e.isDefaultPrevented()) {
                e.preventDefault();

                // Prepare global data
                var data = window.Misc.formToJson( e.target );
                this.model.save( data, {patch: true, silent: true} );
            }
        },

        /**
        * Reference view
        */
        referenceViews:function(){
            this.visitasView = new app.VisitasView( {
                collection: this.visita,
                parameters: {
                    edit: true,
                    wrapper: this.$('#wrapper-visitas'),
                    dataFilter: {
                        'orden_id': this.model.get('id')
                    }
                }
            });

            this.visitaspView = new app.VisitaspView( {
                collection: this.visitap,
                parameters: {
                    edit: true,
                    wrapper: this.$('#wrapper-visitasp'),
                    dataFilter: {
                        'orden_id': this.model.get('id')
                    }
                }
            });

            this.contadorespView = new app.ContadorespView( {
                collection: this.contadoresp,
                parameters: {
                    edit: true,
                    wrapper: this.$('#wrapper-contadoresp'),
                    dataFilter: {
                        'producto_id': this.model.get('id_p')
                    }
                }
            });
        },

        /**
        * UploadPictures
        */
        uploadPictures: function(e) {
            var _this = this;

            this.$uploaderFile.fineUploader({
                debug: false,
                template: 'qq-template',
                session: {
                    endpoint: window.Misc.urlFull(Route.route('ordenes.imagenes.index')),
                    params: {
                        'orden_id': _this.model.get('id')
                    },
                    refreshOnRequest: false
                },
                request: {
                    inputName: 'file',
                    endpoint: window.Misc.urlFull( Route.route( 'ordenes.imagenes.index' ) ),
                    params: {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        'orden_id': _this.model.get('id')
                    }
                },
                deleteFile: {
                    enabled: true,
                    confirmMessage: 'Are you sure you want to delete {filename}?',
                    endpoint: window.Misc.urlFull( Route.route( 'ordenes.imagenes.index' ) ),
                    params: {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        'orden_id': _this.model.get('id')   
                    }
                },
                validation: {
                    itemLimit: 5,
                    sizeLimit: ( 4 * 1024 ) * 1024, // 4mb,
                    allowedExtensions: ['jpeg', 'jpg', 'png'],
                },
                messages: {
                    typeError: '{file} extensión no valida. Extensiones validas: {extensions}.',
                    sizeError: '{file} es demasiado grande, el tamaño máximo del archivo es {minSizeLimit}.',
                },
                callbacks: {
                    onComplete: _this.onCompleteLoadFile,
                    onSessionRequestComplete: _this.onSessionRequestComplete,
                }
            });
        },

        /**
        * complete upload of file
        * @param Number id
        * @param Strinf name
        * @param Object resp
        */
        onCompleteLoadFile: function (id, name, resp) {

            var $itemFile = this.$uploaderFile.fineUploader('getItemByFileId', id);
            this.$uploaderFile.fineUploader('setUuid', id, resp.id);
            this.$uploaderFile.fineUploader('setName', id, resp.name);
                
            var previewLink = this.$uploaderFile.fineUploader('getItemByFileId', id).find('.preview-link');
            previewLink.attr("href", resp.url);
        },

        onSessionRequestComplete: function (id, name, resp){
            _.each( id, function (item, i){
                var previewLink = this.$uploaderFile.fineUploader('getItemByFileId', i).find('.preview-link');
                previewLink.attr("href", item.thumbnailUrl);
            }, this);
        },

        submitVisita:function(e){
            this.$formvisitasp.submit();
        },

        /**
        * Event Create visita
        */
        onStoreVisita: function (e) {
            if (!e.isDefaultPrevented()) {
                e.preventDefault();

                var data = window.Misc.formToJson( e.target );
                    data.visita_orden = this.model.get('id');
                
                // Contadores
                data = $.extend({}, data, window.Misc.formToJson( this.$formcontadoresp ));

                // Repuestos
                data.visitap = this.visitap.toJSON();
                this.visita.trigger( 'store', data );
            }
        },  

        /**
        * Event Create visitap
        */
        onStoreVisitap: function (e) {
            if (!e.isDefaultPrevented()) {
                e.preventDefault();

                var data = window.Misc.formToJson( e.target );
                this.visitap.trigger( 'store', data );
            }
        },

        onStoreContadoresp: function (e){
            if (!e.isDefaultPrevented()) {
                e.preventDefault();

                var data = window.Misc.formToJson( e.target );
                console.log(data);
                // this.visitap.trigger( 'store', data );
            }
        },

        /**
        * fires libraries js
        */
        ready: function () {
            // to fire plugins
            if( typeof window.initComponent.initToUpper == 'function' )
                window.initComponent.initToUpper();

            if( typeof window.initComponent.initICheck == 'function' )
                window.initComponent.initICheck();

            if( typeof window.initComponent.initValidator == 'function' )
                window.initComponent.initValidator();

            if( typeof window.initComponent.initDatePicker == 'function' )
                window.initComponent.initDatePicker();

            if( typeof window.initComponent.initInputMask == 'function' )
                window.initComponent.initInputMask();

            if( typeof window.initComponent.initSelect2 == 'function' )
                window.initComponent.initSelect2();

            if( typeof window.initComponent.initTimePicker == 'function' )
                window.initComponent.initTimePicker();

            if( typeof window.initComponent.initFineUploader == 'function' )
                window.initComponent.initFineUploader();
        },

        /**
        * Load spinner on the request
        */
        loadSpinner: function (model, xhr, opts) {
            window.Misc.setSpinner( this.spinner );
        },

        /**
        * response of the server
        */
        responseServer: function ( model, resp, opts ) {
            window.Misc.removeSpinner( this.spinner );

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

				// Redirect to show view                
				window.Misc.redirect( window.Misc.urlFull( Route.route('ordenes.edit', { ordenes: resp.id}) ) );
            }
        }
    });

})(jQuery, this, this.document);
