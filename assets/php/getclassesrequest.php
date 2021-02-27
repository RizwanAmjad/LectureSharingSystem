<?php
    session_start();
    include('connection.php');
    $search = $_POST['search'];
    $result = mysqli_query($connection, "SELECT class_id, class_name, class_teacher, user_name FROM class INNER JOIN users ON class.class_teacher=users.user_id WHERE class_name LIKE '%$search%';");
    if(!mysqli_num_rows($result)){
        echo "<p>No classes match your search.</p>";
    }
    $user_id = $_SESSION['user_id'];
    while($row = mysqli_fetch_assoc($result)){

?>

    <div class="card class-box">
        <div class="card-body">
            <?php
                $class_id = $row['class_id'];
                $is_enroled = mysqli_query($connection, "SELECT user_id, class_id FROM users_class where user_id = $user_id AND class_id = $class_id;");
                $is_enroled = mysqli_num_rows($is_enroled);
            ?>

            <h4 class="card-title"><?php echo $row['class_name'];?></h4>
            <h6 class="card-subtitle mb-2 text-muted">Teacher: <?php echo $row['user_name'];?></h6>
            <!--<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>-->
            <a href="#" class="card-link <?php if(!$is_enroled){echo 'enroll-button';} ?>" id='<?php echo $row['class_id'];?>'>
                <?php
                    if($is_enroled){
                        echo 'Enrolled';
                    }else{
                        echo 'Enroll';
                    }
                ?>
            </a>
            <a href="class.php?class_id=<?php echo $row['class_id'];?>" class="card-link">Open</a>
        </div>
    </div>

<?php
    }
?>

<script src='assets/js/enroll.js'></script>