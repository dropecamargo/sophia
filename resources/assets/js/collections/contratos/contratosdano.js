/**
* Class ContratosList of Backbone Collection
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

//Global App Backbone
app || (app = {});

(function (window, document, undefined) {

    app.ContratosList = Backbone.Collection.extend({

        url: function() {
            return window.Misc.urlFull( Route.route('contratos.danoc.index') );
        },
        model: app.ContratoDanoModel,

        /**
        * Constructor Method
        */
        initialize : function(){
        }
   });
})(this, this.document);

