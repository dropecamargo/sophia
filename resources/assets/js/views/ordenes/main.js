/**
* Class MainOrdenesView
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

//Global App Backbone
app || (app = {});

(function ($, window, document, undefined) {

    app.MainOrdenesView = Backbone.View.extend({

        el: '#orden-main',
        events: {
            'click .btn-search': 'search',
            'click .btn-clear': 'clear'
        },

        /**
        * Constructor Method
        */
        initialize : function() {
            var _this = this;

            // References
            this.$ordenesSearchTable = this.$('#orden-search-table');
            this.$searchordenpOrden = this.$('#searchordenp_ordenp_numero');
            this.$searchordenpTercero = this.$('#searchordenp_tercero');
            this.$searchordenpTerceroName = this.$('#searchordenp_tercero_nombre');
            this.$searchordenpEstado = this.$('#searchordenp_ordenp_estado');

            this.ordenesSearchTable = this.$ordenesSearchTable.DataTable({
                dom: "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                processing: true,
                serverSide: true,
                language: window.Misc.dataTableES(),
                ajax: {
                    url: window.Misc.urlFull( Route.route('ordenes.index') ),
                    data: function( data ) {
                        data.persistent = true;
                        data.id = _this.$searchordenpOrden.val();
                        data.tercero_nit = _this.$searchordenpTercero.val();
                        data.tercero_nombre = _this.$searchordenpTerceroName.val();
                        data.orden_abierta = _this.$searchordenpEstado.val();
                    }
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'orden_fecha', name: 'orden_fecha' },
                    { data: 'tercero_nombre', name: 'tercero_nombre' },
                    { data: 'orden_abierta', name: 'orden_abierta' },


                ],
                columnDefs: [
                    {
                        targets: 0,
                        width: '10%',
                        searchable: false,
                        render: function ( data, type, full, row ) {
                            
                            return '<a href="'+ window.Misc.urlFull( Route.route('ordenes.show', {ordenes: full.id }) )  +'">' + data + '</a>';
                        }
                    },
                    {
                        targets: 3,
                        width: '10%',
                        render: function ( data, type, full, row ) {
                            return data ? 'Si' : 'No';
                        },
                    }
                ],
               
            });
        },

        search: function(e) {
            e.preventDefault();

            this.ordenesSearchTable.ajax.reload();
        },

        clear: function(e) {
            e.preventDefault();

            this.$searchordenpOrden.val('');
            this.$searchordenpTercero.val('');
            this.$searchordenpTerceroName.val('');
            this.$searchordenpEstado.val('');

            this.ordenesSearchTable.ajax.reload();
        },
    });

})(jQuery, this, this.document);
