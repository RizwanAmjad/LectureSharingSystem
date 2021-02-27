$(document).ready(function () {

    $('#search-text').click(function () {
        $('#search-text').val('');
        startStatusAnimation('');
    });

    $('#search-button').click(function (e) { 
        e.preventDefault();
        if($('#search-text').val().trim()!=''){
            startStatusAnimation('Loading Results...');
            $.ajax({
                type: "POST",
                url: "assets/php/getclassesrequest.php",
                data: {'search': $('#search-text').val().trim()},
                dataType: "HTML",
                success: function (response) {
                    $('#search-result').html(response);
                },
                complete: function (response) {
                    startStatusAnimation('');
                }
                
            }); 
        }else{
            startStatusAnimation('Please enter some keyword in Search Box').css('color', 'red');
        }
    });
    
});

