/**
* Class ShowProductopView
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

                // Reference views
                this.referenceViews();
            }
        },

        /**
        * reference to views
        */
        referenceViews: function () {
       		// Tips list
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
        }
    });

})(jQuery, this, this.document);
