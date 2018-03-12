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
                        message: 'O titulo da vaga precisa ter mais do que 5 caracteres',
                    },
                        notEmpty: {
                        message: 'Por favor, preencha o titulo da vaga'
                    }
                }
            },
             observacao: {
                validators: {
                     stringLength: {
                        min: 5,
                        message: 'A observação da vaga precisa ter mais do que 5 caracteres',
                    }
                }
            },
            quantidadevagas: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, preencha a quantidade de profissionais que serão contratados'
                    }
                }
            },
            beneficios: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, preencha os benefícios da vaga'
                    }
                }
            },
            salario: {
                validators: {
                     stringLength: {
                        min: 2,
                        message: 'O salário da vaga precisa ter mais do que 2 caracteres',
                    },
                    notEmpty: {
                        message: 'Por favor, preencha o salário da vaga'
                    }
                }
            },
            phone: {
                validators: {
                    notEmpty: {
                        message: 'Please supply your phone number'
                    },
                    phone: {
                        country: 'US',
                        message: 'Please supply a vaild phone number with area code'
                    }
                }
            },
            address: {
                validators: {
                     stringLength: {
                        min: 8,
                    },
                    notEmpty: {
                        message: 'Please supply your street address'
                    }
                }
            },
            city: {
                validators: {
                     stringLength: {
                        min: 4,
                    },
                    notEmpty: {
                        message: 'Please supply your city'
                    }
                }
            },
            cargo: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, selecione o cargo'
                    }
                }
            },
            tipocontratacao: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, selecione o tipo de contratação'
                    }
                }
            },
            jornadatrabalho: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, selecione a jornada de trabalho'
                    }
                }
            },
            experiencia: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, selecione a experiência'
                    }
                }
            },
            zip: {
                validators: {
                    notEmpty: {
                        message: 'Please supply your zip code'
                    },
                    zipCode: {
                        country: 'US',
                        message: 'Please supply a vaild zip code'
                    }
                }
            },
            comment: {
                validators: {
                      stringLength: {
                        min: 10,
                        max: 200,
                        message:'Please enter at least 10 characters and no more than 200'
                    },
                    notEmpty: {
                        message: 'Please supply a description of your project'
                    }
                    }
                }
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