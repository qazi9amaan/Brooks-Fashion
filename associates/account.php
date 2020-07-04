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
$numDeliveringOrders =$db->where('orders.order_status', 'delivering')->where('associate_accounts.id', $current_associate)->join("products", "orders.product_id=products.id", "INNER")->join("associate_accounts", "associate_accounts.id = products.product_owner", "INNER")->getValue ("orders", "count(*)");

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
    <?php include BASE_PATH.'/includes/flash_messages.php'; ?>
	

			 <div class="row ">
  
       <div class="col-md-12">
       <div class="panel panel-chart-red">
           <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-12 text-left">
                        <span>Disclaimer</span>
                        <p class="text-justify" >
                        	<strong> Dear associate, </strong> we are happy to see you here. Please understand that our team is still trying to make it an easeless experience for you, please be patient! Dont hesitate to contact us directly if you fall into an error.
                        	We are here for you! <br>
                        <a href="https://chat.whatsapp.com/EQ176kEExOiIe8ETYsbhkk" class="btn btn-success btn-sm " style="margin-top:5px" > <i class="fa fa-whatsapp" > </i> Help center</a>
                        </p>
                        </div>
                    </div>
                </div>
           </div>
       </div>
  
  <div class="col-md-12">
  <div class="panel panel-chart-white">
      <div class="panel-heading">
               <div class="row">
                   <div class="col-xs-12 text-left">
                   <span>Contribute to brooks</span>
                   <p class="text-justify" >
                       <strong> Dear associate, </strong> we are happy to serve you here. We are enhancing our service. You can contribute to us anytime for the better experience.
                    <br>
                   <a href="https://rzp.io/l/brooks-fashion" class="btn btn-primary btn-sm " style="margin-top:5px" > <i class="fa fa-heart" > </i> Contribute</a>
                   </p>
                   </div>
               </div>
           </div>
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
        
         <div class="col-lg-4">
        <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-thumbs-up fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $numDeliveringOrders;  ?></div>
                            <div>To be delivered / Approved Orders</div>
                        </div>
                    </div>
                </div>
                <a href="panel-items/orders/delivering_orders.php">
                    <div class="panel-footer">
                        <span class="pull-left">View All delivery orders</span>
                        <span class="pull-right"><i class="fa  fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- /.row -->


</div>
<!-- /#page-wrapper -->

<?php include_once('includes/footer.php'); ?>
