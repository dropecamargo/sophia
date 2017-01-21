/**
* Class ProductoMarcaModel extend of Backbone Model
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

//Global App Backbone
app || (app = {});

(function (window, document, undefined) {

    app.ProductomarcaModel = Backbone.Model.extend({

        urlRoot: function () {
            return window.Misc.urlFull( Route.route('productos.marcasp.index') );
        },
        idAttribute: 'id',
        defaults: {
        	'productomarcas_producto': '',
            'productomarcas_marca': ''
        }
    });

})(this, this.document);
