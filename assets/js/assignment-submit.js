$(document).ready(function () {
    $('#submit-assignment').click(function (e) { 
        e.preventDefault();
        var formData = new FormData();
        var files = $('#file')[0].files[0];
        //const validImageTypes = ['image/gif', 'image/jpeg', 'image/png'];
        //const  fileType = files['type'];
        formData.append('file', files);
        assignment_id = $('#assignment_id').html();
        formData.append('assignment_id', assignment_id);
        //formData.append('class_id', $('#class_id').html());
        if($('#file').val()){
            startStatusAnimation('Uploading...');
            $.ajax({
                type: "POST",
                url: "assets/php/assignment-upload.php",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function (response) {
                    if(response){
                        startStatusAnimation('Upload Complete!');
                        $('#submission-list').append('<li class="list-group-item">Your Submission.</li>');
                        $('#ass').text('');
                    }else{
                        startStatusAnimation('There was an Error! You are supposed to submit it once.').css('color', 'red');
                    }
                    
                }
                
                
            });
            
        }
        else{
            startStatusAnimation('Select file.').css('color', 'red');
        }
    });
});