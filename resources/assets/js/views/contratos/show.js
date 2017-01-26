/**
* Class ShowContratoView
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

//Global App Backbone
app || (app = {});

(function ($, window, document, undefined) {

    app.ShowContratoView = Backbone.View.extend({

        el: '#contrato-main',

        /**
        * Constructor Method
        */
        initialize : function() {
            // Model exist
            if( this.model.id != undefined ) {

               this.contratosList = new app.ContratosList();

                // Reference views
                this.referenceViews();
            }
        },

        /**
        * reference to views
        */
        referenceViews: function () {
       	// Contratos list
            this.contratosListView = new app.ContratosListView( {
                collection: this.contratosList,
                parameters: {
                    edit: false,
                    wrapper: this.$('#wrapper-danos-contrato'),
                    dataFilter: {
                        'contrato_id': this.model.get('id')
                    }
               }
            });
        }
    });

})(jQuery, this, this.document);
