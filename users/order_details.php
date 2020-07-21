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


.badge-theme{   border: 0px !important;
    background: #ffd79c33 !important;
    color: #ff9700 !important;
    border-radius: .85rem !important;
}
.list-group-item{
    background :none !important;
    border-color: #fff;
}
.product-img{
    width:180px;
    height:260px;
    object-fit:cover;
}
#status-board> .card-group > .card{
    background :none !important;

}
.indicators i{
    font-size:45px;
}
#tracking-sec  .card, #tracking-sec-mob  .card {
    z-index: 0;
    background-color: #ffd79c33;
    padding-bottom: 20px;
    margin-top: 2rem;
    margin-bottom: 1rem;
    border-radius: .85rem;
    border-color: #fff;
}
#tracking-sec .top ,#tracking-sec-mob .top{
    padding-top: 40px;
    padding-left: 23% !important;
    padding-right: 23% !important
}

#progressbar {
    margin-bottom: 30px;
    overflow: hidden;
    color: #455A64;
    padding-left: 13%;
    margin-top: 30px
}

#progressbar li {
    list-style-type: none;
    font-size: 13px;
    width: 28%;
    float: left;
    position: relative;
    font-weight: 400
}


#progressbar .step0:before {
    font-family: FontAwesome;
    content: "\f10c";
    color: #fff
}

#progressbar li:before {
    width: 40px;
    height: 40px;
    line-height: 45px;
    display: block;
    font-size: 20px;
    background: #e3e3e3;
    border-radius: 50%;
    margin: auto;
    padding: 0px
}

#progressbar li:after {
    content: '';
    width: 100%;
    height: 12px;
    background: #e3e3e3;
    position: absolute;
    left: 0;
    top: 16px;
    z-index: -1
}

#progressbar li:last-child:after {
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px;
    position: absolute;
    left: -50%
}

#progressbar li:nth-child(2):after,
#progressbar li:nth-child(3):after {
    left: -50%
}

#progressbar li:first-child:after {
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px;
    position: absolute;
    left: 50%
}

#progressbar li:last-child:after {
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px
}

#progressbar li:first-child:after {
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px
}

#progressbar li.active:before,
#progressbar li.active:after {
    background: #ff9700
}

#progressbar li.active:before {
    font-family: FontAwesome;
    content: "\f00c"
}

.icon {
    width: 60px;
    height: 60px;
    margin-right: 15px
}

.icon-content {
    padding-bottom: 20px
}

@media screen and (max-width: 992px) {
    .icon-content {
        width: 50%
    }
}
.icon i{
    font-size:3rem;
}
.show-mob{
      display:none;
  }
@media only screen and (max-width: 992px) {
  .hide-mob {
    display:none;
  }
  .show-mob{
      display:block;
  }
}


 .todo-timeline .timeline-text {
	 display: flex;
	 justify-content: space-between;
}
 .todo-timeline .timeline-text .timeline-number {
	 margin-right: 60px;
}
 .todo-timeline .todo-title {
	 font-size: 50px;
	 color: #ff9700;
	 font-weight: bold;
	 white-space: nowrap;
}
 .todo-timeline .v-timeline {
	 margin-top: 30px;
}
 .todo-timeline .v-timeline ul {
	 position: relative;
}
 .todo-timeline .v-timeline li {
	 list-style-type: none;
	 padding: 0 0 30px;
	 position: relative;
	 overflow: hidden;
}
 .todo-timeline .v-timeline li .top-bold-label {
     font-size: 1.14rem;
     text-transform:uppercase;
     line-height:.8;
     font-weight: bold;
     color :#ff9700;
     font-weight:400;
     padding-left:35px;
}
 .todo-timeline .v-timeline li .mid-paragraph {
	 font-size: 1.4rem;
}
 .todo-timeline .v-timeline li .bottom-link {
	 color: #ff9700;
	 font-weight: bold;
	 font-size: 1.4rem;
}
 .todo-timeline .v-timeline .pl-30 {
	 padding-left: 30px;
}
 .todo-timeline .v-timeline .v-timeline-icon:before {
	 content: ' ';
	 height: 27px;
	 position: absolute;
	 top: 0;
	 left: 0;
	 width: 27px;
	 border-radius: 50%;
	 background: #ff9700;
}
 .todo-timeline .v-timeline .v-timeline-icon:after {
	 content: ' ';
	 border-left: 2px solid #ff9700;
	 display: inline-block;
	 position: absolute;
	 left: 12px;
	 height: 400px;
	 z-index: 400;
	 top: 27px;
}
 .todo-timeline .v-timeline .v-timeline-icon.v-last:before {
	 background: #ffd79c33;
}
 .todo-timeline .v-timeline .v-timeline-icon.v-last:after {
	 height: 0;
} .todo-timeline .v-timeline .v-timeline-icon.v-end:after {
	 height: 0;
}
.todo-timeline .v-timeline .v-timeline-icon.v-not:after {
    border-left: 2px dashed #ffd79c33;

}

 .todo-timeline .v-timeline .v-timeline-icon.v-not:before {
    background: #ffd79c33;
}
 .todo-timeline .v-timeline .v-timeline-icon.v-line-color:after {
	 border-left: 2px dashed #ffd79c33;
}
 

</style>
<div class="col mt-md-3">
    <div class="container-fluid m-0 p-0">
        <div class="row p-0">
            <div class="col-md-12 p-0  ">
                <div class="breadcrumb mb-0">
                <a class="breadcrumb-item text-capitalize" href="index.php"><?php echo $user_full_name; ?></a>
                    <a class="breadcrumb-item" href="index.php">Orders</a>
                    <span class="breadcrumb-item active"><?php echo $order['product_name']; ?></span>
                </div>
                <?php if($order['order_status']=='accepted'){?>
                   
                   <div class="col-12 px-md-3 my-3  ">
                       <div class="card alert-danger">
                           <div class="card-body text-alert">
                           <h4 class="alert-heading pb-2">Hola your order is availble!</h4>
                           <p class="text-justify">We are happy to see you here, please complete the futher steps to get your order delivered. Please make sure that the delivery address and product is correct.</p>
                           <hr>
                           <a  href="helper/complete-payment.php?order_id=<?php echo $order_id ?>" class="razorpay-payment-button">Complete your payment</a>
                           
                            </div>
                       </div>
                   </div>
                <?php }?>
                    <div id="tracking-sec-mob" class="col-12 px-3 mb-3 show-mob">
                    <div class="todo-timeline px-5  ">
                        <div class="row">
                            <div class="row">
                                <ul class="v-timeline">
                                <?php 
                                            if($order['order_status']=='rejected'){
                                            echo 
                                            '
                                            <li id="v-last" class="col">
                                            <span class="v-timeline-icon v-end"></span>
                                            <span class="pl-30 top-bold-label"><i class="fa fa-truck">&nbsp; </i>Rejected</span>
                                            </li>

                                            ';
                                            }else if($order['order_status']=='accepted'){
                                            echo 
                                            '
                                                <li class="col">
                                                    <span class="v-timeline-icon"></span>
                                                    <span class="pl-30 top-bold-label"><i class="fa fa-shopping-bag">&nbsp;</i>Accepted</span>
                                                </li>
                                                <li class="col">
                                                <i class="v-timeline-icon v-not "></i>
                                                <div class="timeline-text">
                                                    <div class="timeline-valutation">
                                                    <span class="pl-30 top-bold-label"><i class="fa fa-rupee">&nbsp;</i>Complete Payment </span>
                                                    </div>
                                                    
                                                </div>
                                                </li>
                                                
                                                <li id="v-last" class="col">
                                                <span class="v-timeline-icon v-last"></span>
                                                <span class="pl-30 top-bold-label"><i class="fa fa-truck">&nbsp; </i>Delivery Enroute</span>
                                                </li>

                                            ';

                                            }else if($order['order_status']=='delivered'){
                                                echo 
                                                '
                                                <li class="col">
                                                    <span class="v-timeline-icon"></span>
                                                    <span class="pl-30 top-bold-label"><i class="fa fa-shopping-bag">&nbsp;</i>Order Placed</span>
                                                </li>
                                                <li class="col">
                                                <i class="v-timeline-icon "></i>
                                                <div class="timeline-text">
                                                    <div class="timeline-valutation">
                                                    <span class="pl-30 top-bold-label"><i class="fa fa-ship">&nbsp;</i>Being Shipped </span>
                                                    </div>
                                                    
                                                </div>
                                                </li>
                                                
                                                <li id="v-last" class="col">
                                                <span class="v-timeline-icon v-end"></span>
                                                <span class="pl-30 top-bold-label"><i class="fa fa-truck">&nbsp; </i>Delivery Enroute</span>
                                                </li>
                                                ';

                                            }
                                            else if($order['order_status'] =='delivering')
                                            {
                                            echo 
                                            '
                                            <li class="col">
                                                <span class="v-timeline-icon"></span>
                                                <span class="pl-30 top-bold-label"><i class="fa fa-shopping-bag">&nbsp;</i>Order Placed</span>
                                                </li>
                                                <li class="col">
                                                <i class="v-timeline-icon "></i>
                                                <div class="timeline-text">
                                                    <div class="timeline-valutation">
                                                    <span class="pl-30 top-bold-label"><i class="fa fa-ship">&nbsp;</i>Being Shipped </span>
                                                    </div>
                                                    
                                                </div>
                                                </li>
                                                
                                                <li id="v-last" class="col">
                                                <span class="v-timeline-icon v-last"></span>
                                                <span class="pl-30 top-bold-label"><i class="fa fa-truck">&nbsp; </i>Delivery Enroute</span>
                                                </li>

                                            ';
                                            }
                                            else if($order['order_status'] =='confirming-payment')
                                            {
                                            echo 
                                            '
                                                <li class="col">
                                                    <span class="v-timeline-icon"></span>
                                                    <span class="pl-30 top-bold-label"><i class="fa fa-shopping-bag">&nbsp;</i>Order Placed</span>
                                                </li>
                                                <li class="col">
                                                <i class="v-timeline-icon v-not "></i>
                                                <div class="timeline-text">
                                                    <div class="timeline-valutation">
                                                    <span class="pl-30 top-bold-label"><i class="fa fa-rupee">&nbsp;</i>Confirming Payment </span>
                                                    </div>
                                                    
                                                </div>
                                                </li>
                                                
                                                <li id="v-last" class="col">
                                                <span class="v-timeline-icon v-last"></span>
                                                <span class="pl-30 top-bold-label"><i class="fa fa-truck">&nbsp; </i>Delivery Enroute</span>
                                                </li>

                                            ';
                                            }
                                            else{
                                                echo 
                                            '
                                                <li class="col">
                                                    <span class="v-timeline-icon"></span>
                                                    <span class="pl-30 top-bold-label"><i class="fa fa-shopping-bag">&nbsp;</i>Order Placed</span>
                                                </li>
                                                <li class="col">
                                                <i class="v-timeline-icon v-not"></i>
                                                <div class="timeline-text">
                                                    <div class="timeline-valutation">
                                                    <span class="pl-30 top-bold-label"><i class="fa fa-ship">&nbsp;</i>Being Shipped </span>
                                                    </div>
                                                    
                                                </div>
                                                </li>
                                                
                                                <li id="v-last" class="col">
                                                <span class="v-timeline-icon v-last"></span>
                                                <span class="pl-30 top-bold-label"><i class="fa fa-truck">&nbsp; </i>Delivery Enroute</span>
                                                </li>

                                            ';   
                                            }
                                        ?>


                                
                                </ul>
                            </div>
                         
                        </div>
                    </div>
                    <div style="border-color:#ffd79c94 !important;    border-radius: .85rem !important;" class="row rounded border d-flex justify-content-center mx-1 p-3">
                              
                              <?php 
                              if($order['order_status']=='confirming-payment'){
                                  $order['order_status_reason'] ='Please wait while we confirm the payment!';
                              }else if($order['order_status'] =='delivering'){
                                  $order['order_status_reason'] =
                              'Your order is being shipped, please be patient!';
                              }else if($order['order_status']=='delivered'){
                                  $order['order_status_reason'] =
                              '
                              
                              <p> Medium : '. $order['delivery_medium'].'</p>
                              <p> Tracking : '. $order['delivery_tracking_number'].'</p>
                              ';

                              }else if($order['order_status']=='rejected'){
                                  $order['order_status_reason']= $order['order_status_reason'];
                              } else if($order['order_status']=='accepted'){
                                $order['order_status_reason']= 'Please complete your payment.';
                            }
                              else{
                                  $order['order_status_reason']='Your order has successfully been placed!';
                              }

                              ?>
                                  <h5 style="color:#ff9700" class="font-weight-light ">
                                 
                                 <?php echo $order['order_status_reason']; ?>
                                  </h5>
                             
                             
                          </div>
                    </div>
                    <div id="tracking-sec" class="col-12 hide-mob px-md-3 ">
                        <div class="card">
                            <div class="row d-flex justify-content-between px-3 top">
                                <div class="d-flex">
                                    <h5>ORDER <span style="color:#ff9700" class=" font-weight-bold">#BFORDER<?php echo $order['order_id'] ?></span></h5>
                                </div>
                                <div class="d-flex flex-column text-sm-right">
                                    <p class="mb-0"><?php echo $order['product_name'] ?> </p>
                                    <p>INR <?php echo $order['amount']?></p>
                                </div>
                            </div> <!-- Add class 'active' to progress -->
                            <div class="row d-flex justify-content-center">
                                <div class="col-12">
                                    <ul id="progressbar" class="text-center">
                                    <?php 
                                        if($order['order_status']=='rejected'){
                                           echo 
                                           '
                                            <li class=" active step0"></li>
                                            <li class=" step0"></li>
                                            <li class="step0"></li>

                                           ';
                                        }else if($order['order_status']=='accepted'){
                                           echo 
                                           '
                                            <li class=" active step0"></li>
                                            <li class=" step0"></li>
                                            <li class="step0"></li>

                                           ';

                                        }else if($order['order_status']=='delivered'){
                                              echo 
                                              '
                                            <li class=" active step0"></li>
                                            <li class=" active  step0"></li>
                                            <li class=" active step0"></li>

                                              ';

                                        }
                                        else if($order['order_status'] =='delivering')
                                        {
                                           echo 
                                           '
                                            <li class=" active step0"></li>
                                            <li class=" active step0"></li>
                                            <li class="step0"></li>

                                           ';
                                        }
                                        else if($order['order_status'] =='confirming-payment')
                                        {
                                           echo 
                                           '
                                            <li class=" active step0"></li>
                                            <li class=" step0"></li>
                                            <li class="step0"></li>

                                           ';
                                        }
                                        else{
                                            echo 
                                           '
                                            <li class=" active step0"></li>
                                            <li class=" step0"></li>
                                            <li class="step0"></li>

                                           ';   
                                        }
                                    ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="row justify-content-between top">
                                <div class="row d-flex icon-content"> <img class="icon" src="https://i.imgur.com/u1AzR7w.png">
                                    <div class="d-flex flex-column">
                                        <p class="font-weight-bold">Order<br>Placed</p>
                                    </div>
                                </div>
                                <div class="row d-flex icon-content"> <img class="icon" src="http://cdn.onlinewebfonts.com/svg/img_538295.png">
                                    <div class="d-flex flex-column">
                                        <p class="font-weight-bold">Order<br>Shippment</p>
                                    </div>
                                </div>
                                
                                <div class="row d-flex icon-content"> <img class="icon" src="https://i.imgur.com/TkPm63y.png">
                                    <div class="d-flex flex-column">
                                        <p class="font-weight-bold">Order<br>En Route</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row d-flex justify-content-center px-3 pt-4 top">
                              
                                <?php 
                                if($order['order_status']=='confirming-payment'){
                                    $order['order_status_reason'] ='Please wait while we confirm the payment!';
                                }else if($order['order_status'] =='delivering'){
                                    $order['order_status_reason'] =
                                'Your order is being shipped, please be patient!';
                                }else if($order['order_status']=='delivered'){
                                    $order['order_status_reason'] =
                                '
                                
                                <p> Medium : '. $order['delivery_medium'].'</p>
                                <p> Tracking : '. $order['delivery_tracking_number'].'</p>
                                ';

                                }else if($order['order_status']=='rejected'){
                                    $order['order_status_reason']= $order['order_status_reason'];
                                }
                                else{
                                    $order['order_status_reason']='Your order has successfully been placed!';
                                }

                                ?>
                                    <h5>
                                    <?php echo $order['order_status_reason']; ?>
                                    </h5>
                               
                               
                            </div>
                        </div>
                       
                    </div>
            
            <!-- BILLING DETAILS -->
            <div class=" option_panel col-12 px-md-3  mb-2 ">
                <div class="card badge-theme">
                     <div  id="toggler-billing" data-state ="hide" class="d-flex justify-content-between card-body align-items-center">
                        <h5 class="text-uppercase font-weight-light ">Billing Details</h5>
                        <span  ><i class="fa fa-caret-down"></i></span>
                    </div>
                    </div>
                    <div id="billing-board" style="display:none;"  class="card mt-2  badge-theme">
                    <ul  class="card-body  list-group-flush ">
                    <li class="list-group-item text-uppercase d-flex justify-content-between"><span>Name :</span> &nbsp;  &nbsp;<?php echo $order['full_name'] ?></li>
                    <li class="list-group-item text-uppercase d-flex justify-content-between"><span>Phone Number :</span>&nbsp;  &nbsp;<?php echo $order['phone'] ?></li>
                    <li class="list-group-item text-uppercase d-flex justify-content-between"><span>Product price :&nbsp; </span> <span>  <span id="product-price"> Rs <?php echo $order['product_discount_price'] ?></span>/= </span></span></li>
                    <li class="list-group-item text-uppercase d-flex justify-content-between"><span>Discount :&nbsp;</span> Rs <?php echo $order['product_price']- $order['product_discount_price'] ?>/= </li>
                    <li class="list-group-item text-uppercase d-flex justify-content-between"><span>Delivery Charges :&nbsp;</span><span> Rs <span id="delivery-charges">50</span>/=</span></li>
                    <li class="list-group-item text-uppercase d-flex justify-content-between">
                    <span>Final Price :</span> 
                    <span>
                        &nbsp; Rs <span class="final-price"><?php echo $order['amount']?> </span>/=
                    </span></li>
                </ul>
                </div>
            </div>
            <!-- PRODUCT DETAILS -->
            <div class=" option_panel col-12 px-md-3 mb-2">
                <div class="card badge-theme">
                    <div id="toggler-product" data-state ="hide" class="d-flex justify-content-between card-body align-items-center">
                        <h5 class="text-uppercase font-weight-light ">Product Details</h5>
                        <span id="toggler-product" data-state ="hide"><i class="fa fa-caret-down"></i></span>
                    </div>
                </div>

                <div style="display:none;"id="product-board" class="card mt-2  badge-theme">
                <div class="p-3 pt-4">
                    <?php
                    $images = explode(",",$order['file_name']);
                    foreach ($images as $image){
                        $imageURL = '/admin/uploads/'.$image;?>
                        <img class="product-img rounded" src="<?php echo $imageURL; ?>" alt="" />
                    <?php }?>
                </div>
                <ul  class="  card-body list-group-flush">
                <li class="list-group-item d-flex justify-content-between"><strong>Name :</strong> &nbsp;  &nbsp;<?php echo $order['product_name'] ?></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Description</strong>&nbsp;  &nbsp;<span class="text-justify"><?php echo $order['product_desc'] ?></span></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Quality :</strong> &nbsp; <?php echo $order['product_quality'] ?></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Product Price :</strong>&nbsp; Rs &nbsp; <?php echo $order['product_discount_price'] ?>/=</li>
                
               
                </ul>
                </div>
            </div>
            <!-- DELIVERY DETAILS -->
            <div class=" option_panel col-12 px-md-3 mb-2">
                <div class="card badge-theme">
                <div  id="toggler-delivery" data-state ="hide" class="d-flex justify-content-between card-body align-items-baseline">
                <h5 class="text-uppercase font-weight-light ">Delivery Details</h5>
                    <span class=""><i class="fa fa-caret-down"></i></span>
                </div>
                </div>
                <div style="display:none;"id="delivery-board" id="billing-board" class="card mt-2  badge-theme">
                <ul class="card-body list-group-flush">
                <li class="list-group-item d-flex justify-content-between"><strong>Name :</strong> &nbsp;  &nbsp;<?php echo $order['full_name'] ?></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Email :</strong>&nbsp;  &nbsp;<?php echo $order['email_address'] ?></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Phone :</strong> &nbsp; <?php echo $order['phone'] ?></li>
                <li class="list-group-item d-flex justify-content-between"><strong>Address :</strong>&nbsp;  &nbsp; <?php echo $order['init_address'] ?>, <?php echo $order['landmark'].', '.$order['town'].', '.$order['state'].' - '.$order['pincode'] ?></li>
                </ul>
                </div>
            </div>
        </div>

    </div>
    <div class=" my-4 text-muted text-center">
                    You can anytime <a href="/contact.php">contact</a> us for any kind of assisitance, your order id #BFORDER<span><?php echo $order['order_id'];?></span>
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

