//function to check that either the email entered by the user is valid
function ValidateEmail(mail) {
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail)){
        return (true);
    }
    //alert("You have entered an invalid email address!");
    return (false);
}

function startStatusAnimation(text_to_diplay){
    $('#status').text(text_to_diplay).css('color', 'green');
    $( "#status" ).animate({
        width: "70%",
        marginLeft: "10%"
    });
    return $('#status');
}

$('#logout').click(function (e) { 
    e.preventDefault();
    document.location = 'logout.php';
});
