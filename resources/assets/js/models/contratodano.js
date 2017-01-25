/**
* Class ContratoModel extend of Backbone Model
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

app || (app = {});

(function (window, document, undefined){

    app.ContratoDanoModel = Backbone.Model.extend({

        urlRoot: function () {
            return window.Misc.urlFull (Route.route('contratos.danoc.index') );
        },
        idAttribute: 'id',
        defaults: {
            'contratodano_contrato': '',
            'contratodano_dano': '',
            'contratodano_tiempo': ''
        }
    });

}) (this, this.document);