$(document).ready(function() {

    $('#registrationContest label.error').hide();

      /*
    jQuery.validator.addMethod('phoneFR', function(phone_number, element) {
        
	return this.optional(element) || phone_number.length > 9 && phone_number.match(/^0[1-68]([-. ]?[0-9]{2}){4}$/);
    },
    'Veuillez vérifier votre numéro de téléphone');
    
    $("#registrationContest").validate({
        
        rules : {
            
            sex : {
                
                required : true
            },
            
            lastname : {
                
                required : true,
                minlength : 2
            },
            
            firstname : {
                
                required : true,
                minlength : 2
            },
            
            email : {
                
                required : true,
                email : true
            },
            
            adress : {
                
                required : true
            },
            
            zip_code : {
                
                required : true,
                number : true,
                minlength : 5,
                maxlength : 5
            },
            
            city : {
                
                required : true
            },
            
            phone : {
                
                phoneFR : true
            },
            
            year_of_birth : {
                
                required : true,
                minlength : 4,
                maxlength : 4,
                number : true
            }
        },
        messages : {
            
            sex : 'Veuillez spécifier votre genre',
            
            lastname : {
                
                required : "Veuillez entrer votre nom de famille",
                minlength : "Votre nom de famille semble trop court"
            },
            
            firstname : {
                
                required : "Veuillez entrer votre prénom",
                minlength : "Votre prénom semble trop court"
            },
            
            email : {
                
                required : "Veuillez entrer votre adresse email",
                email : "Veuillez entrer une adresse email valide"
            },
            
            adress : {
                
                required : "Veuillez entrer votre adresse"
            },
            
            zip_code : {
                
                required : "Veuillez indiquer votre code postal",
                number : "Votre code postal ne doit contenir que des chiffres",
                minlength : "Votre code postal semble invalide",
                maxlength : "Votre code postan semble invalide"
            },
            
            city : {
                
                required : "Veuillez indiquer votre ville"
            },
            
            phone : {
                
                phoneFR : "Veuillez indiquer un numéro de téléphone valide, ex : 0298123456"
            },
            
            year_of_birth : {
                
                required : "Veuillez entrer votre date de naissance",
                minlength : "Votre date de naissance doit être au format : 19xx",
                maxlength : "Votre date de naissance doit être au format : 19xx",
                number : "Votre date de naissance semble contenir des lettres"
            }
        }
        
    });
    */


    var loader = jQuery('<div id="loader"><img src="views/img/loading.gif" alt="loading..." /></div>')
            .css({position: "relative", top: "1em", left: "5em"})
            .appendTo("body")
            .hide();
        
    
    var v = jQuery("#registrationContest").validate({
        
        submitHandler: function(form) {
            
            $(form).ajaxStart(function() {
                
                loader.show();
                
            }).ajaxStop(function() {
        
                loader.hide();
            
            }).ajaxError(function(a, b, e) {
    
            throw e;
        
            }).ajaxSubmit({
                
                    target: "#result"
            });
        }
    });
});






      
