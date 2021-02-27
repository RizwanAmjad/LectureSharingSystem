$(document).ready(function () {
    $('#submit-lec').click(function (e) { 
        e.preventDefault();
        var formData = new FormData();
        var files = $('#file')[0].files[0];
        //const validImageTypes = ['image/gif', 'image/jpeg', 'image/png'];
        //const  fileType = files['type'];
        formData.append('file', files);
        fileType = $('#type_name').val();
        formData.append('fileType', fileType);
        formData.append('class_id', $('#class_id').html());
        title = files.name;
        if($('#file').val() && fileType!=''){
            startStatusAnimation('Uploading...');
            $.ajax({
                type: "POST",
                url: "assets/php/class-upload.php",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function (response) {
                    if(response){
                        startStatusAnimation('Upload Complete!');
                        newObject = "<div class='card class-box' style='margin: 10px;'>"+
                                    '<div class="card-body">'+
                                        '<h4 class="card-title">'+title+'</h4>'+
                                        '<h6 class="card-subtitle mb-2 text-muted">Teacher: You.</h6>'+
                                    '</div>'+
                                '</div>';
                        if(fileType==1){
                            $('#lecture').append(newObject);
                            $('#lec').text('');
                        }
                        else if(fileType==2){
                            $('#assignments').append(newObject);
                            $('#ass').text('');
                        }
                        
                    }else{
                        startStatusAnimation('There was an Error! You may need to enroll for this action').css('color', 'red');
                    }
                    
                }
                
                
            });
            
        }
        else{
            startStatusAnimation('Select file and It\'s type').css('color', 'red');
        }
    });
    $('.delete-button').click(function (e) { 
        e.preventDefault();
        
        fileId = this.id;
        
        $.ajax({
            type: "POST",
            url: "assets/php/delete-file.php",
            data: {'file_id': fileId},
            dataType: "JSON",
            success: function (response) {
                if(response == 1){
                    document.getElementById(fileId).innerHTML = 'Deleted';
                }else{
                    document.getElementById(fileId).innerHTML = 'Not Deleted';
                }
                document.getElementById(fileId).removeAttribute('id');
            }
        });
    });
});