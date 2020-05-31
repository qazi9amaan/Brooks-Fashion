
<?php
session_start();
require_once '/var/www/html/admin/config/config.php';


$order_id = filter_input(INPUT_GET, 'order_id', FILTER_VALIDATE_INT);
$db = getDbInstance();
$db->where('orders.order_id', $order_id);
$db->join("products p", "orders.product_id=p.id", "INNER");
$db->join("user_profiles u", "u.user=orders.user_id", "INNER");
$order = $db->getOne("orders");


?>
<?php include 'includes/header.php' ?>
<style>
.option_panel .card div{
    cursor :pointer;
}
.indicators i{
    font-size:200px;
    color:#007bff
}
</style>
<div class="col mt-md-2">
    <div class="container-fluid m-0 p-0">
        <div class="row p-0">
            <div class="col-md-12 p-0 bg-light">
                <div class="breadcrumb mb-0">
                    <a class="breadcrumb-item" href="index.php">Qazi Amaan</a>
                    <a class="breadcrumb-item" href="index.php">Orders</a>
                    <span class="breadcrumb-item active"><?php echo $order['product_name']; ?></span>
                </div>
            </div>

            <div   class=" option_panel col-12 px-3 px-md-3 mt-5 mb-4 ">
              <div id="status-card" class="card ">
                <div id="toggler-status" data-state ="show" class="d-flex justify-content-between align-items-baseline">
                    <h3 class=" ml-4 mt-4 mb-3  ">Status</h3>
                    <span id="toggler-status" data-state ="show" class="mr-3"><i class="fa fa-caret-down"></i></span>
                </div>
               <div id="status-board">
               <div  class="card-group indicators text-center p-4 px-5">
                    <div class="card border-0 ">
                        <div class="card-img-top"> <i style="color:#28a745" class="fa fa-shopping-cart" aria-hidden="true"></i></div>
                        <div class="card-title mt-1" style="color:#28a745">Order placed</div>

                    </div>
                    <div class="card border-0 ">
                        <div class="card-img-top"> 
                        <?php 
                            if($order['order_status']=='rejected'){
                                $icon = 'fa fa-times-circle';
                                $color='#dc3545';
                                $msg='Rejected';
                            }else if($order['order_status']=='accepted'){
                                $icon = 'fa fa-check-circle';
                                $color='#28a745';
                                $msg='Accepted';

                            }else if($order['order_status']=='delivered'){
                                $icon = 'fa fa-check-circle';
                                $color='#28a745';
                                $msg='Accepted';

                            }else{
                                $icon = 'fa fa-check-circle';
                                $color='#007bff';
                                $msg='Confirming';

                            }
                        ?>
                        <i style="color:<?php echo $color; ?>" class="<?php echo $icon;?>" aria-hidden="true"></i></div>
                        <div class="card-title mt-1 text-capitalize"  style="color:<?php echo $color; ?>"><?php echo $msg; ?></div>
                    </div>
                    <div class="card border-0 ">
                    <?php 
                            if($order['order_status']=='rejected'){
                                $icon = 'fa fa-map-marker';
                                $color='#007bff';
                                $msg='Shippment';
                            }else if($order['order_status']=='accepted'){
                                $icon = 'fa fa-map-marker';
                                $color='#007bff';
                                $msg='Shippment';

                            }else if($order['order_status']=='delivered'){
                                $icon = 'fa fa-map-marker';
                                $color='#28a745';
                                $msg='Under Delivery';

                            }else{
                                $icon = 'fa fa-map-marker';
                                $color='#007bff';
                                $msg='Shippment';

                            }
                        ?>
                        <div class="card-img-top"> <i  style="color:<?php echo $color; ?>"class="<?php echo $icon; ?>" aria-hidden="true"></i></div>
                        <div style="color:<?php echo $color; ?>" class="card-title mt-1"><?php echo $msg; ?></div>

                    </div>
                </div>
                <hr>
                <div class="card-body">
                    <div class="contianer text-center">
                    
                    <?php 
                          if($order['order_status']=='rejected'){
                            $color='#dc3545';
                        }else if($order['order_status']=='accepted'){
                            $color='#28a745';
                        }else if($order['order_status']=='delivered'){
                            $color='#28a745';
                            $order['order_status_reason'] =
                            '
                            <p> Your order has been shipped! </p>
                            <p> Medium : '. $order['delivery_medium'].'</p>
                            <p> Reference : '. $order['delivery_tracking_number'].'</p>
                            ';

                        }else{
                            $color='#28a745';
                            $order['order_status_reason']='Your order has successfully been placed!';
                        }
                    
                    ?>
                    <h3 style="color:<?php echo $color; ?>" >
                    <?php echo $order['order_status_reason']; ?>

                    </h3>
                    </div>
                </div>
               </div>
              </div>
            </div>
           
            <div class=" option_panel col-12 px-md-3 mb-4">
                <div class="card">
                <div id="toggler-product" data-state ="hide" class="d-flex justify-content-between align-items-baseline">
                    <h3 class=" ml-4 mt-4 mb-3  ">Product Details</h3>
                    <span id="toggler-product" data-state ="hide" class="mr-3"><i class="fa fa-caret-down"></i></span>
                </div>
                <ul style="display:none;"id="product-board"  class="list-group pt-0 list-group-flush">
                <div class="px-3 py-4">
                    <div class="card-deck px-5">
                    <?php
                        $images = explode(",",$order['file_name']);
                        for ($x = 0; $x <= 2; $x++)
                        {
                            $imageURL = '/admin/uploads/'.$images[$x];
                    ?>
                        <div class="card">
                            <img class="card-img-top" src="<?php echo $imageURL; ?>">
                        </div>
                    <?php
                    }
                    ?>
                    <div class="card  border-0">
                     </div>
                     <div class="card border-0">
                     </div>
                     <div class="card border-0">
                     </div>
                     
                    </div>
                </div>
                <li class="list-group-item d-flex justify-content-between"><span>Name :</span> &nbsp;  &nbsp;<?php echo $order['product_name'] ?></li>
                <li class="list-group-item d-flex justify-content-between"><span>Description :</span>&nbsp;  &nbsp;<?php echo $order['product_desc'] ?></li>
                <li class="list-group-item d-flex justify-content-between"><span>Quality :</span> &nbsp; <?php echo $order['product_quality'] ?></li>
                <li class="list-group-item d-flex justify-content-between"><span>Price :</span>&nbsp; Rs &nbsp; <?php echo $order['product_discount_price'] ?>/=</li>
                
               
                </ul>
                </div>
            </div>

            <div class=" option_panel col-12 px-md-3 mb-4">
                <div class="card">
                <div  id="toggler-delivery" data-state ="hide" class="d-flex justify-content-between align-items-baseline">
                    <h3 class=" ml-4 mt-4 mb-3  ">Delivery Details</h3>
                    <span class="mr-3"><i class="fa fa-caret-down"></i></span>
                </div>
                <ul style="display:none;"id="delivery-board" id="billing-board" class="list-group pt-0 list-group-flush">
                <li class="list-group-item d-flex justify-content-between"><span>Name :</span> &nbsp;  &nbsp;<?php echo $order['full_name'] ?></li>
                <li class="list-group-item d-flex justify-content-between"><span>Email :</span>&nbsp;  &nbsp;<?php echo $order['email_address'] ?></li>
                <li class="list-group-item d-flex justify-content-between"><span>Phone :</span> &nbsp; <?php echo $order['phone'] ?></li>
                <li class="list-group-item d-flex justify-content-between"><span>Address :</span>&nbsp;  &nbsp; <?php echo $order['init_address'] ?>,</li>
                <li class="list-group-item text-md-right "><span> <?php echo $order['landmark'].', '.$order['town'].', '.$order['state'].' - '.$order['pincode'] ?></li>
                </ul>
                </div>
            </div>

            <div class=" option_panel col-12 px-md-3 ">
                <div class="card">
                     <div  id="toggler-billing" data-state ="hide" class="d-flex justify-content-between align-items-baseline">
                        <h3 class=" ml-4 mt-4 mb-4 ">Billing Details</h3>
                        <span id="toggler-billing" data-state ="hide" class="mr-3"><i class="fa fa-caret-down"></i></span>
                    </div>
                    <ul id="billing-board"  style="display:none;" class="list-group pt-0 list-group-flush ">
                    <li class="list-group-item d-flex justify-content-between"><span>Date :</span> &nbsp;  &nbsp;<?php echo date('Y-m-d ') ?></li>
                    <li class="list-group-item d-flex justify-content-between"><span>Name :</span> &nbsp;  &nbsp;<?php echo $order['full_name'] ?></li>
                    <li class="list-group-item d-flex justify-content-between"><span>Phone Number :</span>&nbsp;  &nbsp;<?php echo $order['phone'] ?></li>
                    <li class="list-group-item d-flex justify-content-between"><span>Product :</span> &nbsp;  &nbsp;<?php echo $order['product_name'] ?></li>
                    <li class="list-group-item d-flex justify-content-between"><span>Product price :&nbsp; </span> <span><strike>Rs <?php echo $order['product_price'] ?>/=</strike> &nbsp; Rs <strong id="product-price"> <?php echo $order['product_discount_price'] ?></strong>/= </span></span></li>
                    <li class="list-group-item d-flex justify-content-between"><span>Discount :&nbsp;</span> Rs <?php echo $order['product_price']- $order['product_discount_price'] ?>/= </li>
                    <li class="list-group-item d-flex justify-content-between"><span>Delivery Charges :&nbsp;</span><span> Rs <span id="delivery-charges">50</span>/=</span></li>
                    <li class="list-group-item d-flex justify-content-between">
                    <span>Final Price :</span> 
                    <span>
                        &nbsp; Rs <span class="final-price"><?php echo $order['amount']?> </span>/=
                    </span></li>
                </ul>
                </div>
            </div>
    </div>
</div>
</div>

    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/owl.carousel.min.js"></script>
    <script src="/js/custom.js"></script>

    <script>
    
    $('#toggler-billing').click(function() {
        if($('#toggler-billing').attr('data-state')==="hide")
        {
            $('#billing-board').show();
            $('#delivery-board').hide();
            $('#product-board').hide();
            $('#status-board').hide();


            $('#toggler-billing').attr('data-state','show')
        }else{
            $('#billing-board').hide();
            $('#toggler-billing').attr('data-state','hide')
        }
    })

    $('#toggler-product').click(function() {
        if($('#toggler-product').attr('data-state')==="hide")
        {
            $('#product-board').show();
            $('#delivery-board').hide();
            $('#billing-board').hide();
            $('#status-board').hide();

            $('#toggler-product').attr('data-state','show')
        }else{
            $('#product-board').hide();
            $('#toggler-product').attr('data-state','hide')
        }
    })

    $('#toggler-delivery').click(function() {
        if($('#toggler-delivery').attr('data-state')==="hide")
        {
            $('#delivery-board').show();
            $('#status-board').hide();

            $('#product-board').hide();
            $('#billing-board').hide();
            $('#toggler-delivery').attr('data-state','show')
        }else{
            $('#delivery-board').hide();
            $('#toggler-delivery').attr('data-state','hide')
        }
    })

    $('#toggler-status').click(function() {
        if($('#toggler-status').attr('data-state')==="hide")
        {
            $('#status-board').show();
            $('#product-board').hide();
            $('#billing-board').hide();

            $('#toggler-status').attr('data-state','show')
        }else{
            $('#status-board').hide();
            $('#toggler-status').attr('data-state','hide')
        }
    })
   
    </script>
</body>

</html>