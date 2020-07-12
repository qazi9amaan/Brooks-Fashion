<?php
    if (!isset($_SESSION['user_logged_in'])) {
        header('Location:logout.php');
    }
    $db = getDbInstance();
    require_once '/var/www/html/admin/config/config.php';
    $db->where('user',  $_SESSION['public_user_id']);
    $user_full_name = $db->getValue('user_profiles','full_name');
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/css/styles.css">
    <script src="/js/jquery.min.js"></script>

<style>
#top-navbar .navbar-toggler{
    border:none
    
}
#top-navbar i{
    height:1.22em;
}

#top-navbar{
    color :#ff9700 !important;
}
#top-navbar a, #top-navbar i , #toggler {
    color :#333;
}
</style>
</head>
<body>
    
<header>
        <nav id="top-navbar" class="navbar  fixed-top navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid"> 
                    <button id="open-sidenav-user" data-state="close" 
                    class="navbar-toggler" 
                    type="button" 
                    data-toggle="collapse" >
                    <i class="fa fa-bars" aria-hidden="true"></i>
                    </button>
                    <button  
                        class="navbar-toggler" 
                        type="button" 
                        data-toggle="collapse" >
                        <a href="/index.php"style="color:none;" ><span class="fa fa-home"></span></a>
                    </button>
                    <button  
                        class="navbar-toggler" 
                        type="button" 
                        data-toggle="collapse" >
                        <a href="/users"style="color:none;" ><span class="fa fa-user-circle-o"></span></a>
                    </button>
                    <button  
                        class="navbar-toggler" 
                        type="button" 
                        data-toggle="collapse" >
                        <a href="/users/logout.php"style="color:none;" ><span class="fa  fa-arrow-circle-right"></span></a>
                    </button>
              


                <div class="collapse  navbar-collapse" id="navbar20">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item"> <a class="nav-link" href="/index.php">Store</a> </li>
                        <li class="nav-item"> <a class="nav-link" href="/shop.php">Shop</a> </li>
                        <li class="nav-item"> <a class="nav-link" href="/about.php">Contact</a> </li>
                        <li class="nav-item"> <a class="nav-link" href="/faq.php">FAQ</a> </li>

                    </ul>
                    <p class="d-none d-md-block lead mb-0 text-dark"> </i> <b> BROOKS FASHION</b> </p>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item mx-1"> <a class="nav-link" href="#"> <i class="fa fa-shopping-cart fa-fw fa-lg"></i> </a> </li>
                        <li class="nav-item mx-1"> <a class="nav-link" href="/users/edit-account.php?operation=edit"> <i class="fa fa-user-circle-o fa-fw fa-lg"></i> </a> </li>
                        <li class="nav-item mx-1"> <a class="nav-link" href="logout.php"> <i class="fa fa-arrow-circle-right fa-fw fa-lg"></i> </a> </li>
                    </ul>
                </div>
            </div>
           
        </nav>
        
       
    </header>        
        <!-- SIDE NAV -->
    <div id="mySidepanel" class="sidenav">
    <a href="/users/index.php">My Orders</a>
    <a href="/shop.php">Shop</a>
    <a href="/shipping.php">About</a>
    <a href="/about.php">Contact </a>
    <a href="/users/edit-account.php?operation=edit">Settings</a>
    <a href="/associates"> Seller's </a>

    <a href="logout.php">Logout</a>
    </div>
    

    <main>
    <div class="container-fluid  mt-5">
        <div class="row ">
            <div class="col-md-2  mt-md-3 p-0">
                <div class="side_nav">
                    <ul class="navbar-nav w-100 mx-auto mb-auto">
                        <li class="nav-item active"> <a class="nav-link" href="/users/index.php"><i class="fa fa-shopping-bag"></i> &nbsp; View My Orders</a> </li>
                        <li class="nav-item"> <a class="nav-link" href="/users/edit-account.php?operation=edit"><i class="fa fa-map-marker"></i> &nbsp; Address Settings</a> </li>
                        <li class="nav-item"> <a class="nav-link" href="/users/edit-account.php?operation=edit#privacy-settings"><i class="fa fa-cog"></i> &nbsp; Privacy Settings</a> </li>
                        <li class="nav-item"> <a class="nav-link" href="/users/edit-account.php?operation=edit#privacy-settings"><i class="fa fa-shopping-cart"></i> &nbsp; View Cart Items</a> </li>
                        <li class="nav-item"> <a class="nav-link" href="/associates/"><i class="fa fa-handshake-o"></i> &nbsp;Become a Seller</a> </li>
                        <li class="nav-item"> <a class="nav-link" href="/faq.php"><i class="fa fa-info-circle"></i> &nbsp;  &nbsp; More About Us</a> </li>
                        <li class="nav-item"> <a class="nav-link" href="/faq.php"><i class="fa fa-phone"></i> &nbsp; Talk to us now</a> </li>


                    </ul>
                </div>
            </div>

    

<script>
$('#open-sidenav-user').click(function(){
    if($(this).attr('data-state')==='close')
   {
    document.getElementById("mySidepanel").style.width = "250px";
    $(this).attr('data-state','open');
   }else{
        document.getElementById("mySidepanel").style.width = "0"; 
        $(this).attr('data-state','close');

   }

})

</script>
