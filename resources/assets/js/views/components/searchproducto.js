/**
* Class ComponentSearchProductoView of Backbone
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

//Global App Backbone
app || (app = {});

(function ($, window, document, undefined) {

    app.ComponentSearchProductoView = Backbone.View.extend({

      	el: 'body',
        template: _.template( ($('#koi-search-producto-component-tpl').html() || '') ),

		events: {
			'change input.producto-koi-component': 'productoChanged',
            'click .btn-koi-search-producto-component': 'searchProducto',
            'click .btn-search-koi-search-producto-component': 'search',
            'click .btn-clear-koi-search-producto-component': 'clear',
            'click .a-koi-search-producto-component-table': 'setProducto'
		},

        /**
        * Constructor Method
        */
		initialize: function() {
			// Initialize
            this.$modalComponent = this.$('#modal-search-producto-component');
		},

		searchProducto: function(e) {
            e.preventDefault();
            var _this = this;

            // Render template
            this.$modalComponent.find('.content-modal').html( this.template({ }) );

            // References
            this.$searchSerie = this.$('#koi_search_producto_serie');
            this.$searchNombre = this.$('#koi_search_producto_nombre');

            this.$productosSearchTable = this.$modalComponent.find('#koi-search-producto-component-table');
			this.$inputContent = this.$("#"+$(e.currentTarget).attr("data-field"));
			this.$inputName = this.$("#"+this.$inputContent.attr("data-name"));
			this.$wraperType = this.$("#"+this.$inputContent.attr("data-render"));
			this.$resourceContrato = this.$inputContent.attr("data-contrato");
			
			// Filters
			this.resourceTercero = this.$inputContent.attr("data-tercero");
			this.tipo_codigo = this.$inputContent.attr("data-tipo");
			this.tipo = this.$inputContent.attr("data-tipo-asignacion");
			this.asignacion_data = this.$inputContent.attr("data-asignaciones");
			var contrato = $("#asignacion1_contrato").val();
			var tercero = $("#asignacion1_tercero").val();
			var orden_tercero = $("#orden_tercero").val();

			if(this.$resourceContrato == "true") {
				// //Validate contrato
	            if( _.isUndefined(contrato) || _.isNull(contrato) || contrato == '') {
	                alertify.error('Por favor ingrese contrato antes agregar producto.');
	                return;
	            }
			}
			
			if(this.resourceTercero == 'true') {
				// Validate tercero
	            if( _.isUndefined(orden_tercero) || _.isNull(orden_tercero) || orden_tercero == '') {
	                alertify.error('Por favor ingrese cliente antes agregar producto.');
	                return;
	            }
			}

			this.productosSearchTable = this.$productosSearchTable.DataTable({
				dom: "<'row'<'col-sm-12'tr>>" +
					"<'row'<'col-sm-5'i><'col-sm-7'p>>",
				processing: true,
                serverSide: true,
            	language: window.Misc.dataTableES(),
                ajax: {
                    url: window.Misc.urlFull( Route.route('productos.index') ),
                    data: function( data ) {
                        data.producto_serie = _this.$searchSerie.val();
                        data.producto_nombre = _this.$searchNombre.val();
                        data.tipo_codigo = _this.tipo_codigo;
                        data.productos_asignados = _this.asignacion_data;
                        data.tercero_id = orden_tercero;
                        data.contrato = contrato;                        
                        data.tercero = tercero;
                        data.tipo = _this.tipo;
                    }
                },
                columns: [
                    { data: 'producto_serie', name: 'producto_serie' },
                    { data: 'producto_referencia', name: 'producto_referencia' },
                    { data: 'producto_placa', name: 'producto_placa' },
                    { data: 'producto_nombre', name: 'producto_nombre' },
                    { data: 'tipo_nombre', name: 'producto_tipo' },
                    { data: 'tipo_codigo', name: 'tipo_codigo' }
                ],
                columnDefs: [
					{
						targets: 0,
						width: '10%',
						searchable: false,
						render: function ( data, type, full, row ) {
							return '<a href="#" class="a-koi-search-producto-component-table">' + data + '</a>';
						}
					},
					{
						targets: [1,4],
						visible: false,
						render: function ( data, type, full, row ) {
							return '<a href="#" class="a-koi-search-producto-component-table">' + data + '</a>';
						}
					},
                ],
			});

			// Ocultar columnas
			var arrayType = this.tipo_codigo.split(',');
			if( (arrayType.indexOf('RP') != -1) || (arrayType.indexOf('CO') != -1) || (arrayType.indexOf('IN') != -1) ){
				this.productosSearchTable.columns( [0,2] ).visible( false,false );
				this.productosSearchTable.column( 1 ).visible( true );
			}

            // Modal show
            this.ready();
			this.$modalComponent.modal('show');
		},

		setProducto: function(e) {
			e.preventDefault();

	        var data = this.productosSearchTable.row( $(e.currentTarget).parents('tr') ).data();
			this.$inputContent.val( data.producto_serie );
			this.$inputName.val( data.producto_nombre );

	 		if(data.tipo_codigo == 'RP' || data.tipo_codigo == 'CO' || data.tipo_codigo == 'IN'){
				this.$inputContent.val( data.producto_referencia );
	 		}

	 		if(this.$('#producto_tercero').length){
	 			this.$('#producto_tercero').val( data.producto_tercero );
	 			this.$('#producto_contrato').val( data.producto_contrato );
	 		}

		 	if(this.$wraperType.length) {
                this.renderType(data.tipo_codigo, this.tipo);
            }
			this.$modalComponent.modal('hide');
		},

		search: function(e) {
			e.preventDefault();
		    this.productosSearchTable.ajax.reload();
		},

		clear: function(e) {
			e.preventDefault();
            this.$searchSerie.val('');
            this.$searchNombre.val('');
            this.productosSearchTable.ajax.reload();
		},

		productoChanged: function(e) {
			var _this = this;

			this.$inputContent = $(e.currentTarget);
			this.$inputName = this.$("#"+$(e.currentTarget).attr("data-name"));
			this.$wraperConten = this.$("#"+$(e.currentTarget).attr("data-wrapper"));
			this.$wraperType = this.$("#"+this.$inputContent.attr("data-render"));
            
			var producto = this.$inputContent.val();

            // Before eval clear data
            this.$inputName.val('');

			if(!_.isUndefined(producto) && !_.isNull(producto) && producto != '') {
				// Get Producto
	            $.ajax({
	                url: window.Misc.urlFull(Route.route('productos.search')),
	                type: 'GET',
	                data: { producto_serie: producto },
	                beforeSend: function() {
						_this.$inputName.val('');
	                    window.Misc.setSpinner( _this.$wraperConten );
	                }
	            })
	            .done(function(resp) {
	                window.Misc.removeSpinner( _this.$wraperConten );
	                if(resp.success) {
	                    if(!_.isUndefined(resp.producto_nombre) && !_.isNull(resp.producto_nombre)){
							_this.$inputName.val(resp.producto_nombre);
	                    }

	                    if(_this.$wraperType.length) {
    		            	_this.renderType(resp.tipo_codigo);
	                    }
	                   
	                }
	            })
	            .fail(function(jqXHR, ajaxOptions, thrownError) {
	                window.Misc.removeSpinner( _this.$wraperConten );
	                alertify.error(thrownError);
	            });
	     	}
		},


        /**
        * Render form type
        */
        renderType: function (type, tipo_asignacion, producto_tercero, producto_contrato) {
        	this.$wraperType.empty();
        	var data = { };
        	if( this.tipo == 'E'){
	        	if( type == 'AC') {
		        	data.producto_tipo = type;
		        	data.tipo = this.tipo;
		        	var template = _.template($('#koi-search-producto-type-component-tpl').html());
		           	this.$wraperType.html( template( data ) );
	        	}
        	}
        },

        /**
        * fires libraries js
        */
        ready: function () {
            // to fire plugins
            if( typeof window.initComponent.initToUpper == 'function' )
                window.initComponent.initToUpper();
        }
    });


})(jQuery, this, this.document);
