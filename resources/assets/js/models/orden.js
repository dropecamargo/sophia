/**
* Class OrdenModel extend of Backbone Model
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

app || (app = {});

(function (window, document, undefined){

    app.OrdenModel = Backbone.Model.extend({

        urlRoot: function () {
            return window.Misc.urlFull (Route.route('ordenes.index') );
        },
        idAttribute: 'id',
        defaults: {

            'orden_fecha': moment().format('YYYY-MM-DD'),
            
            'orden_tercero': '',
            'orden_tipoorden':'',
            'orden_solicitante':'',
            'orden_placa':'',
            // 'tercero_nombre':'',
            //contadores
            'orden_persona':'',
            'orden_dano':'',
            'orden_prioridad':'',
            'orden_problema': '',
            'orden_abierta': true
        
        }
    });

}) (this, this.document);