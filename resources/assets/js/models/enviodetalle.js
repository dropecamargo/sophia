/**
* Class Asignacion2Model extend of Backbone Model
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

//Global App Backbone
app || (app = {});

(function (window, document, undefined) {

    app.EnvioDetalleModel = Backbone.Model.extend({

        urlRoot: function () {
            return window.Misc.urlFull( Route.route('envioequipos.detalle.index') );
        },
        idAttribute: 'id',
        defaults: {
        	'producto_nombre_search': '',
        	'producto_tipo_search': ''
        }
    });

})(this, this.document);
