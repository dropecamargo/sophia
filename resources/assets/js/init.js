/**
* Init Class
*/

/*global*/
var app = app || {};

(function ($, window, document, undefined) {

    var InitComponent = function() {

        //Init Attributes
        $.ajaxSetup({
            cache: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    }

    String.prototype.replaceAll = function(search, replace)
    {
        if(!replace)
            return this;
        return this.replace(new RegExp('[' + search + ']', 'g'), replace);
    };

    InitComponent.prototype = {

        /**
        * Constructor or Initialize Method
        */
        initialize: function () {
            //Initialize
            this.initApp();
            this.initICheck();
            this.initAlertify();
            this.initSelect2();
            this.initToUpper();
            this.initSpinner();
            this.initInputMask();
            this.initDatePicker();
            this.initTimePicker();
            this.initDisabledPaste();
        },

        /**
        * Init Backbone Application
        */
        initApp: function () {
            window.app.AppRouter.start();
        },

        /**
        * Init icheck
        */
        initICheck: function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_minimal-red',
                radioClass: 'iradio_minimal-red'
            });
        },

        /**
        * Init alertify
        */
        initAlertify: function () {
            alertify.logPosition("bottom right");
        },

        /**
        * Init select2
        */
        initSelect2: function () {
            var _this = this,
                config = {
                  '.select2-default' : { language: 'es', placeholder: 'Seleccione', allowClear: false },
                  '.select2-default-clear'  : { language: 'es', placeholder: 'Seleccione', allowClear: true },
                  '.choice-select-autocomplete': {
                    language: "es",
                    placeholder:'Seleccione una opción',
                    ajax: {
                        delay: 250,
                        data: function (params) {
                            return {
                                q: params.term,
                                page: params.page
                            };
                        },
                        processResults: function (data, params) {
                            params.page = params.page || 1;
                            return {
                                results: data,
                                pagination: {
                                    more: (params.page * 30) < data.total_count
                                }
                            };
                        },
                        escapeMarkup: function (markup) { return markup; },
                        cache: true,
                        minimumInputLength: 1
                    }
                  }
                };

            // Instance selects to choice plugin
            for (var selector in config){
                $(selector).each(function(index, el) {
                    var $el = $(el);

                    if( $el.data('select2') == undefined ){
                        $el.select2(config[selector]);

                        // set default option
                        if(selector == '.choice-select-autocomplete') {

                            var initialId = $el.data('initial-value');
                            var $option = null;

                            if(initialId) {
                                var ajaxOptions = $el.data('select2').dataAdapter.ajaxOptions;

                                $option = $('<option selected>Cargando...</option>').val(initialId);
                                $el.append($option).trigger('change');

                                $.get( ajaxOptions.url, {id:initialId}, function(data) {
                                    $option.text(data[0].text).val(data[0].id);
                                    $option.removeData();
                                    $el.trigger('change');
                                });
                            }
                        }
                    }
                });
            }
        },

        /**
        * Init toUpper
        */
        initToUpper: function () {
            $('.input-toupper').change(function(){
                $(this).val( $(this).val().toUpperCase() );
            });
        },

        /**
        * Init initSpinner
        */
        initSpinner: function () {
            $('.spinner-percentage').spinner({
                step: 0.1,
                start: 0,
                min: 0,
                max: 100,
                numberFormat: "n",
                stop: function( event, ui ) {
                    if(!_.isNull(this.value) && !_.isUndefined(this.value) && !_.isEmpty(this.value)) {
                        if(!$.isNumeric( this.value ) || this.value > 100 || this.value < 0){
                            $(this).spinner( 'value', 0 );
                        }
                    }
               }
            });
        },

        /**
        * Init inputMask
        */
        initInputMask: function () {

            $("[data-mask]").inputmask();

            $("[data-currency]").inputmask({
                radixPoint: ",",
                alias: 'currency',
                removeMaskOnSubmit: true,
                unmaskAsNumber: true,
                min: 0,
                onBeforeMask: function (value, opts) {
                    var processedValue = value || 0;
                    return processedValue;
                },
                oncleared: function  (event) {
                    var $input = $(this);

                    if( this.inputmask.unmaskedvalue() == null || isNaN(parseFloat(this.inputmask.unmaskedvalue())) ) {
                        $input.inputmask('setvalue', 0);
                    }
                },
            });

            $("[data-currency-precise]").inputmask({
                radixPoint: ",",
                alias: 'currency',
                removeMaskOnSubmit: true,
                unmaskAsNumber: true,
                min: 0,
                digits: 0,
                onBeforeMask: function (value, opts) {
                    var processedValue = value || 0;
                    return processedValue;
                },
                oncleared: function  (event) {
                    var $input = $(this);

                    if( this.inputmask.unmaskedvalue() == null || isNaN(parseFloat(this.inputmask.unmaskedvalue())) ) {
                        $input.inputmask('setvalue', 0);
                    }
                },
            });

            $("[data-currency-numeric]").inputmask({
                radixPoint: ",",
                alias: 'numeric',
                groupSeparator: ",",
                autoGroup: true,
                autoUnmask: true
            });

            $("[data-currency-text]").inputmask({
                alias: 'numeric',
                rightAlign: false
            });
        },

        /**
        * Init initValidator
        */
        initValidator: function () {

            $('form[data-toggle="validator"]').each(function () {
                var $form = $(this)
                $.fn.validator.call($form, $form.data())
            })
        },

        /**
        * Init Datepicker
        */
        initDatePicker: function () {

            $('.datepicker').datepicker({
                autoclose: true,
                language: 'es',
                format: 'yyyy-mm-dd'
            });
        },

        /**
        * Init DisabledPaste
        */
        initDisabledPaste: function(){
            $('.input-dp').bind("cut copy paste",function(e) {
                e.preventDefault();
            });
        },

        /**
        * Init Timepicker
        */
        initTimePicker: function () {

            $(".timepicker").timepicker({
                showInputs: false,
                showMeridian: false
            });
        }
    };

    //Init App Components
    //-----------------------
    $(function() {
        window.initComponent = new InitComponent();
        window.initComponent.initialize();
    });

})(jQuery, this, this.document);