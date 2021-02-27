<?php
    session_start();
    include('../connection.php');
    $class_name = $_POST['name'];
    $class_teacher = $_SESSION['user_id'];
    
    $query = mysqli_query($connection, "INSERT INTO class (class_name, class_teacher) VALUES('$class_name', '$class_teacher');");
    if($query){
        echo json_encode(1);
    }else{
        echo json_encode(0);
    }
    
?>