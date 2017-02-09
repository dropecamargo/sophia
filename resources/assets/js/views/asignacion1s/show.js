/**
* Class ShowAsignacion2View
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

//Global App Backbone
app || (app = {});

(function ($, window, document, undefined) {

    app.ShowAsignacion1View = Backbone.View.extend({

        el: '#asignacion-show',

        /**
        * Constructor Method
        */
        initialize : function() {
            // Model exist
            if( this.model.id != undefined ) {

            	this.asignacion2sList = new app.Asignacion2sList();

                // Reference views
                this.referenceViews();
            }
        },

        /**
        * reference to views
        */
        referenceViews: function () {
    		// Detalle asignaciones list
            this.asignacion2sListView = new app.Asignacion2sListView({
                collection: this.asignacion2sList,
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
