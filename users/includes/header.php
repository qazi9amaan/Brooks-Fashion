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
<style>
.navbar-toggler{
    border:none
}
.navbar-toggler-icon{
    height:1.2em;
}


</style>
</head>
<body>
    
<header>
        <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid"> 
                    <button id="open-sidenav-user" data-state="close" onclick="openNav()" 
                    class="navbar-toggler" 
                    type="button" 
                    data-toggle="collapse" >
                        <span class="navbar-toggler-icon"></span>
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
                        <a href="edit-account.php?operation=edit"style="color:none;" ><span class="fa fa-user-circle-o"></span></a>
                    </button>
                    <button  
                        class="navbar-toggler" 
                        type="button" 
                        data-toggle="collapse" >
                        <span class="fa fa-shopping-cart"></span>
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
    <div id="mySidenav" class="sidenav">
    <a href="/users/index.php">My Orders</a>
    <a href="/shop.php">Shop</a>
    <a href="/shipping.php">About</a>
    <a href="/about.php">Contact </a>
    <a href="/users/edit-account.php?operation=edit">Settings</a>
    <a href="/users/edit-account.php?operation=edit"> Seller</a>

    <a href="logout.php">Logout</a>
    </div>
    

    <main>
    <div class="container-fluid  mt-5">
        <div class="row ">
            <div class="col-md-2  mt-md-2 p-0">
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

    


