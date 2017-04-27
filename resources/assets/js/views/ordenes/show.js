/**
* Class ShowOrdenView
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

//Global App Backbone
app || (app = {});

(function ($, window, document, undefined) {

    app.ShowOrdenView = Backbone.View.extend({

        el: '#orden-main',

        /**
        * Constructor Method
        */
        initialize : function() {
            // Model exist
            if( this.model.id != undefined ) {
                this.visita = new app.VisitaCollection();

                // Reference views
                this.referenceViews();
            }
        },

        /**
        * reference to views
        */
        referenceViews: function () {
            this.visitasView = new app.VisitasView( {
                collection: this.visita,
                parameters: {
                    edit: false,
                    wrapper: this.$('#wrapper-visitas'),
                    dataFilter: {
                        'orden_id': this.model.get('id')
                    }
               }
            });
        }
    });

})(jQuery, this, this.document);
