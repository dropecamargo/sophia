/**
* Class ShowAsignacion2View
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

//Global App Backbone
app || (app = {});

(function ($, window, document, undefined) {

    app.ShowEnvioEquipoView = Backbone.View.extend({

        el: '#asignacion-show',

        /**
        * Constructor Method
        */
        initialize : function() {
            // Model exist
            if( this.model.id != undefined ) {

            	this.enviodetalleList = new app.EnvioDetalleList();

                // Reference views
                this.referenceViews();
            }
        },

        /**
        * reference to views
        */
        referenceViews: function () {
    		// Detalle asignaciones list
            this.enviodetalleListView = new app.EnvioDetalleListView({
                collection: this.enviodetalleList,
                parameters: {
                    wrapper: this.el,
                    edit: false,
                    dataFilter: {
                    	asignacion2: this.model.get('id')
                    }
                }
            });
        }
    });

})(jQuery, this, this.document);
