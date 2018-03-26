  $(document).ready(function() {
    $('#formulario').bootstrapValidator({
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
            username: {
                validators: {
                     stringLength: {
                        min: 3,
                        message: ' ',
                    },
                    notEmpty: {
                        message: ' '
                    }
                }
            },
            password: {
                validators: {
                     stringLength: {
                        min: 3,
                        message: ' ',
                    },
                    notEmpty: {
                        message: ' '
                    }
                }
            },
            cnpj: {
                validators: {
                     stringLength: {
                        min: 14,
                        message: ' ',
                    },
                    notEmpty: {
                        message: ' '
                    }
                }
            },
            razaosocial: {
                validators: {
                     stringLength: {
                        min: 3,
                        message: ' ',
                    },
                    notEmpty: {
                        message: ' '
                    }
                }
            },
            nomefantasia: {
                validators: {
                     stringLength: {
                        min: 3,
                        message: ' ',
                    },
                    notEmpty: {
                        message: ' '
                    }
                }
            },
            porte: {
                validators: {
                    notEmpty: {
                        message: ' '
                    }
                }
            },
            areaatuacao: {
                validators: {
                     stringLength: {
                        min: 3,
                        message: ' ',
                    },
                    notEmpty: {
                        message: ' '
                    }
                }
            },
            responsavel: {
                validators: {
                     stringLength: {
                        min: 3,
                        message: ' ',
                    },
                    notEmpty: {
                        message: ' '
                    }
                }
            },
            telefone: {
                validators: {
                     stringLength: {
                        min: 3,
                        message: ' ',
                    },
                    notEmpty: {
                        message: ' '
                    }
                }
            },
            email: {
                validators: {
                     stringLength: {
                        min: 3,
                        message: ' ',
                    },
                    notEmpty: {
                        message: ' '
                    }
                }
            },
            site: {
                validators: {
                     stringLength: {
                        min: 3,
                        message: ' ',
                    },
                    notEmpty: {
                        message: ' '
                    }
                }
            },
            senha: {
                validators: {
                     stringLength: {
                        min: 3,
                        message: ' ',
                    },
                    notEmpty: {
                        message: ' '
                    }
                }
            },
            senhaconfirmacao: {
                validators: {
                     stringLength: {
                        min: 3,
                        message: ' ',
                    },
                    notEmpty: {
                        message: ' '
                    }
                }
            },


        }
    })
    .on('success.form.bv', function(e) {
        $('#success_message').slideDown({ opacity: "show" }, "slow") // Do something ...
            $('#formulario').data('bootstrapValidator').resetForm();

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