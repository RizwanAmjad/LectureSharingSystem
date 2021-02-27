$(document).ready(function () {
    $('.enroll-button').click(function (e) {
        e.preventDefault();
        current = this.id;
        $.ajax({
            type: "POST",
            url: "assets/php/enroll.php",
            data: {'class_id': this.id},
            dataType: "JSON",
            success: function (response) {
                if(response == 1){
                    document.getElementById(current).innerHTML = 'Enrolled';
                }else{
                    document.getElementById(current).innerHTML = 'Can\'t Enrolled';
                }
            }
        });
        
    });
});