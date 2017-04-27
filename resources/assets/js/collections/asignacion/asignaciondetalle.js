/**
* Class Asignacion2sList of Backbone Collection
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

//Global App Backbone
app || (app = {});

(function (window, document, undefined) {

    app.AsignacionDetalleList = Backbone.Collection.extend({

        url: function() {
            return window.Misc.urlFull( Route.route('asignaciones.detalle.index') );
        },
        model: app.AsignacionDetalleModel,

        /**
        * Constructor Method
        */
        initialize : function(){

        },

        validar: function( data, resource ) {
            var error = { success: false, message: '' };

            // Validate exist
            var modelExits = _.find(this.models, function(item) {
                return item.get('asignacion2_producto') == data.asignacion2_producto;
            });

            if(modelExits instanceof Backbone.Model ) {
                error.message = 'El producto '+ data.producto_nombre +' ya fue agregado.'
                return error;
            }

            if( data.producto_tipo_search ){
                // Validate insert EQ in AC
                if( resource.producto_tercero == '' && resource.producto_contrato == ''){
                    var equipoExist = _.find(this.models, function(item){
                        return item.get('asignacion2_producto') == data.producto_tipo_search;
                    });

                    if( _.isUndefined(equipoExist) ){
                        error.message = 'Para poder agregar accesorio '+ data.producto_nombre +' primero debe agregar el equipo '+ data.producto_nombre_search+ '.';
                        return error;       
                    }
                }
            }

            error.success = true;
            return error;
        },

        eliminar: function( model ){
            var _this = this;
            
            if( model.get('tipo') == 'E' ){
                var arrayChilds = _.filter(this.models, function(item){
                    return item.get('producto_tipo_search') === model.get('asignacion2_producto');
                });

                _.each(arrayChilds, function(deleteChild){
                    if ( deleteChild instanceof Backbone.Model ) {
                        deleteChild.view.remove();
                        _this.remove(deleteChild);
                    }
                });
            }

            if( model.get('tipo') == 'R' ){
                var arrayChilds = _.filter(this.models, function(item){
                    return item.get('idFather') === model.get('id');
                });

                _.each(arrayChilds, function(deleteChild){
                    if ( deleteChild instanceof Backbone.Model ) {
                        deleteChild.view.remove();
                        _this.remove(deleteChild);
                    }
                });
            }
        }
   });
})(this, this.document);
