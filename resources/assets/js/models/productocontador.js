/**
* Class ProductoContadorModel extend of Backbone Model
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

//Global App Backbone
app || (app = {});

(function (window, document, undefined) {

    app.ProductoContadorModel = Backbone.Model.extend({

        urlRoot: function () {
            return window.Misc.urlFull( Route.route('productos.productoscontador.index') );
        },
        idAttribute: 'id',
        defaults: {
            'productocontador_producto': '',
            'productocontador_contador': ''
        }
    });

})(this, this.document);
