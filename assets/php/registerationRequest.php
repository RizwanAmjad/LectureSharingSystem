<?php
    
    include('connection.php');
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $user_type = $_POST['type_name'];
    $password = '';
    
    if($_POST['password']==$_POST['cpassword']){
        $password = $_POST['password'];
        
        if($connection){
            $token = md5($email);
            $is_exe = mysqli_query($connection, "INSERT INTO `users`(`user_name`, `user_email`, `user_password`, `token`, `user_type`) VALUES ('$name', '$email', '$password', '$token', '$user_type')");
            if($is_exe){
                echo json_encode(1);
            }
            else{
                echo json_encode(0);
            }
        }else{
            echo json_encode(0);
        }
    }
    else{
        echo json_encode(0);
    }
    
?>