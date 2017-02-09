/**
* Class ContadorespModel extend of Backbone Model
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

app || (app = {});

(function (window, document, undefined){

    app.ContadorespModel = Backbone.Model.extend({

        urlRoot: function () {
            return window.Misc.urlFull (Route.route('ordenes.contadoresp.index') );
        },
        idAttribute: 'id',
        defaults: {  
       		'contadoresp_valor': ''
        }
    });

}) (this, this.document);