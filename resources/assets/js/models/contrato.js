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
            'tercero_nit': '',
            'tercero_nombre': '',
            'contrato_fecha': moment().format('YYYY-MM-DD'),
            'contrato_vencimiento': moment().format('YYYY-MM-DD'),
            'contrato_activo': true,
            'contrato_condiciones': ''
            //'dano_nombre': '',
            //'dano_activo': true
        }
    });

}) (this, this.document);