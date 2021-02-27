<?php
    include('connection.php');
    $submission_id = $_POST['submission_id'];

    $root = $_SERVER['DOCUMENT_ROOT'];
    $file_info = mysqli_query($connection, "SELECT * FROM `assignment_submission` WHERE submission_id = $submission_id;");
    $result = mysqli_query($connection, "DELETE FROM `assignment_submission` WHERE submission_id = $submission_id;");
    
    $file_name = mysqli_fetch_assoc($file_info)['submission_name'];
    if($result){
        unlink($root."/PakPhones/assets/files/Assignment Submissions/$file_name");
        echo json_encode(1);
    }else{
        echo json_encode(0);
    }
    
?>