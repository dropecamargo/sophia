/**
* Class MainProductosView
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

//Global App Backbone
app || (app = {});

(function ($, window, document, undefined) {

    app.MainProductosView = Backbone.View.extend({

        el: '#productos-main',
        events: {
            'click .btn-search': 'search',
            'click .btn-clear': 'clear'
        },

        /**
        * Constructor Method
        */
        initialize : function() {
            var _this = this;

            // Rerefences
            this.$productosSearchTable = this.$('#productos-search-table');
            this.$searchSerie = this.$('#producto_serie');
            this.$searchName = this.$('#producto_nombre');

            this.productosSearchTable = this.$productosSearchTable.DataTable({
                dom: "<'row'<'col-sm-4'><'col-sm-4 text-center'l>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                processing: true,
                serverSide: true,
                language: window.Misc.dataTableES(),
                ajax: {
                    url: window.Misc.urlFull( Route.route('productos.index') ),
                    data: function( data ) {
                        data.persistent = true;
                        data.producto_serie = _this.$searchSerie.val();
                        data.producto_nombre = _this.$searchName.val();
                    }
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'producto_serie', name: 'producto_serie' },
                    { data: 'producto_nombre', name: 'producto_nombre'}
                ],
                buttons: [
                    {
                        text: '<i class="fa fa-user-plus"></i> Nuevo producto',
                        className: 'btn-sm',
                        action: function ( e, dt, node, config ) {
                            window.Misc.redirect( window.Misc.urlFull( Route.route('productos.create') ) )
                        }
                    }
                ],
                columnDefs: [
                    {
                        targets: 0,
                        width: '10%',
                        render: function ( data, type, full, row ) {
                            return '<a href="'+ window.Misc.urlFull( Route.route('productos.show', {productos: full.id }) )  +'">' + data + '</a>';
                        }
                    }
                ]
            });
        },

        search: function(e) {
            e.preventDefault();

            this.productosSearchTable.ajax.reload();
        },

        clear: function(e) {
            e.preventDefault();

            this.$searchSerie.val('');
            this.$searchName.val('');

            this.productosSearchTable.ajax.reload();
        },
    });

})(jQuery, this, this.document);
