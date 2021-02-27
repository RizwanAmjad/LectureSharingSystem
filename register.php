<?php
    session_start();
    if(sizeof($_SESSION)){
        header('Location: home.php');
    }
    $title = "Register to Site!";
    include('assets/php/connection.php');
    $type_res = mysqli_query($connection, 'SELECT * FROM user_types');
    
?>
<?php include('templates/header.php');?>

<link rel="stylesheet" href="assets/css/register.css">

<form class="signUpForm form border-light p-5">

    <p class="h4 mb-4 text-center">Sign Up</p>

    <input type="text" id="signUpName" name='name' class="form-control mb-4" placeholder="Full Name">
    <input type="email" id="signUpEmail" name='email' class="form-control mb-4" placeholder="E-mail">

    <input type="password" id="signUpPassword" name='password' class="form-control mb-4" placeholder="Password">
    
    <input type="password" id="signUpCPassword" name='cpassword' class="form-control mb-4" placeholder="Confirm Password">
    <select class="browser-default custom-select" id='type_name' name='type_name'>
        <option selected value="">Select User Type</option>
        <?php 
            while($row = mysqli_fetch_assoc($type_res)){
        ?>
        <option value="<?php echo $row['type_id'];?>"><?php echo $row['type_name'];?></option>
        <?php
            }
        ?>
    </select>
    <p id='status'></p>
    <div class="text-center">
        <p>Alrready a member?
            <a href="login.php">Login</a>
        </p>
    </div>
    <button type="button" id='signUp' class="btn btn-outline-primary">Sign Up</button>
</form>


<?php include('templates/footer.php');?>
<script src='assets/js/globalFunctions.js'></script>
<script src='assets/js/register.js'></script>