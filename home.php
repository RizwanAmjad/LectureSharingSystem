<?php
    session_start();
    if(!sizeof($_SESSION)){
      header('location: index.php');
    }
    $title = "Welcome ".$_SESSION['user_name'];
    
    include('templates/header.php');
?>

<!--Page starts here-->
<link rel="stylesheet" href="assets/css/home.css">
<?php include('templates/navigation.php');?>
<p id='status'></p>
<div id='all-container'>
  
  <div id='options'>
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroup-sizing-default">New</span>
      </div>
      <input type="text" id='create-class-input' class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
      <button type="button" id='create-class' class="btn btn-outline-primary">Create Class</button>
    </div>
        
  </div>


  <div id='my-classes'>
      <h4>My Classes</h4>

      <div id='class-enrolled'>
        <?php
          include('assets/php/connection.php');
          $user_id = $_SESSION['user_id'];
          $query_string = "SELECT users_class.user_id, users_class.class_id, users_class.class_name, users.user_id as teacher_id, users.user_name as teacher_name FROM users_class inner join users ON users.user_id = users_class.class_teacher WHERE users_class.user_id = $user_id ORDER BY enrolment_id DESC;";
          $result = mysqli_query($connection, $query_string);
          $is_empty = mysqli_num_rows($result);
          
          if(!$is_empty){
            echo '<p>No classes Enrolled.</p>';
          }
          while($row = mysqli_fetch_assoc($result)){
            
        ?>

        <div class="card class-box" style='margin: 10px;'>
                <div class="card-body">
                    <h4 class="card-title"><?php echo $row['class_name'];?></h4>
                    <h6 class="card-subtitle mb-2 text-muted">Teacher: <?php echo $row['teacher_name'];?></h6>
                    <!--<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>-->
                    <a href="#" class="card-link unenroll-button" id='<?php echo $row['class_id'];?>'>Unenroll</a>
                    <a href="class.php?class_id=<?php echo $row['class_id'];?>" class="card-link">Open</a>
                </div>
            </div>

        <?php
            }
        ?>
      </div>

  </div>
</div>


<!--Page ends Here-->

<?php
    include('templates/footer.php');
?>
<script src='assets/js/unenroll.js'></script>
<script src='assets/js/globalFunctions.js'></script>
<script src='assets/js/home.js'></script>