  $(document).ready(function() {
    $('#contact_form').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            titulo: {
                validators: {
                        stringLength: {
                        min: 5,
                        message: ' ',
                    },
                        notEmpty: {
                        message: ' '
                    }
                }
            },
             observacao: {
                validators: {
                     stringLength: {
                        min: 5,
                        message: ' ',
                    }
                }
            },
            quantidadevagas: {
                validators: {
                    notEmpty: {
                        message: ' '
                    }
                }
            },
            beneficios: {
                validators: {
                    notEmpty: {
                        message: ' '
                    }
                }
            },
            salario: {
                validators: {
                    notEmpty: {
                        message: ' '
                    }
                }
            },
            phone: {
                validators: {
                    notEmpty: {
                        message: ' '
                    },
                    phone: {
                        message: ' '
                    }
                }
            },
            cargo: {
                validators: {
                    notEmpty: {
                        message: ' '
                    }
                }
            },
            tipocontratacao: {
                validators: {
                    notEmpty: {
                        message: ' '
                    }
                }
            },
            jornadatrabalho: {
                validators: {
                    notEmpty: {
                        message: ' '
                    }
                }
            },
            experiencia: {
                validators: {
                    notEmpty: {
                        message: ' '
                    }
                }
            },

        }
    })
    .on('success.form.bv', function(e) {
        $('#success_message').slideDown({ opacity: "show" }, "slow") // Do something ...
            $('#contact_form').data('bootstrapValidator').resetForm();

            // Prevent form submission
            e.preventDefault();

            // Get the form instance
            var $form = $(e.target);

            // Get the BootstrapValidator instance
            var bv = $form.data('bootstrapValidator');

            // Use Ajax to submit form data
            $.post($form.attr('action'), $form.serialize(), function(result) {
                console.log(result);
            }, 'json');
        });
});