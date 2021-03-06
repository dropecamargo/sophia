/**
* Class ProductosContadorList of Backbone Collection
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

//Global App Backbone
app || (app = {});

(function (window, document, undefined) {

    app.ProductosContadorList = Backbone.Collection.extend({

        url: function() {
            return window.Misc.urlFull( Route.route('productos.productoscontador.index') );
        },
        model: app.ProductoContadorModel,

        /**
        * Constructor Method
        */
        initialize : function(){
        }
   });
})(this, this.document);
