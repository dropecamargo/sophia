/**
* Class MainAsignacion1sView
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

//Global App Backbone
app || (app = {});

(function ($, window, document, undefined) {

    app.MainAsignacionView = Backbone.View.extend({

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
            this.$envioequipoSearchTable = this.$('#asignacion1s-search-table');
            this.$searchenvioquipoTercero = this.$('#searchasignacion1_tercero');
            this.$searchenvioquipoTerceroName = this.$('#searchasignacion1_tercero_nombre');
            this.$searchenvioquipoTipo = this.$('#searchasignacion1_tipo');
            this.$searchenvioquipoTecnico = this.$('#searchasignacion1_tecnico');
            this.$searchenvioquipoTecnicoName = this.$('#searchasignacion1_tecnico_nombre');


            this.asignacion1sSearchTable = this.$envioequipoSearchTable.DataTable({
                dom: "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                processing: true,
                serverSide: true,
                language: window.Misc.dataTableES(),
                ajax: {
                    url: window.Misc.urlFull( Route.route('asignaciones.index') ),
                    data: function( data ) {
                        data.persistent = true;
                        data.tercero_nit = _this.$searchenvioquipoTercero.val();
                        data.tercero_nombre = _this.$searchenvioquipoTerceroName.val();
                        data.asignacion_tipo = _this.$searchenvioquipoTipo.val();
                        data.tecnico_nit = _this.$searchenvioquipoTecnico.val();
                        data.tecnico_nombre = _this.$searchenvioquipoTecnicoName.val();         
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
                        text: '<i class="fa fa-plus"></i> Nuevo Envío',
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

            this.$searchenvioquipoTercero.val('');
            this.$searchenvioquipoTerceroName.val('');
            this.$searchenvioquipoTipo.val('');
            this.$searchenvioquipoTecnico.val('');
            this.$searchenvioquipoTecnicoName.val('')

            this.asignacion1sSearchTable.ajax.reload();
        },
    });

})(jQuery, this, this.document);
