/**
* Class ContratoModel extend of Backbone Model
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

app || (app = {});

(function (window, document, undefined){

    app.ContratoModel = Backbone.Model.extend({

        urlRoot: function () {
            return window.Misc.urlFull (Route.route('contratos.index') );
        },
        idAttribute: 'id',
        defaults: {
            'contrato_numero': '',
            'contrato_tercero': '',
            'contrato_fecha': moment().format('YYYY-MM-DD'),
            'contrato_vencimiento': moment().format('YYYY-MM-DD'),
            'contrato_activo': '',
            'contrato_condiciones': ''
        }
    });

}) (this, this.document);