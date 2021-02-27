<?php
    session_start();
    if(!sizeof($_SESSION)){
      header('location: index.php');
    }
    include('assets/php/connection.php');
    $title = 'Submit Assignment';
    include('templates/header.php');
    $assignment_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    $isteacher =  mysqli_num_rows(mysqli_query($connection, "SELECT * FROM users INNER JOIN user_types ON users.user_type=user_types.type_id WHERE user_id=$user_id AND type_name='Teacher';"));
?>

<?php include('templates/navigation.php');?>

<link rel="stylesheet" href="assets/css/assignment.css">
<!--Page starts here-->
<div id='all-container'>
    <div id='side-bar'>
        <div id='submissions'>
            
        </div>
        <p id='status'></p>
        
        <div id='options'>
            <form id='file-upload-form' method="POST" class="md-form" enctype="multipart/form-data">
                <div class="file-field inp">
                    <p id='assignment_id' style="display:none;"><?php echo $assignment_id;?></p>
                    <div class="btn btn-primary btn-sm float-left inp">
                        <span>Select Assignment File</span>
                        <input type="file" name="assignment-submission" id="file">
                    </div>
                </div>
                <input type="submit" value="Upload" class="btn btn-outline-success my-2 my-sm-0 inp" name="submit-file" id='submit-assignment'>
            </form>

        </div>

    </div>

    <div id='assignment-submission'>
        <?php
        $query_string = "SELECT * FROM `submission_users` WHERE assignment_id = $assignment_id;";
        $result = mysqli_query($connection, $query_string);
        $is_empty = mysqli_num_rows($result);

        //Directly getting data about assignments and its uploaders
        
        echo '<ul  class="list-group list-group-flush" id="submission-list"><label><b>Submissions:</b></label>';
        if(!$is_empty){
            echo '<p id="ass">No one has Submitted Assignment yet.</p>';
        }
        while($row = mysqli_fetch_assoc($result)){
        ?>
                <li class="list-group-item"><?php 
                echo $row['user_name'];
                if($user_id == $row['user_id']){
                ?>
                    <a href="#" class="card-link delete-button" id='<?php echo $row['submission_id'];?>'>Delete</a>
                <?php
                }
                if($isteacher){
                ?>
                    <a href="assets/files/Assignment Submissions/<?php echo $row['submission_name'];?>" class="card-link">Download</a>
                <?php
                }
                ?>
                </li>

        <?php
            }
            echo '</ul>';
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
<script src='assets/js/assignment-submit.js'></script>
<script src='assets/js/assignment-delete.js'></script>