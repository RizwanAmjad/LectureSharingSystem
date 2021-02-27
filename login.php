
<?php
    session_start();
    if(sizeof($_SESSION)){
        header('Location: home.php');
    }
    $title = "Login to Site!";
?>
<?php include('templates/header.php');?>

<link rel="stylesheet" href="assets/css/register.css">

<form class="signInForm form border-light p-5">

    <p class="h4 mb-4 text-center">Sign In</p>

    <input type="email" id="signInEmail" name='email' class="form-control mb-4" placeholder="E-mail">

    <input type="password" id="signInPassword" name='password' class="form-control mb-4" placeholder="Password">
    
    <p id='status'></p>
    <div class="text-center">
        <p>Not a member?
            <a href="register.php">Register</a>
        </p>
    </div>
    <button type="button" id='signIn' class="btn btn-outline-primary">Sign In</button>
</form>
<?php include('templates/footer.php');?>
<script src='assets/js/globalFunctions.js'></script>
<script src='assets/js/login.js'></script>