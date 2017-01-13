/**
* Class TipoModel extend of Backbone Model
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

//Global App Backbone
app || (app = {});

(function (window, document, undefined) {

    app.TipoModel = Backbone.Model.extend({

        urlRoot: function () {
            return window.Misc.urlFull( Route.route('tipos.index') );
        },
        idAttribute: 'id',
        defaults: {
        	'tipo_codigo': '',
            'tipo_nombre': '',
            'tipo_activo': true
        }
    });

})(this, this.document);