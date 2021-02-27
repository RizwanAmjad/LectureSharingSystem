<?php
    include('connection.php');
    $file_id = $_POST['file_id'];

    $file_info = mysqli_fetch_assoc(mysqli_query($connection, "SELECT file_id, file_name, type_name FROM file_users WHERE file_id = $file_id;"));
    $root = $_SERVER['DOCUMENT_ROOT'];
    $result = mysqli_query($connection, "DELETE FROM `file` WHERE file_id = $file_id;");
    
    if($result){
        $type_name = $file_info['type_name'];
        $file_name = $file_info["file_name"];
        unlink($root."/PakPhones/assets/files/$type_name/$file_name");
        echo json_encode(1);
    }else{
        echo json_encode(0);
    }
?>