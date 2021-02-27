<?php
    include('connection.php');

    $email = $_POST['email'];
    $password = $_POST['password'];
    $result = mysqli_query($connection, "SELECT * FROM users INNER JOIN user_types ON users.user_type=user_types.type_id WHERE user_email='$email' and user_password= '$password';");
    
    $result_array = mysqli_fetch_assoc($result);

    if($result_array){
        session_start();
        $_SESSION = $result_array;
        echo json_encode(1);
    }
    else{
        echo json_encode(0);
    }

?>