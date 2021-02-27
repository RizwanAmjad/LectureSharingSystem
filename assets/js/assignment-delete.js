$(document).ready(function () {
    $('.delete-button').click(function (e) { 
        e.preventDefault();
        
        submission_id = this.id;
        
        $.ajax({
            type: "POST",
            url: "assets/php/assignment-delete.php",
            data: {'submission_id': submission_id},
            dataType: "JSON",
            success: function (response) {
                if(response == 1){
                    document.getElementById(submission_id).innerHTML = 'Deleted';
                }else{
                    document.getElementById(submission_id).innerHTML = 'Not Deleted';
                }
                document.getElementById(submission_id).removeAttribute('id');
            }
        });
    });
});