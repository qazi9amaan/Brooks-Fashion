<?php

$db = getDbInstance();
$current_associate = $_SESSION['associate_user_id'] ;
$numActivities = $db->where('associate_id', $current_associate)->getValue ("associate_notifications", "count(*)");
$numOrders = $db->where('owner', $current_associate)->getValue ("order_notifcations", "count(*)");

$numNotifications=$numActivities+$numOrders;

?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Associate| Account</title>

        <!-- Bootstrap Core CSS -->
        <link  rel="stylesheet" href="/admin/assets/css/bootstrap.min.css"/>

        <!-- MetisMenu CSS -->
        <link href="/admin/assets/js/metisMenu/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="/admin/assets/css/sb-admin-2.css" rel="stylesheet">

        <link href="/admin/assets/css/style.css" rel="stylesheet">
        <!-- Custom Fonts -->
        <link href="/admin/assets/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
       
        <script src="/admin/assets/js/jquery.min.js" type="text/javascript"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    </head>

    <body>

        <div id="wrapper">

            <!-- Navigation -->
            <?php if (isset($_SESSION['associate_logged_in']) && $_SESSION['associate_logged_in'] == true): ?>
                <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                       
                <div class="">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <div class="d-flex justify-content-between">
                        <a class="navbar-brand" href="">Administrator</a>
                        <ul class="nav navbar-top-links text-right mr-0 navbar-right">
                            <!-- /.dropdown -->
                            <li id="notification_btn">
                            <div style="background:#f8f8f8;">
                            <span style="margin-right: -17px;margin-top: -2px;" class="badge badge-primary"><?php echo $numNotifications; ?></span>
                            <a onclick="openNav()" href="#"><i class="fa fa-bell fa-fw"></i></a>
                            
                            </div>
                            </li>

                       

                            <!-- /.dropdown -->
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i></a>
                                <ul class="dropdown-menu dropdown-user">
                                    <li><a href="/associates/panel-items/profile/edit-profile.php"><i class="fa fa-user fa-fw"></i> User Profile</a></li>
                                    <li><a href="/associates/panel-items/profile/change-password.php"><i class="fa fa-gear fa-fw"></i> Settings</a></li>
                                    <li class="divider"></li>
                                    <li><a href="/associates/logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
                                </ul>
                                <!-- /.dropdown-user -->
                            </li>
                            <!-- /.dropdown -->
                        </ul>
                        </div>
                    </div>
                    <!-- /.navbar-header -->


                    <div class="navbar-default sidebar" role="navigation">
                        <div class="sidebar-nav navbar-collapse">
                            <ul class="nav" id="side-menu">
                            <li><a href="/index.php"><i class="fa fa-arrow-circle-left fa-fw"></i> Store</a></li>

                                <li><a href="/associates/index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a></li>
                              
                               

                                <li<?php echo (CURRENT_PAGE == 'products.php' || CURRENT_PAGE == 'add_product.php?operation=create') ? ' class="active"' : ''; ?>>
                                    <a href="#"><i class="fa fa-shopping-bag fa-fw"></i> Products<i class="fa arrow"></i></a>
                                    <ul class="nav nav-second-level">
                                        <li><a href="/associates/panel-items/products/products.php"><i class="fa fa-info-circle fa-fw"></i>Product Status</a></li>
                                        <li><a href="/associates/panel-items/products/approved_products.php"><i class="fa fa-check fa-fw"></i> Approved Products</a></li>

                                        <li><a href="/associates/panel-items/products/add_product.php"><i class="fa fa-plus fa-fw"></i> Add Product</a></li>
                                    </ul>
                                </li>
                                <li<?php echo (CURRENT_PAGE == 'orders.php' || CURRENT_PAGE == 'acc_orders.php' ||CURRENT_PAGE == 'accepted_orders.php'||CURRENT_PAGE == 'rejected_orders.php'||CURRENT_PAGE == 'delivered_orders.php' ) ? ' class="active"' : ''; ?>>
                                        <a href="#"><i class="fa fa-shopping-bag fa-fw"></i> Orders<i class="fa arrow"></i></a>
                                        <ul class="nav nav-second-level">
                                            <li><a href="/associates/panel-items/orders/orders.php"><i class="fa fa-shopping-bag fa-fw"></i> Orders</a></li>
                                            <li><a href="/associates/panel-items/orders/accepted_orders.php"><i class="fa  fa-check fa-fw"></i>  Accepted Orders</a></li>
                                            <li><a href="/associates/panel-items/orders/rejected_orders.php"><i class="fa  fa-remove fa-fw"></i> Rejected Orders</a></li>
                                            <li><a href="/associates/panel-items/orders/delivered_orders.php"><i class="fa  fa-truck fa-fw"></i> Delivered Orders</a></li>
                                            <li><a href="/associates/panel-items/orders/delivering_orders.php"><i class="fa  fa-thumbs-up fa-fw"></i> To be delivered Orders</a></li>


                                         
                                        </ul>
                                </li>
                            </ul>
                        </div>
                        <!-- /.sidebar-collapse -->
                    </div>
                    <!-- /.navbar-static-side -->
                    
                </nav>
        
        		
        
            <?php endif; ?>
            <?php include "notification_drawer.php" ?>

            <!-- The End of the Header -->
        