/**
* Class MarcasList of Backbone Collection
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

//Global App Backbone
app || (app = {});

(function (window, document, undefined) {

    app.MarcasList = Backbone.Collection.extend({

        url: function() {
            return window.Misc.urlFull( Route.route('inventario.marcas.index') );
        },
        model: app.MarcaModel,

        /**
        * Constructor Method
        */
        initialize : function(){
        }
   });

})(this, this.document);
