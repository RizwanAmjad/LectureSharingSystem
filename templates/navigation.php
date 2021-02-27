<?php
    $pic="'assets/images/profile_pictures/".$_SESSION['pic']."'";
    if(is_null($_SESSION['pic'])){
      $pic="'assets/images/profile_pictures/default.jpg'";
    }
    //include('assets/php/user_types.php');
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <img id='profile-pic-holder' class="rounded-circle z-depth-2" alt="100x100" style="width: 45px; height: 45px; border: 1px solid grey; padding: 0px; margin: 0px; box-shadow: 2px 2px 8px black" src=<?php echo $pic; ?>
	          data-holder-rendered="true">
  <p style='color: white; margin-top: 15px; margin-left: 5px;'><?php echo $_SESSION['user_name'].' ('.$_SESSION['type_name'].') ';?></p>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  
  <div class="collapse navbar-collapse" id="navbarColor02">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="home.php">Home <span class="sr-only"></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="searchclasses.php">Classes</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Pricing</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">About</a>
      </li>
      <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Settings</a>
    <div class="dropdown-menu" style="">
      <a class="dropdown-item" id='edit-profile' href="editprofile.php">Edit Profile</a>
      
      <a class="dropdown-item" id='logout' href='logout.php'>Logout</a>
      <!--<div class="dropdown-divider"></div>
      <a class="dropdown-item" href="#">Separated link</a>-->
    </div>
  </li>
    </ul>
    <!--<form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="text" placeholder="Search">
      <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>-->
</nav>