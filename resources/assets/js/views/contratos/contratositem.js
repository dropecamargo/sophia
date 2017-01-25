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

        /**
        * Constructor Method
        */
        initialize: function(){

            //Init Attributes

            // Events Listener
            this.listenTo( this.model, 'change', this.render );
        },

        /*
        * Render View Element
        */
        render: function(){

            var attributes = this.model.toJSON();
            this.$el.html( this.template(attributes) );

            return this;
        },

        editContacto: function() {
            var view = new app.CreateContratoView({
                model: this.model
            });

            view.render();
        }

    });

})(jQuery, this, this.document);