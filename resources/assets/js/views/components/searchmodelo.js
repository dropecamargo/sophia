/**
* Class ComponentSearchModeloView of Backbone
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

//Global App Backbone
app || (app = {});

(function ($, window, document, undefined) {

    app.ComponentSearchModeloView = Backbone.View.extend({

      	el: 'body',
        template: _.template( ($('#koi-search-modelo-component-tpl').html() || '') ),
		events: {
            'click .btn-koi-search-modelo-component-table': 'searchModelo',
            'click .btn-search-koi-search-modelo-component': 'search',
            'click .btn-clear-koi-search-modelo-component': 'clear',
            'click .a-koi-search-modelo-component-table': 'setModelo'
		},

        /**
        * Constructor Method
        */
		initialize: function() {
			// Initialize
            this.$modalComponent = this.$('#modal-search-modelo-component');
		},

		searchModelo: function(e) {
            e.preventDefault();
            var _this = this;

            // Render template
            this.$modalComponent.find('.content-modal').html( this.template({ }) );

            // References
            this.$searchModelo = this.$('#koi_search_modelo');
            this.$searchReferencia = this.$('#koi_search_referencia');

            this.$modeloSearchTable = this.$modalComponent.find('#koi-search-modelo-component-table');
			this.$inputContent = this.$("#"+$(e.currentTarget).attr("data-field"));
            this.$inputName = this.$("#"+this.$inputContent.attr("data-name"));
			this.$filter = this.$inputContent.attr("data-filter");

			this.modeloSearchTable = this.$modeloSearchTable.DataTable({
				dom: "<'row'<'col-sm-12'tr>>" +
					"<'row'<'col-sm-5'i><'col-sm-7'p>>",
				processing: true,
                serverSide: true,
            	language: window.Misc.dataTableES(),
                ajax: {
                    url: window.Misc.urlFull( Route.route('modelos.index') ),
                    data: function( data ) {
                        data.modelo = _this.$searchModelo.val();
                        data.referencia = _this.$searchReferencia.val();
                        data.filter = _this.$filter;
                    }
                },
                columns: [
                    { data: 'modelo_nombre', name: 'modelo_nombre' },
                    { data: 'producto_referencia', name: 'producto_referencia' },
                ],
                columnDefs: [
                    {
                        targets: 0,
                        width: '40%',
                        searchable: false,
                        render: function ( data, type, full, row ) {
                        	return '<a href="#" class="a-koi-search-modelo-component-table">' + data + '</a>';
                        }
                    }
                ]
			});

            // Modal show
            this.ready();
			this.$modalComponent.modal('show');
		},

		setModelo: function(e) {
            e.preventDefault();

	        var data = this.modeloSearchTable.row( $(e.currentTarget).parents('tr') ).data();
			this.$inputContent.val( data.modelo_nombre );
			this.$inputName.val( data.producto_referencia );

			this.$modalComponent.modal('hide');
		},

		search: function(e) {
			e.preventDefault();
            
		    this.modeloSearchTable.ajax.reload();
		},

		clear: function(e) {
			e.preventDefault();

            this.$searchModelo.val('');
            this.$searchReferencia.val('');

            this.modeloSearchTable.ajax.reload();
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
