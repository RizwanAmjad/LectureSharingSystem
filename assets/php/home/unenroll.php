<?php
    
    include('../connection.php');
    session_start();
    $class_id = $_POST['class_id'];
    $user_id = $_SESSION['user_id'];
    
    $result = mysqli_query($connection, "DELETE FROM `enrolment` WHERE `class_id` = '$class_id' AND `user_id` = '$user_id';");
    if($result){
        echo json_encode(1);
    }
    else{
        echo json_encode(0);
    }
    
?>
