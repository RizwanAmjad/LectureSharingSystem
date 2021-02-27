$(document).ready(function () {
    $('#submit-data').click(function (e) { 
        e.preventDefault();
        startStatusAnimation('Updating data...');
        $.ajax({
            type: "POST",
            url: "assets/php/editprofile/editinfo.php",
            data: $('#data-form').serialize(),
            dataType: "JSON",
            /*success: function (response) {
                console.log(response);
            },
            */
            complete: function(response){
                if(response.responseJSON){
                    if($('#name').val().trim()!=''){
                        $('#name').attr('placeholder', $('#name').val()).val('');
                    }
                    if($('#email').val().trim()!=''){
                        $('#email').attr('placeholder', $('#email').val()).val('');
                    }
                    
                    startStatusAnimation('Data has been updated!');
                }
            }
        });
    });
});