/**
* Class Asignacion2sList of Backbone Collection
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

//Global App Backbone
app || (app = {});

(function (window, document, undefined) {

    app.Asignacion2sList = Backbone.Collection.extend({

        url: function() {
            return window.Misc.urlFull( Route.route('tecnico.asignacion1s.index') );
        },
        model: app.Asignacion2Model,

        /**
        * Constructor Method
        */
        initialize : function(){
        }
   });
})(this, this.document);
