/**
* Class MainTiposView
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

//Global App Backbone
app || (app = {});

(function ($, window, document, undefined) {

    app.MainTiposView = Backbone.View.extend({

        el: '#tipos-main',

        /**
        * Constructor Method
        */
        initialize : function() {

            this.$tiposSearchTable = this.$('#tipos-search-table');

            this.$tiposSearchTable.DataTable({
                dom: "<'row'<'col-sm-4'B><'col-sm-4 text-center'l><'col-sm-4'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                processing: true,
                serverSide: true,
                language: window.Misc.dataTableES(),
                ajax: window.Misc.urlFull( Route.route('tipos.index') ),
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'tipo_codigo', name: 'tipo_codigo' },
                    { data: 'tipo_nombre', name: 'tipo_nombre' },
                    { data: 'tipo_activo', name: 'tipo_activo'}
                ],
                buttons: [
                    {
                        text: '<i class="fa fa-plus"></i> Nuevo tipo',
                        className: 'btn-sm',
                        action: function ( e, dt, node, config ) {
                            window.Misc.redirect( window.Misc.urlFull( Route.route('tipos.create') ) )
                        }
                    }
                ],
                columnDefs: [
                    {
                        targets: 0,
                        width: '10%',
                        render: function ( data, type, full, row ) {
                            return '<a href="'+ window.Misc.urlFull( Route.route('tipos.show', {tipos: full.id }) )  +'">' + data + '</a>';
                        }
                    },
                    {
                        targets: 3,
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
