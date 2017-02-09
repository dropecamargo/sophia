/**
* Class ZonaModel extend of Backbone Model
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

//Global App Backbone
app || (app = {});

(function (window, document, undefined) {

    app.ZonaModel = Backbone.Model.extend({

        urlRoot: function () {
            return window.Misc.urlFull( Route.route('zonas.index') );
        },
        idAttribute: 'id',
        defaults: {
            'zona_nombre': '',
            'zona_activo': true
        }
    });

})(this, this.document);
