/**
* Class Asignacion1Model extend of Backbone Model
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

//Global App Backbone
app || (app = {});

(function (window, document, undefined) {

    app.EnvioEquipoModel = Backbone.Model.extend({

        urlRoot: function () {
            return window.Misc.urlFull( Route.route('envioequipos.index') );
        },
        idAttribute: 'id',
        defaults: {
            'asignacion1_fecha': moment().format('YYYY-MM-DD'),
            'asignacion1_tercero': '',
            'asignacion1_tipo': '',
            'asignacion1_contrato': '',
            'asignacion1_direccion': '',
            'asignacion1_municipio': '',
            'asignacion1_area': '',
            'asignacion1_centrocosto': '',
            'asignacion1_zona': '',
            'tercero_nombre':'',
            'tercero_nit':'',
            'tecnico_nombre':'',
            'tecnico_nit':'',
            'contacto_nombre': '',
            'tcontacto_telefono': '',
            'asignacion1_tecnico': '',
            'asignacion1_contacto': '',
            'asignacion2_deproducto': ''
        }
    });

})(this, this.document);
