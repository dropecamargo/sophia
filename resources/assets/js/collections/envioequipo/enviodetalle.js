/**
* Class Asignacion2sList of Backbone Collection
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

//Global App Backbone
app || (app = {});

(function (window, document, undefined) {

    app.EnvioDetalleList = Backbone.Collection.extend({

        url: function() {
            return window.Misc.urlFull( Route.route('envioequipos.detalle.index') );
        },
        model: app.EnvioDetalleModel,

        /**
        * Constructor Method
        */
        initialize : function(){
        }
   });
})(this, this.document);
