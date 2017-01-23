/**
* Class ShowProductoView
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

//Global App Backbone
app || (app = {});

(function ($, window, document, undefined) {

    app.ShowProductoView = Backbone.View.extend({

        el: '#productos-main',

        /**
        * Constructor Method
        */
        initialize : function() {
            // Model exist
            if( this.model.id != undefined ) {

                this.marcasList = new app.MarcasList();
        
                // Reference views
                this.referenceViews();
            }
        },

        /**
        * reference to views
        */
        referenceViews: function () {
       		// Marcas list
            this.marcasListView = new app.MarcasListView( {
                collection: this.marcasList,
                parameters: {
                    edit: false,
                    wrapper: this.$('#wrapper-producto-marcas'),
                    dataFilter: {
                        'producto_id': this.model.get('id')
                    }
               }
            });

        }
    });

})(jQuery, this, this.document);
