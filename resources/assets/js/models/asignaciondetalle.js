/**
* Class Asignacion2Model extend of Backbone Model
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

//Global App Backbone
app || (app = {});

(function (window, document, undefined) {

    app.AsignacionDetalleModel = Backbone.Model.extend({

        urlRoot: function () {
            return window.Misc.urlFull( Route.route('asignaciones.detalle.index') );
        },
        idAttribute: 'id',
        defaults: {
        	'producto_nombre_search': '',
            'producto_tipo_search': '',
            'tipo_codigo': ''
        }
    });

})(this, this.document);
