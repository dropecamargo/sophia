/**
* Class MarcaModel extend of Backbone Model
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

//Global App Backbone
app || (app = {});

(function (window, document, undefined) {

    app.MarcaModel = Backbone.Model.extend({

        urlRoot: function () {
            return window.Misc.urlFull( Route.route('marcas.index') );
        },
        idAttribute: 'id',
        defaults: {
            'marca_modelo': '',
            'marca_activo': true
        }
    });

})(this, this.document);
