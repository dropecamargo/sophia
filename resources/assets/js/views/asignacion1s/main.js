/**
* Class MainAsignacion1sView
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

//Global App Backbone
app || (app = {});

(function ($, window, document, undefined) {

    app.MainAsignacion1sView = Backbone.View.extend({

        el: '#asignacion1s-main',

        /**
        * Constructor Method
        */
        initialize : function() {

            this.$asignacion1sSearchTable = this.$('#asignacion1s-search-table');

            this.$asignacion1sSearchTable.DataTable({
                dom: "<'row'<'col-sm-4'B><'col-sm-4 text-center'l><'col-sm-4'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                processing: true,
                serverSide: true,
                language: window.Misc.dataTableES(),
                ajax: window.Misc.urlFull( Route.route('asignacion1s.index') ),
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'asignacion1_fecha', name: 'asignacion1_fecha' },
                    { data: 'asignacion1_fecha', name: 'asignacion1_fecha'}
                ],
                buttons: [
                    {
                        text: '<i class="fa fa-plus"></i> Nuevo Daño',
                        className: 'btn-sm',
                        action: function ( e, dt, node, config ) {
                            window.Misc.redirect( window.Misc.urlFull( Route.route('asignacion1s.create') ) )
                        }
                    }
                ],
                columnDefs: [
                    {
                        targets: 0,
                        width: '10%',
                        render: function ( data, type, full, row ) {
                            return '<a href="'+ window.Misc.urlFull( Route.route('asignacion1s.show', {asignacion1s: full.id }) )  +'">' + data + '</a>';
                        }
                    },
                    {
                        targets: 2,
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
