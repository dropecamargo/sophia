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

                this.sirveasList = new app.SirveasList();
                this.productoscontadorList = new app.ProductosContadorList();

                // Reference views
                this.referenceViews();
            }
        },

        /**
        * reference to views
        */
        referenceViews: function () {
       		// Sirveas list
            this.sirveasListView = new app.SirveasListView( {
                collection: this.sirveasList,
                parameters: {
                    edit: false,
                    wrapper: this.$('#wrapper-producto-sirveas'),
                    dataFilter: {
                        'producto_id': this.model.get('id')
                    }
               }
            });

            // ProductosContador list
            this.productoscontadorListView = new app.ProductosContadorListView( {
                collection: this.productoscontadorList,
                parameters: {
                    edit: false,
                    wrapper: this.$('#wrapper-producto-productoscontador'),
                    dataFilter: {
                        'producto_id': this.model.get('id')
                    }
               }
            });
        }
    });

})(jQuery, this, this.document);
