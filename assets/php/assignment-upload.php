<?php
    include('connection.php');
    session_start();
    $user_id = $_SESSION['user_id'];
    $root = $_SERVER['DOCUMENT_ROOT'];
    $file = $_FILES['file']['name'].mktime()."." . pathinfo($_FILES['file']['name'])['extension'];
    $assignment_id = $_POST['assignment_id'];
    
    if (move_uploaded_file($_FILES['file']['tmp_name'], $root."/PakPhones/assets/files/Assignment Submissions/". $file)) {    
        
        if (mysqli_query($connection, "INSERT INTO `assignment_submission`(`submission_name`, `assignment_id`, `user_id`) VALUES ('$file', $assignment_id, $user_id);")) {
            echo json_encode(1);
        }
        else{
            echo json_encode(0);
        }
         
    } else {
        echo json_encode(0);
    }
?>