/**
* Class MainContratosView
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

//Global App Backbone
app || (app = {});

(function ($, window, document, undefined) {

    app.MainContratosView = Backbone.View.extend({

        el: '#contrato-main',
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
            this.$contratosSearchTable = this.$('#contrato-search-table');
            this.$searchcontratoContrato = this.$('#searchcontrato_contrato_numero');
            this.$searchcontratoTercero = this.$('#searchcontrato_tercero');
            this.$searchcontratoTerceroName = this.$('#searchcontrato_tercero_nombre');
           
            this.contratosSearchTable = this.$contratosSearchTable.DataTable({
                dom: "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                processing: true,
                serverSide: true,
                language: window.Misc.dataTableES(),
                ajax: {
                    url: window.Misc.urlFull( Route.route('contratos.index') ),
                    data: function( data ) {
                        data.persistent = true;
                        data.contrato_numero = _this.$searchcontratoContrato.val();
                        data.tercero_nit = _this.$searchcontratoTercero.val();
                        data.tercero_nombre = _this.$searchcontratoTerceroName.val();
                    }
                },
                columns: [
                    { data: 'id' , name: 'id'},
                    { data: 'contrato_numero', name: 'contrato_numero' },
                    { data: 'tercero_nombre', name: 'contrato_tercero' },
                    { data: 'contrato_fecha', name: 'contrato_fecha' },
                    { data: 'contrato_vencimiento', name: 'contrato_vencimiento' },
                    { data: 'contrato_activo', name: 'contrato_activo' },
                    
                ],
                columnDefs: [
                    {
                        targets: 1,
                        width: '20%',
                        searchable: false,
                        render: function ( data, type, full, row ) {
                            
                            return '<a href="'+ window.Misc.urlFull( Route.route('contratos.show', {contratos: full.id }) )  +'">' + data + '</a>';
                        }
                    },
                    {
                        targets: 5,
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

            this.contratosSearchTable.ajax.reload();
        },

        clear: function(e) {
            e.preventDefault();

            this.$searchcontratoContrato.val('');
            this.$searchcontratoTercero.val('');
            this.$searchcontratoTerceroName.val('');
           

            this.contratosSearchTable.ajax.reload();
        },
    });

})(jQuery, this, this.document);



