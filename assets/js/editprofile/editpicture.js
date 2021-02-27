$(document).ready(function () {
    $('#submit-pic').click(function (e) { 
        e.preventDefault();
        var formData = new FormData();
        var files = $('#file')[0].files[0];
        const validImageTypes = ['image/gif', 'image/jpeg', 'image/png'];
        const  fileType = files['type'];
        formData.append('file', files);
        if($('#file').val() && validImageTypes.includes(fileType)){
            startStatusAnimation('Uploading...');
            
            $.ajax({
                type: "POST",
                url: "assets/php/editprofile/editpicture.php",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                complete: function (response) {
                    
                    $('#profile-pic-holder').attr('src', 'assets/images/profile_pictures/'+response.responseJSON);
                    $('#img-holder').attr('src', 'assets/images/profile_pictures/'+response.responseJSON);
                    startStatusAnimation('Upload Complete!');
                }
                
                
            });
            
        }
        else{
            startStatusAnimation('No picture selected').css('color', 'red');
        }
    });
});