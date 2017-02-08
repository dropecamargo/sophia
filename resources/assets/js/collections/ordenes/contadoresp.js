/**
* Class contadoresp of Backbone Collection
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

//Global App Backbone
app || (app = {});

(function (window, document, undefined) {

    app.ContadorespCollection = Backbone.Collection.extend({

        url: function() {
            return window.Misc.urlFull( Route.route('ordenes.contadoresp.index') );
        },
        model: app.ContadorespModel,

        /**
        * Constructor Method
        */
        initialize : function(){
        }
   });
})(this, this.document);

