$(document).ready(function () {

    $('#signUpEmail').keyup(function () { 
        if(ValidateEmail($('#signUpEmail').val())){
            $('#signUpEmail').css('border-color', 'green');
        }
        else{
            $('#signUpEmail').css('border-color', 'red');
        }
    });

    //function that removes text from the the status when user clicks on the password field
    $("input[type='password']").click(function(){
        $('#status').text('');
    });

    //Sign up function that requests php to communicate with the database
    $('#signUp').click(function (e) { 
        e.preventDefault();
        //Just for good look animate the status
        startStatusAnimation('Loading...');
        
        //check whether all fields are entered of not.
        if($('#signUpName').val()!='' && $('#signUpEmail').val()!='' && $('#signUpPassword')!='' && ValidateEmail($('#signUpEmail').val()) && $('#type_name').val()!=''){
            if($('#signUpPassword').val()==$('#signUpCPassword').val()){
                var password = $('#signUpPassword').val();
                if(password.length>=8){
                    //sending ajax request to the php
                    $.ajax({
                        type: "POST",
                        url: "assets/php/registerationRequest.php",
                        data: $('.signUpForm').serialize(),
                        dataType: 'JSON',
                        /*
                        success: function (response) {
                            res = response.responseJSON;
                            console.log(res);
                           if(res==1){
                               console.log("Han Ok hia");
                                //window.location.replace("login.php");
                           }else{
                                startStatusAnimation('Error in Signing Up.').css('color', 'red');
                           }
                        },
                        */
                        complete: function (response) {
                            
                            if(response.responseJSON==1){
                                
                                window.location.replace("login.php");
                            }else{
                                 startStatusAnimation('Error in Signing Up.').css('color', 'red');
                            }
                            
                        }            
                        
                    });
                }
                else{
                    startStatusAnimation('Passwords should atleast be 8 characters').css('color', 'red');
                }
            }
            else{
                startStatusAnimation('Passwords Donot Match').css('color', 'red');
            }
        }
        else{
            startStatusAnimation('Input all fields and email should be valid').css('color', 'red');
        }
        
        
    });

});