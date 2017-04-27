/**
* Class SirveaModel extend of Backbone Model
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

//Global App Backbone
app || (app = {});

(function (window, document, undefined) {

    app.SirveaModel = Backbone.Model.extend({

        urlRoot: function () {
            return window.Misc.urlFull( Route.route('productos.sirveas.index') );
        },
        idAttribute: 'id',
        defaults: {
            'sirvea_codigo': '',
            'sirvea_modelo': ''
        }
    });

})(this, this.document);
