<?php
    session_start();
    if(!sizeof($_SESSION)){
      header('location: index.php');
    }
    include('assets/php/connection.php');
    $class_id = $_GET['class_id'];
    $user_id = $_SESSION['user_id'];
    $class = mysqli_query($connection, "SELECT * FROM class WHERE class_id=$class_id");
    $class = mysqli_fetch_assoc($class);
    $title = $class['class_name'];
    
    include('templates/header.php');
?>

<?php include('templates/navigation.php');?>

<link rel="stylesheet" href="assets/css/class.css">
<!--Page starts here-->
<div id='all-container'>
    <div id='side-bar'>
        <div id='audience'>
            <?php 
                $is_enrolled = mysqli_num_rows(mysqli_query($connection, "SELECT * FROM users_class WHERE user_id=$user_id AND class_id=$class_id"));
            ?>
            <h4><?php echo $class['class_name'];?></h4>
            <a href="#" class="card-link <?php if($is_enrolled){echo 'unenroll-button';}else{echo 'enroll-button';} ?>" id='<?php echo $class_id;?>'>
                <?php if($is_enrolled){echo 'Unenroll';}else{echo 'Enroll';} ?>
            </a>
            <?php
            $result = mysqli_query($connection, "SELECT * FROM users_class WHERE class_id=$class_id ORDER BY enrolment_id;");
            echo '<ul  class="list-group list-group-flush"><label><b>Audience:</b></label>';
                while($row = mysqli_fetch_assoc($result)){
            ?>
                    <li class="list-group-item"><?php 
                    echo $row['user_name']; 
                    if($row['user_id']==$row['class_teacher']){
                        echo ' (Teacher)';
                    }
                    ?></li>
            <?php
                }
                echo '</ul>';
            ?>
        </div>
        <p id='status'></p>
        <?php
            $type_res = mysqli_query($connection, 'SELECT * FROM file_type');
        ?>
        <div id='options'>
            <form id='file-upload-form' method="POST" class="md-form" enctype="multipart/form-data">
                <div class="file-field inp">
                    <p id='class_id' style="display:none;"><?php echo $class_id;?></p>
                    <div class="btn btn-primary btn-sm float-left">
                        <span>Select Lecture File</span>
                        <input type="file" name="lecture" id="file">
                    </div>
                </div>
                <select class="browser-default custom-select inp" id='type_name' name='type_name'>
                    <option selected value="">Select File Type</option>
                    <?php 
                        while($row = mysqli_fetch_assoc($type_res)){
                    ?>
                    <option value="<?php echo $row['type_id'];?>"><?php echo $row['type_name'];?></option>
                    <?php
                        }
                    ?>
                </select>
                <input type="submit" value="Upload" class="btn btn-outline-success my-2 my-sm-0 inp" name="submit-lec" id='submit-lec'>
            </form>

        </div>

    </div>

    <div id='lecture-assignments'>
        <h4>Assignments</h4>
        <div id='assignments'>
            
            <?php
            $assignment = mysqli_query($connection, "SELECT * FROM file_users WHERE type_name = 'Assignments' AND class_id = $class_id;");
            $is_empty = mysqli_num_rows($assignment);
            if(!$is_empty){                    
                echo '<p id="ass">No Assignments.</p>';
            }
              while($row = mysqli_fetch_assoc($assignment)){
                
            ?>
    
            <div class="card class-box" style='margin: 10px;'>                    
                <div class="card-body">
                        <h4 class="card-title"><?php echo $row['file_name'];?></h4>
                        <h6 class="card-subtitle mb-2 text-muted">Author: <?php echo $row['user_name'];?></h6>
                        <p class="card-text">Date: <?php echo $row['date'];?></p>
                        <p class="card-text">Time: <?php echo $row['time'];?></p>
                        <a href="assets/files/Assignments/<?php echo $row['file_name']?>" class="card-link">Download</a>
                        <?php
                        if($is_enrolled){
                        ?>
                            <a href="assignment.php?id=<?php echo $row['file_id'];?>" class="card-link">Open</a>
                        <?php
                        }
                        if($user_id == $row['user_id']){
                        ?>
                            <a href="#" class="card-link delete-button" id='<?php echo $row['file_id'];?>'>Delete</a>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                
            <?php
                }
            ?>
            
        </div>
        <h4>Lectures</h4>
        <div id='lecture'>
            
            <?php
            $lectures = mysqli_query($connection, "SELECT * FROM file_users WHERE type_name = 'Lectures' AND class_id = $class_id;");
            $is_empty = mysqli_num_rows($lectures);
            if(!$is_empty){                    
                echo '<p id="lec">No Lectures.</p>';
            }
              while($row = mysqli_fetch_assoc($lectures)){
                  
                
            ?>
    
            <div class="card class-box" style='margin: 10px;'>                    
                <div class="card-body">
                        <h4 class="card-title"><?php echo $row['file_name'];?></h4>
                        <h6 class="card-subtitle mb-2 text-muted">Author: <?php echo $row['user_name'];?></h6>
                        <p class="card-text">Date: <?php echo $row['date'];?></p>
                        <p class="card-text">Time: <?php echo $row['time'];?></p>
                        <a href="assets/files/Lectures/<?php echo $row['file_name']?>" class="card-link">Download</a>
                        <?php
                        if($user_id == $row['user_id']){
                        ?>
                            <a href="#" class="card-link delete-button" id='<?php echo $row['file_id'];?>'>Delete</a>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                
            <?php
                }
            ?>
        </div>
    </div>
</div>






<!--Page ends here-->
<?php
    include('templates/footer.php');
?>
<script src='assets/js/unenroll.js'></script>
<script src='assets/js/enroll.js'></script>
<script src='assets/js/globalFunctions.js'></script>
<script src='assets/js/class.js'></script>