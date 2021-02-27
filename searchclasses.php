<?php
    session_start();
    if(!sizeof($_SESSION)){
        header('location: index.php');
    }
    $title = 'Search For Classes';
    
    include('assets/php/connection.php');
    include('templates/header.php');
    

?>
<!--Page Starts here-->
<link rel="stylesheet" href="assets/css/searchclasses.css">
<?php include('templates/navigation.php');?>

<p id='status'></p>
<div id='all-container'>
    <div id='search-div'>
        <form id='search-classes' class="form-inline my-2 my-lg-0">
            <input id='search-text' class="form-control mr-sm-2" type="text" placeholder="Search">
            <button id='search-button' class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
    <div id='search-result'>
        <h3>Result Appears Here</h3>
        
    </div>
</div>




<!--Page ends here-->
<?php
    include('templates/footer.php');
?>
<script src='assets/js/globalFunctions.js'></script>
<script src='assets/js/searchclasses.js'></script>