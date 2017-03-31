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

        },

        validar: function( producto ) {
            var error = { success: false, message: '' };

            // Validate exist
            var modelExits = _.find(this.models, function(item) {
                return item.get('asignacion2_producto') == producto;
            });

            if(modelExits instanceof Backbone.Model ) {
                error.message = 'Este producto ya fue agregado.'
                return error;
            }

            error.success = true;
            return error;
        },
   });
})(this, this.document);
