/**
* Class ProductoModel extend of Backbone Model
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

//Global App Backbone
app || (app = {});

(function (window, document, undefined) {

    app.ProductoModel = Backbone.Model.extend({

        urlRoot: function () {
            return window.Misc.urlFull( Route.route('productos.index') );
        },
        idAttribute: 'id',
        defaults: {
            'producto_placa': '',
            'producto_serie': '',
            'producto_referencia': '',
            'producto_codigo': '',
            'producto_nombre': '',
            'producto_parte': '',
            'producto_vida_util': '',
            'producto_costo_promedio': '',
            'producto_ultimo_costo': ''
        }
    });

})(this, this.document);
