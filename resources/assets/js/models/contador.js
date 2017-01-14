/**
* Class ContadorModel extend of Backbone Model
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

//Global App Backbone
app || (app = {});

(function (window, document, undefined) {

    app.ContadorModel = Backbone.Model.extend({

        urlRoot: function () {
            return window.Misc.urlFull( Route.route('contadores.index') );
        },
        idAttribute: 'id',
        defaults: {
            'contador_nombre': '',
            'contador_activo': true
        }
    });

})(this, this.document);
