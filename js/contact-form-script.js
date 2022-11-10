$(document).ready(function() {

    "use strict"; //Start of Use Strict
 
    //CONTACT FORM VALIDATION	
    if ($('#contact-form').length) { 
        $('#contact-form').each(function() {
            $(this).validate({				
                errorClass: 'error',
                submitHandler: function(form) {
                    $.ajax({
                        type: "POST",
						dataType: "json",
                        url: "php/form-process.php",
                        data: $(form).serialize(),
                        success: function(data) {
							//console.log(' data > ', data);							
                            if (data.success) {
                                $(form)[0].reset();
                                $(form).find('.sucessMessage').html(data.message);
                                $(form).find('.sucessMessage').show();
                                $(form).find('.sucessMessage').delay(3000).fadeOut();
                            } else {
                                $(form).find('.failMessage').html(data.message);
                                $(form).find('.failMessage').show();
                                $(form).find('.failMessage').delay(3000).fadeOut();
                            }
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                            $(form).find('.failMessage').html(textStatus );
                            $(form).find('.failMessage').show();
                            $(form).find('.failMessage').delay(3000).fadeOut();
                        }
                    });
                }
            });
        });
    }

    return false;
    // End of use strict
});

/*


$("#contactForm1").validator().on("submit", function (event) {
    if (event.isDefaultPrevented()) {
        // handle the invalid form...
        formError();
        submitMSG(false, "Did you fill in the form properly?");
    } else {
        // everything looks good!
        event.preventDefault();
        submitForm();
    }
});


function submitForm(){
    // Initiate Variables With Form Content
    var name = $("#name").val();
    var email = $("#email").val();
    var msg_subject = $("#msg_subject").val();
    var message = $("#message").val();


    $.ajax({
        type: "POST",
        url: "php/form-process.php",
        data: "name=" + name + "&email=" + email + "&msg_subject=" + msg_subject + "&message=" + message,
        success : function(text){
            if (text == "success"){
                formSuccess();
            } else {
                formError();
                submitMSG(false,text);
            }
        }
    });
}

function formSuccess(){
    $("#contactForm")[0].reset();
    submitMSG(true, "Message Submitted!")
}

function formError(){
    $("#contactForm").removeClass().addClass('shake animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
        $(this).removeClass();
    });
}

function submitMSG(valid, msg){
    if(valid){
        var msgClasses = "h3 text-center tada animated text-success";
    } else {
        var msgClasses = "h3 text-center text-danger";
    }
    $("#msgSubmit").removeClass().addClass(msgClasses).text(msg);
} */