/**
* Class ComponentSearchContratoView of Backbone
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

//Global App Backbone
app || (app = {});

(function ($, window, document, undefined) {

    app.ComponentSearchContratoView = Backbone.View.extend({

      	el: 'body',
        template: _.template( ($('#koi-search-contrato-component-tpl').html() || '') ),

		events: {
            'click .btn-koi-search-contrato-component-table': 'searchOrden',
            'click .btn-search-koi-search-contrato-component': 'search',
            'click .btn-clear-koi-search-contrato-component': 'clear',
            'click .a-koi-search-contrato-component-table': 'setContrato'
		},

        /**
        * Constructor Method
        */
		initialize: function() {
			// Initialize
            this.$modalComponent = this.$('#modal-search-contrato-component');
		},

		searchOrden: function(e) {
            e.preventDefault();
            var _this = this;

            // Render template
            this.$modalComponent.find('.content-modal').html( this.template({ }) );

            // References
            this.$searchContratoNumero = this.$('#koi_search_contrato_numero');

            // Validate tercero
			this.$resourceTercero = this.$("#"+$(e.currentTarget).attr("data-tercero"));
			var tercero = this.$resourceTercero.attr("data-tercero");
            if( _.isUndefined(tercero) || _.isNull(tercero) || tercero == '') {
                alertify.error('Por favor ingrese cliente antes agregar contrato.');
                return;
            }

            this.$contratoSearchTable = this.$modalComponent.find('#koi-search-contrato-component-table');
			this.$inputContent = this.$("#"+$(e.currentTarget).attr("data-field"));
			this.$inputName = this.$("#"+$(e.currentTarget).attr("data-name"));

			this.contratoSearchTable = this.$contratoSearchTable.DataTable({
				dom: "<'row'<'col-sm-12'tr>>" +
					"<'row'<'col-sm-5'i><'col-sm-7'p>>",
				processing: true,
                serverSide: true,
            	language: window.Misc.dataTableES(),
                ajax: {
                    url: window.Misc.urlFull( Route.route('contratos.index') ),
                    data: function( data ) {
                        data.contrato_numero = _this.$searchContratoNumero.val(),
                        data.contrato_tercero = tercero
                    }
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'contrato_numero', name: 'contrato_numero' },
                    { data: 'tercero_nombre', name: 'contrato_tercero' },
                    { data: 'contrato_fecha', name: 'contrato_fecha' },
                    { data: 'contrato_vencimiento', name: 'contrato_vencimiento' },
                    { data: 'contrato_activo', name: 'contrato_activo' },
                    { data: 'contrato_condiciones', name: 'contrato_condiciones' }
                ],
                columnDefs: [
                    {
                        targets: 1,
                        width: '40%',
                        searchable: false,
                        render: function ( data, type, full, row ) {
                        	return '<a href="#" class="a-koi-search-contrato-component-table">' + data + '</a>';
                        }
                    },
                	{
                        targets: [0,2,5],
                        visible: false
                    }
                ]
			});

            // Modal show
            this.ready();
			this.$modalComponent.modal('show');
		},

		setContrato: function(e) {
			e.preventDefault();

	        var data = this.contratoSearchTable.row( $(e.currentTarget).parents('tr') ).data();
			this.$inputContent.val( data.id );
			this.$inputName.val( data.contrato_numero );

			this.$modalComponent.modal('hide');
		},

		search: function(e) {
			e.preventDefault();

		    this.contratoSearchTable.ajax.reload();
		},

		clear: function(e) {
			e.preventDefault();

            this.$searchContratoNumero.val('');

            this.contratoSearchTable.ajax.reload();
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
