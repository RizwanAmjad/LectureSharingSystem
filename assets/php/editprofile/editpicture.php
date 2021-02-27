<?php
    
    include('../connection.php');
    session_start();
    $old_pic = $_SESSION['pic'];
    $root = $_SERVER['DOCUMENT_ROOT'];
    $file = $_FILES['file']['name'].mktime()."." . pathinfo($_FILES['file']['name'])['extension'];
    if (isset($_POST)) {
        if (move_uploaded_file($_FILES['file']['tmp_name'], $root."/PakPhones/assets/images/profile_pictures/". $file)) {    
            $email = $_SESSION['user_email'];
    
            if (mysqli_query($connection, "UPDATE pakphones.users SET pic='$file' where user_email='$email' ;")) {
                $_SESSION['pic'] = $file;
                if($old_pic!='default.jpg'){
                    unlink($root."/PakPhones/assets/images/profile_pictures/".$old_pic);
                }
                
                echo json_encode($file);
            }
        } else {
            echo json_encode(0);
        }
    }
    
?>