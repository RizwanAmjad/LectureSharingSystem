$(document).ready(function () {

    $('#create-class-input').click(function () {
        $('#create-class-input').val('');
        startStatusAnimation('');
    });

    

    $('#create-class').click(function (e) {
        e.preventDefault();
        if($('#create-class-input').val().trim()){
            className = $('#create-class-input').val().trim();
            $.ajax({
                type: "POST",
                url: "assets/php/user_types.php",
                dataType: "JSON",
                complete: function (response) {
                    resObj = response.responseJSON;
                    if(resObj[resObj['this']]=='Teacher'){
                        startStatusAnimation('Creating class please wait...');
                        $.ajax({
                            type: "POST",
                            url: "assets/php/home/createClass.php",
                            data: {'name': $('#create-class-input').val()},
                            dataType: "JSON",
                            complete: function (response) {
                                if(response.responseJSON==1){
                                    startStatusAnimation('Successfully created new class!');
                                    newClass = "<div class='card class-box' style='margin: 10px;'>"+
                                    '<div class="card-body">'+
                                        '<h4 class="card-title">'+className+'</h4>'+
                                        '<h6 class="card-subtitle mb-2 text-muted">Teacher: You.</h6>'+
                                    '</div>'+
                                '</div>';
                                    $('#class-enrolled').prepend(newClass);
                                }else{
                                    startStatusAnimation('There was an error try other name').css('color', 'red');
                                }
                            }
                        });
                    }else{
                        startStatusAnimation('Student can\'t create a class.').css('color', 'red');
                    }
                }
            });    
        }else{
            startStatusAnimation('Please Enter class name').css('color', 'red');
        }
        
    });

    
});