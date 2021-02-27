<?php
    include('../connection.php');
    session_start();
    $name_new = $_POST['name'];
    $email_new = $_POST['email'];
    $user_id = $_SESSION['user_id'];

    if($name_new == ''){
        $name_new = $_SESSION['user_name'];
    }
    if($email_new == ''){
        $email_new = $_SESSION['user_email'];
    }
    $query_string = "UPDATE users SET user_name = '$name_new', user_email = '$email_new' WHERE user_id = $user_id;";
    if($connection){        
        if(mysqli_query($connection, $query_string)){
            echo json_encode(1);
            $_SESSION['user_name'] = $name_new;
            $_SESSION['user_email'] = $email_new;
        }
        else{
            echo json_encode(0);
        }
    }
    else{
        echo json_encode(0);
    }
?>