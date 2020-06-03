<?php
session_start();
require_once '../admin/config/config.php';
require_once 'includes/auth_validate.php';

//Get DB instance. function is defined in config.php
$db = getDbInstance();
$current_associate = $_SESSION['associate_user_id'] ;

//Get Dashboard information
$numApprovedProducts = $db->where('product_owner', $current_associate)->getValue ("products", "count(*)");
$numNewProducts = $db->where('product_owner', $current_associate)->getValue ("associate_products", "count(*)");;
$numCategories = 0;
$numDeliveredOrders = $db->where('orders.order_status', 'delivered')->where('associate_accounts.id', $current_associate)->join("products", "orders.product_id=products.id", "INNER")->join("associate_accounts", "associate_accounts.id = products.product_owner", "INNER")->getValue ("orders", "count(*)");;
$numNewOrders = $db->where('orders.order_status', 'confirming')->where('associate_accounts.id', $current_associate)->join("products", "orders.product_id=products.id", "INNER")->join("associate_accounts", "associate_accounts.id = products.product_owner", "INNER")->getValue ("orders", "count(*)");
$numRejectedOrders = $db->where('orders.order_status', 'rejected')->where('associate_accounts.id', $current_associate)->join("products", "orders.product_id=products.id", "INNER")->join("associate_accounts", "associate_accounts.id = products.product_owner", "INNER")->getValue ("orders", "count(*)");
$numAcceptedOrders =$db->where('orders.order_status', 'accepted')->where('associate_accounts.id', $current_associate)->join("products", "orders.product_id=products.id", "INNER")->join("associate_accounts", "associate_accounts.id = products.product_owner", "INNER")->getValue ("orders", "count(*)");
include_once('includes/header-nav.php');
?>

<?php include 'assests/js/charts.php' ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-8">
            <h1 class="page-header">Dashboard</h1>
        </div>
        <div class="col-lg-4">
        <div class="page-action-links text-right">
            <?php if($numNewOrders==0)
            ?>
                <a href="/associates/panel-items/orders/orders.php" class="btn btn-danger"><span class="badge badge-light"><?php echo $numNewOrders;?></span> Orders</a>
            <?php ?>
                <a href="/associates/panel-items/products/add_product.php" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Add a Product</a>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row ">
       <div class=" col-md-8 ">
       <div class="panel panel-chart-white">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-12 text-right">
                        <span>Monthly Statistics</span>
                        <div id="chart"></div>

                        </div>
                    </div>
                </div>
                
            </div>
       </div>
       <div class="col-md-4">
       <div class="panel panel-chart-white">
           <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-12 text-right">
                        <span>Orders Details</span>
                        <div id="order_details"></div>
                        </div>
                    </div>
                </div>
           </div>
       </div>
       
        <!-- /.col-lg-12 -->
    </div>





    <!-- /.row -->
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-shopping-bag fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $numNewProducts; ?></div>
                            <div>New Products</div>
                        </div>
                    </div>
                </div>
                <a href="panel-items/products/products.php">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa  fa-check fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $numApprovedProducts;  ?></div>
                            <div>Approved Products</div>
                        </div>
                    </div>
                </div>
                <a href="panel-items/products/approved_products.php">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa  fa-times fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $numRejectedOrders;  ?></div>
                            <div>Rejected Orders</div>
                        </div>
                    </div>
                </div>
                <a href="panel-items/orders/rejected_orders.php">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-shopping-cart fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $numNewOrders;  ?></div>
                            <div>New Orders</div>
                        </div>
                    </div>
                </div>
                <a href="panel-items/orders/orders.php">
                    <div class="panel-footer">
                        <span class="pull-left">View New Orders</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-4">
        <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-hourglass-half fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $numAcceptedOrders;  ?></div>
                            <div>Accepted Orders</div>
                        </div>
                    </div>
                </div>
                <a href="panel-items/orders/accepted_orders.php">
                    <div class="panel-footer">
                        <span class="pull-left">View Ongoing Orders</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>

            <!-- /.panel -->
        </div>
        <!-- /.col-lg-8 -->
        <div class="col-lg-4">
        <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-truck fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $numDeliveredOrders;  ?></div>
                            <div>Delivered Orders</div>
                        </div>
                    </div>
                </div>
                <a href="panel-items/orders/delivered_orders.php">
                    <div class="panel-footer">
                        <span class="pull-left">View All Delivered Orders</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <!-- /.col-lg-4 -->
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->

<?php include_once('includes/footer.php'); ?>
