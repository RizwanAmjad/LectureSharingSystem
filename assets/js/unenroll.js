$(document).ready(function () {
    $('.unenroll-button').click(function (e) { 
        e.preventDefault();
        current = this.id;
        $.ajax({
            type: "POST",
            url: "assets/php/home/unenroll.php",
            data: {'class_id': this.id},
            dataType: "JSON",
            success: function (response) {
                
                if(response == 1){
                    document.getElementById(current).innerHTML = 'Unenrolled';
                }else{
                    document.getElementById(current).innerHTML = 'Can\'t Unenrolled';
                }
            }
        });
        
    });
});