/**
* Class MainContratoView
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

//Global App Backbone
app || (app = {});

(function ($, window, document, undefined) {

    app.MainContratosView = Backbone.View.extend({

        el: '#contrato-main',

        /**
        * Constructor Method
        */
        initialize : function() {

            this.$contratoSearchTable = this.$('#contrato-search-table');

            this.$contratoSearchTable.DataTable({
                dom: "<'row'<'col-sm-4'B><'col-sm-4 text-center'l><'col-sm-4'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                processing: true,
                serverSide: true,
                language: window.Misc.dataTableES(),
                ajax: window.Misc.urlFull( Route.route('contratos.index') ),
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'contrato_numero', name: 'contrato_numero' },
                    { data: 'tercero_nombre', name: 'contrato_tercero' },
                    { data: 'contrato_fecha', name: 'contrato_fecha' },
                    { data: 'contrato_vencimiento', name: 'contrato_vencimiento' },
                    { data: 'contrato_activo', name: 'contrato_activo' }
                    
                ],
                buttons: [
                    {
                        text: '<i class="fa fa-plus"></i> Nuevo contrato',
                        className: 'btn-sm',
                        action: function ( e, dt, node, config ) {
                            window.Misc.redirect( window.Misc.urlFull( Route.route('contratos.create') ) )
                        }
                    }
                ],
                columnDefs: [
                    {
                        targets: 0,
                        width: '10%',
                        render: function ( data, type, full, row ) {
                            return '<a href="'+ window.Misc.urlFull( Route.route('contratos.show', {contratos: full.id }) )  +'">' + data + '</a>';
                        }
                    },
                    {
                        targets: 5  ,
                        width: '10%',
                        render: function ( data, type, full, row ) {
                            return data ? 'Si' : 'No';
                        },
                    }
                ]
            });
        }
    });

})(jQuery, this, this.document);
