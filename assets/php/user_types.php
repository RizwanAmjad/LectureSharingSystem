<?php
    include('connection.php');
    session_start();
    $result = mysqli_query($connection, 'SELECT * FROM user_types;');
    $user_types = array();
    while($row = mysqli_fetch_assoc($result)){
        $user_types[$row['type_id']] = $row['type_name'];
    }
    $user_types['this'] = $_SESSION['user_type'];
    echo json_encode($user_types);
?>