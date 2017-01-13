/**
* Class EstadoModel extend of Backbone Model
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

//Global App Backbone
app || (app = {});

(function (window, document, undefined) {

    app.EstadoModel = Backbone.Model.extend({

        urlRoot: function () {
            return window.Misc.urlFull( Route.route('estados.index') );
        },
        idAttribute: 'id',
        defaults: {
            'estado_nombre': '',
            'estado_activo': true
        }
    });

})(this, this.document);
