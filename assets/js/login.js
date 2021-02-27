
$(document).ready(function () {
    
    //change email input color to indicate invalid email
    $('#signInEmail').keyup(function () { 
        if(ValidateEmail($('#signInEmail').val())){
            $('#signInEmail').css('border-color', 'green');
        }
        else{
            $('#signInEmail').css('border-color', 'red');
        }
    });

    $('#signIn').click(function (e) { 
        e.preventDefault();
        startStatusAnimation('Loading...');
        if($('#signInPassword').val().length<8 || !ValidateEmail($('#signInEmail').val())){
            startStatusAnimation('Invalid Email or Password is less than 8 characters.').css('color', 'red');
        }
        else{
            //send request to php using ajax
            $.ajax({
                type: "POST",
                url: "assets/php/loginRequest.php",
                data: $('.signInForm').serialize(),
                dataType: "JSON",
                success: function (response) {
                    console.log(response);
                    if(response==1){
                        window.location.replace("home.php");
                    }
                    else{
                        startStatusAnimation('Incorrect User name or Password').css('color', 'red');
                    }
                }
            });
            }
        
    });
});
