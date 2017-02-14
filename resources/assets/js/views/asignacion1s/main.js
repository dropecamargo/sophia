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
            this.$asignacion1sSearchTable = this.$('#asignacion1s-search-table');
            this.$searchasignacion1Tercero = this.$('#searchasignacion1_tercero');
            this.$searchasignacion1TerceroName = this.$('#searchasignacion1_tercero_nombre');
            this.$searchasignacion1Tipo = this.$('#searchasignacion1_tipo');
            this.$searchasignacion1Tecnico = this.$('#searchasignacion1_tecnico');
            this.$searchasignacion1TecnicoName = this.$('#searchasignacion1_tecnico_nombre');


            this.asignacion1sSearchTable = this.$asignacion1sSearchTable.DataTable({
                dom: "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                processing: true,
                serverSide: true,
                language: window.Misc.dataTableES(),
                ajax: {
                    url: window.Misc.urlFull( Route.route('asignaciones.index') ),
                    data: function( data ) {
                        data.persistent = true;
                        data.tercero_nit = _this.$searchasignacion1Tercero.val();
                        data.tercero_nombre = _this.$searchasignacion1TerceroName.val();
                        data.asignacion1_tipo = _this.$searchasignacion1Tipo.val();
                        data.tecnico_nit = _this.$searchasignacion1Tecnico.val();
                        data.tecnico_nombre = _this.$searchasignacion1TecnicoName.val();         
                    }
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'tercero_nombre', name: 'asignacion1_tercero' },
                    { data: 'tecnico_nombre', name: 'asignacion1_tecnico'},
                    { data: 'asignacion1_tipo', name: 'asignacion1_tipo'},
                ],
                buttons: [
                    {
                        text: '<i class="fa fa-plus"></i> Nueva Asignacion',
                        className: 'btn-sm',
                        action: function ( e, dt, node, config ) {
                            window.Misc.redirect( window.Misc.urlFull( Route.route('asignaciones.create') ) )
                        }
                    }
                ],
                columnDefs: [
                    {
                        targets: 0,
                        width: '10%',
                        render: function ( data, type, full, row ) {
                            return '<a href="'+ window.Misc.urlFull( Route.route('asignaciones.show', {asignaciones: full.id }) )  +'">' + data + '</a>';
                        }
                    },
                    {
                        targets: 3,
                        width: '10%',
                        render: function ( data, type, full, row ) {
                            return (data=='E') ? 'Envio' : 'Retiro';
                        },
                    }
                ]
            });
        },

        search: function(e) {
            e.preventDefault();

            this.asignacion1sSearchTable.ajax.reload();
        },

        clear: function(e) {
            e.preventDefault();

            this.$searchasignacion1Tercero.val('');
            this.$searchasignacion1TerceroName.val('');
            this.$searchasignacion1Tipo.val('');
            this.$searchasignacion1Tecnico.val('');
            this.$searchasignacion1TecnicoName.val('')

            this.asignacion1sSearchTable.ajax.reload();
        },
    });

})(jQuery, this, this.document);
