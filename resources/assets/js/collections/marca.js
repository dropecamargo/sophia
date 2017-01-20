/**
* Class MarcaList of Backbone Collection
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

//Global App Backbone
app || (app = {});

(function (window, document, undefined) {

    app.MarcaList = Backbone.Collection.extend({

        url: function() {
            return window.Misc.urlFull( Route.route('inventario.marca') );
        },
        model: app.MarcaModel,

        /**
        * Constructor Method
        */
        initialize : function(){
        }
   });

})(this, this.document);
