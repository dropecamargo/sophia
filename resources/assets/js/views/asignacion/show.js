/**
* Class ShowAsignacion2View
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

//Global App Backbone
app || (app = {});

(function ($, window, document, undefined) {

    app.ShowAsignacionView = Backbone.View.extend({

        el: '#asignacion-show',

        /**
        * Constructor Method
        */
        initialize : function() {
            // Model exist
            if( this.model.id != undefined ) {

            	this.asignaciondetalleList = new app.AsignacionDetalleList();

                // Reference views
                this.referenceViews();
            }
        },

        /**
        * reference to views
        */
        referenceViews: function () {
    		// Detalle asignaciones list
            this.asignaciondetalleListView = new app.AsignacionDetalleListView({
                collection: this.asignaciondetalleList,
                parameters: {
                    wrapper: this.el,
                    edit: false,
                    dataFilter: {
                    	asignacion2: this.model.get('id')
                    }
                }
            });
            console.log(this.model.get());
        }
    });

})(jQuery, this, this.document);
