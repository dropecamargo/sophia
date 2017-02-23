/**
* Class ComponentCreateResourceView  of Backbone
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

//Global App Backbone
app || (app = {});

(function ($, window, document, undefined) {

    app.ComponentCreateResourceView = Backbone.View.extend({

      	el: 'body',
		events: {
            'click .btn-add-resource-koi-component': 'addResource',
            'submit #form-create-resource-component': 'onStore'
		},
        parameters: {
        },

        /**
        * Constructor Method
        */
		initialize: function(opts) {
            // extends parameters
            if( opts !== undefined && _.isObject(opts.parameters) )
                this.parameters = $.extend({},this.parameters, opts.parameters);

			// Initialize
            this.$modalComponent = this.$('#modal-add-resource-component');
            this.$wraperError = this.$('#error-resource-component');
            this.$wraperContent = this.$('#content-create-resource-component').find('.modal-body');
		},

		/**
        * Display form modal resource
        */
		addResource: function(e) {
            // References
            this.resource = $(e.currentTarget).attr("data-resource");
            this.$resourceField = $("#"+$(e.currentTarget).attr("data-field"));
            this.parameters = {};

            if(this.resource == 'contacto') {
                this.$inputPhone = this.$("#"+$(e.currentTarget).attr("data-phone"));
                this.$inputAddress = this.$("#"+$(e.currentTarget).attr("data-address"));
                this.$inputCity = this.$("#"+$(e.currentTarget).attr("data-city"));
                this.$inputEmail = this.$("#"+$(e.currentTarget).attr("data-email"));
                this.parameters.tcontacto_tercero = $(e.currentTarget).attr("data-tercero");
                if( _.isUndefined(this.parameters.tcontacto_tercero) || _.isNull(this.parameters.tcontacto_tercero) || this.parameters.tcontacto_tercero == '') {
                    alertify.error('Por favor ingrese cliente antes agregar contacto.');
                    return;
                }
            }

            // stuffToDo resource
            var _this = this,
	            stuffToDo = {
                    'marca' : function() {
                        _this.$modalComponent.find('.inner-title-modal').html('Marca');

                        _this.model = new app.MarcaModel();
                        var template = _.template($('#add-marca-tpl').html());
                        _this.$modalComponent.find('.content-modal').html( template(_this.model.toJSON()) );
                    },
                    'tipo' : function() {
                        _this.$modalComponent.find('.inner-title-modal').html('Tipo');

                        _this.model = new app.TipoModel();
                        var template = _.template($('#add-tipo-tpl').html());
                        _this.$modalComponent.find('.content-modal').html( template(_this.model.toJSON()) );
                    },
                    'tipoorden' : function() {
                        _this.$modalComponent.find('.inner-title-modal').html('Tipo Orden');

                        _this.model = new app.TipoOrdenModel();
                        var template = _.template($('#add-tipoorden-tpl').html());
                        _this.$modalComponent.find('.content-modal').html( template(_this.model.toJSON()) );
                    },
                    'modelo' : function() {
                        _this.$modalComponent.find('.inner-title-modal').html('Modelo');

                        _this.model = new app.ModeloModel();
                        var template = _.template($('#add-modelo-tpl').html());
                        _this.$modalComponent.find('.content-modal').html( template(_this.model.toJSON()) );
                    },
                    'estado' : function() {
                        _this.$modalComponent.find('.inner-title-modal').html('Estado');

                        _this.model = new app.EstadoModel();
                        var template = _.template($('#add-estado-tpl').html());
                        _this.$modalComponent.find('.content-modal').html( template(_this.model.toJSON()) );
                    },
                    'dano' : function() {
                        _this.$modalComponent.find('.inner-title-modal').html('Daño');

                        _this.model = new app.DanoModel();
                        var template = _.template($('#add-dano-tpl').html());
                        _this.$modalComponent.find('.content-modal').html( template(_this.model.toJSON()) );
                    },

                    'prioridad' : function() {
                        _this.$modalComponent.find('.inner-title-modal').html('Prioridad');

                        _this.model = new app.PrioridadModel();
                        var template = _.template($('#add-prioridad-tpl').html());
                        _this.$modalComponent.find('.content-modal').html( template(_this.model.toJSON()) );
                    },
                    'solicitante' : function() {
                        _this.$modalComponent.find('.inner-title-modal').html('Solicitante');

                        _this.model = new app.SolicitanteModel();
                        var template = _.template($('#add-solicitante-tpl').html());
                        _this.$modalComponent.find('.content-modal').html( template(_this.model.toJSON()) );
                    },

	                'tercero' : function() {
                        _this.$modalComponent.find('.inner-title-modal').html('Tercero');

                        _this.model = new app.TerceroModel();
                        var template = _.template($('#add-tercero-tpl').html());
                        _this.$modalComponent.find('.content-modal').html( template(_this.model.toJSON()) );

                        _this.$formAccounting = _this.$modalComponent.find('#form-accounting');
                    },
                    'producto' : function() {
                        _this.$modalComponent.find('.inner-title-modal').html('Producto');

                        _this.model = new app.ProductoModel();
                        var template = _.template($('#add-producto-tpl').html());
                        _this.$modalComponent.find('.content-modal').html( template(_this.model.toJSON()) );
                    },
                    'pcontador' : function() {
                        _this.$modalComponent.find('.inner-title-modal').html('Producto Contador');

                        _this.model = new app.ContadorModel();
                        var template = _.template($('#add-contador-tpl').html());
                        _this.$modalComponent.find('.content-modal').html( template(_this.model.toJSON()) );
                    },
                    'contacto' : function() {
                        _this.$resourceName = $("#"+$(e.currentTarget).attr("data-name"));
                        _this.$modalComponent.find('.inner-title-modal').html('Contacto');

                        _this.model = new app.ContactoModel();
                        var template = _.template($('#add-contacto-tpl').html());
                        _this.$modalComponent.find('.content-modal').html( template(_this.model.toJSON()) );
                    },
	            };

            if (stuffToDo[this.resource]) {
                stuffToDo[this.resource]();

                this.$wraperError.hide().empty();

	            // Events
            	this.listenTo( this.model, 'sync', this.responseServer );
            	this.listenTo( this.model, 'request', this.loadSpinner );

                // to fire plugins
                this.ready();

				this.$modalComponent.modal('show');
            }
		},

        /**
        * fires libraries js
        */
        ready: function () {
            // to fire plugins
            if( typeof window.initComponent.initToUpper == 'function' )
                window.initComponent.initToUpper();

            if( typeof window.initComponent.initInputMask == 'function' )
                window.initComponent.initInputMask();

            if( typeof window.initComponent.initSelect2 == 'function' )
                window.initComponent.initSelect2();

            if( typeof window.initComponent.initICheck == 'function' )
                window.initComponent.initICheck();
        },

        /**
        * Event Create Post
        */
        onStore: function (e) {

            if (!e.isDefaultPrevented()) {

                this.$wraperError.hide().empty();

                e.preventDefault();
                var data = $.extend({}, this.parameters, window.Misc.formToJson( e.target ));

                if (this.resource == 'tercero') {
                    data = $.extend({}, data, window.Misc.formToJson( this.$formAccounting ));
                }

                this.model.save( data, {patch: true} );
            }
        },

        /**
        * Load spinner on the request
        */
        loadSpinner: function (model, xhr, opts) {
            window.Misc.setSpinner( this.$wraperContent );
        },

        /**
        * response of the server
        */
        responseServer: function ( model, resp, opts ) {
            window.Misc.removeSpinner( this.$wraperContent );

            // response success or error
            var text = resp.success ? '' : resp.errors;
            if( _.isObject( resp.errors ) ) {
                text = window.Misc.parseErrors(resp.errors);
            }

            if( !resp.success ) {
                this.$wraperError.empty().append(text);
                this.$wraperError.show();
                return;
            }

            // stuffToDo Response success
            var _this = this,
                stuffToDo = {
                    'marca' : function() {
                        _this.$resourceField.select2({ data: [{id: _this.model.get('id'), text: _this.model.get('marca_modelo')}] }).trigger('change');
                        _this.$resourceField.val(_this.model.get('id')).trigger('change');
                    },
                    'tipo' : function() {
                        _this.$resourceField.select2({ data: [{id: _this.model.get('id'), text: _this.model.get('tipo_nombre')}] }).trigger('change');
                        _this.$resourceField.val(_this.model.get('id')).trigger('change');
                    },
                    'tipoorden' : function() {
                        _this.$resourceField.select2({ data: [{id: _this.model.get('id'), text: _this.model.get('tipoorden_nombre')}] }).trigger('change');
                        _this.$resourceField.val(_this.model.get('id')).trigger('change');
                    },
                    'modelo' : function() {
                        _this.$resourceField.select2({ data: [{id: _this.model.get('id'), text: _this.model.get('modelo_nombre')}] }).trigger('change');
                        _this.$resourceField.val(_this.model.get('id')).trigger('change');
                    },
                    'estado' : function() {
                        _this.$resourceField.select2({ data: [{id: _this.model.get('id'), text: _this.model.get('estado_nombre')}] }).trigger('change');
                        _this.$resourceField.val(_this.model.get('id')).trigger('change');
                    },
                    'dano' : function() {
                       _this.$resourceField.select2({ data: [{id: _this.model.get('id'), text: _this.model.get('dano_nombre')}] }).trigger('change');
                        _this.$resourceField.val(_this.model.get('id')).trigger('change');
                    },
                    'prioridad' : function() {
                       _this.$resourceField.select2({ data: [{id: _this.model.get('id'), text: _this.model.get('prioridad_nombre')}] }).trigger('change');
                        _this.$resourceField.val(_this.model.get('id')).trigger('change');
                    },
                     'solicitante' : function() {
                       _this.$resourceField.select2({ data: [{id: _this.model.get('id'), text: _this.model.get('solicitante_nombre')}] }).trigger('change');
                        _this.$resourceField.val(_this.model.get('id')).trigger('change');
                    },
                    'tercero' : function() {
                        _this.$resourceField.val(_this.model.get('tercero_nit')).trigger('change');
                    },
                    'producto' : function() {
                        _this.$resourceField.val(_this.model.get('sirvea_codigo')).trigger('change');
                    },
                    'pcontador' : function() {
                       _this.$resourceField.select2({ data: [{id: _this.model.get('id'), text: _this.model.get('contador_nombre')}] }).trigger('change');
                        _this.$resourceField.val(_this.model.get('id')).trigger('change');
                    },
                    'contacto' : function() {
                        _this.$resourceField.val(_this.model.get('id'));
                        _this.$resourceName.val(_this.model.get('tcontacto_nombre'));

                        if(_this.$inputPhone.length) {
                            _this.$inputPhone.val( _this.model.get('tcontacto_telefono') );
                        }

                        if(_this.$inputAddress.length) {
                            _this.$inputAddress.val( _this.model.get('tcontacto_direccion') );
                        }

                        if(_this.$inputEmail.length) {
                            _this.$inputEmail.val( _this.model.get('tcontacto_email') );
                        }

                        if(_this.$inputCity.length) {
                            _this.$inputCity.val( _this.model.get('tcontacto_municipio') ).trigger('change');
                        }
                    },
                };

            if (stuffToDo[this.resource]) {
                stuffToDo[this.resource]();

                // Fires libraries js
                if( typeof window.initComponent.initSelect2 == 'function' )
                    window.initComponent.initSelect2();

                this.$modalComponent.modal('hide');
            }
        }
    });


})(jQuery, this, this.document);
