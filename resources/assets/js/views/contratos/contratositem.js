/**
* Class ContactItemView  of Backbone Router
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

//Global App Backbone
app || (app = {});

(function ($, window, document, undefined) {

    app.ContratoItemView = Backbone.View.extend({

        tagName: 'tr',
        template: _.template( ($('#contrato-item-list-tpl').html() || '') ),
        events: {
            'click .btn-edit-contrato': 'editContrato',
        },
        parameters: {
            wrapper: null,
            edit: false,
            dataFilter: {}
        },

        /**
        * Constructor Method
        */
        initialize: function(opts){

            //Init Attributes
                 if( opts !== undefined && _.isObject(opts.parameters) )
                this.parameters = $.extend({},this.parameters, opts.parameters);

                this.parameters.wrapper

            // Events Listener
            this.listenTo( this.model, 'change', this.render );
        },

        /*
        * Render View Element
        */
        render: function(){

            var attributes = this.model.toJSON();
            attributes.edit = this.parameters.edit;

            this.$el.html( this.template(attributes) );

            return this;
        },


    });

})(jQuery, this, this.document);