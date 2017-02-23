/**
* Class Asignacion2sList of Backbone Collection
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

//Global App Backbone
app || (app = {});

(function (window, document, undefined) {

    app.AsignacionDetalleList = Backbone.Collection.extend({

        url: function() {
            return window.Misc.urlFull( Route.route('asignaciones.detalle.index') );
        },
        model: app.AsignacionDetalleModel,

        /**
        * Constructor Method
        */
        initialize : function(){
        }
   });
})(this, this.document);
