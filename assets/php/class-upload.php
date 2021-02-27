<?php
    include('connection.php');
    session_start();
    $author = $_SESSION['user_id'];
    $root = $_SERVER['DOCUMENT_ROOT'];
    $file = $_FILES['file']['name'].mktime()."." . pathinfo($_FILES['file']['name'])['extension'];
    $file_type = $_POST['fileType'];
    $result = mysqli_query($connection, "SELECT type_name FROM file_type WHERE type_id = $file_type");
    $type_name = mysqli_fetch_assoc($result)['type_name'];
    $class_id = $_POST['class_id'];
    $is_enrolled = mysqli_num_rows(mysqli_query($connection, "SELECT * FROM enrolment WHERE class_id = $class_id AND user_id = $author"));
    
    if ($is_enrolled) {
        if (move_uploaded_file($_FILES['file']['tmp_name'], $root."/PakPhones/assets/files/$type_name/". $file)) {    
            
            if (mysqli_query($connection, "INSERT INTO `file`(`file_name`, `file_type`, `author`, `class_id`) VALUES ('$file', $file_type, $author, $class_id);")) {
                echo json_encode(1);
            }
            else{
                echo json_encode(0);
            }
            
        } else {
            echo json_encode(0);
        }
    }else {
        echo json_encode(0);
    }
    
?>