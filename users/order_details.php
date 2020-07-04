<?php
$key = 'rzp_live_twsRWGaSxkUdjI';
session_start();
require_once '/var/www/html/admin/config/config.php';


$order_id = filter_input(INPUT_GET, 'order_id', FILTER_VALIDATE_INT);
$db = getDbInstance();
$db->where('orders.order_id', $order_id);
$db->join("products p", "orders.product_id=p.id", "INNER");
$db->join("user_profiles u", "u.user=orders.user_id", "INNER");
$order = $db->getOne("orders");


?>
<div class="loader">
<img src="/images/loader.gif" alt="">
</div>
<?php include 'includes/header.php' ?>
<style>
.loader{
    display:none;
    position:fixed;
    width:100%;
    height:100%;
    justify-content:center;
    text-align:center;
    z-index:9999999;
    background:rgba(0,0,0,.2)
}
.loader img{
    position:absolute;
    left:47%;
    top:40%;
    width:120px;
    height:120px;
    
}
</style>

<div class="modal fade" id="payment-confirmination" tabindex="-1" role="dialog" aria-labelledby="payment-confirmination" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Complete Payment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="p-3 pb-0 mb-0">Dear user, we are happy to see you here. 
        We have worked on our services to make this a easeless experience for you. 
        We are ready to deliver this order to this address, please complete the payment process to 
        move ahead.
         </p>
        <form class="p-3 pt-0 mt-0" action="">
             <div class="form-group pt-0 mt-0">
                <label for="name">Name</label>
                <input type="text" id="name" disabled class="form-control" value="<?php echo $order['full_name'] ?>">
            </div>
            <div class="form-group">
            <label for="email">Email</label>
            <input type="text" id="email" disabled class="form-control" value="<?php echo $order['email_address'] ?>">
            </div>
            <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" id="phone" disabled class="form-control" value="<?php echo $order['phone'] ?>">
            </div>
            <div class="form-group">
            <label for="address">Address</label>
            <textarea type="text" id="address" disabled class="form-control"><?php echo $order['init_address'] ?>, <?php echo $order['landmark'].', '.$order['town'].', '.$order['state'].' - '.$order['pincode'] ?></textarea>
            </div>
        </form>
        <hr>
        <p class="px-3 pt-0 mt-0 text-justified">
            <b>Disclaimer : </b> Dear user, please go ahead to complete the payment process choose your preffered payment option. Check your delivery address before comfirming the payment. 
        </p>
        <?php if($order['allow_cod'] != 'on'){?>
        <p class="px-3 text-dark pt-0 mt-0 text-justified"> 
            <b>Sorry! COD is not available on this product..</b>
        </p>
        <?php }?>

      </div>
      <div class="modal-footer">
        
        <button type="button" class="razorpay-payment-button" data-dismiss="modal">Close</button>
        <?php if($order['allow_cod'] === 'on'){?>
        <button id="cod_button" class="razorpay-payment-button border-0 bg-primary">C.O.D</button>
        <?php }?>
        <button id="rzp-button1" class="razorpay-payment-button border-0 bg-primary">Pay Now</button>
      </div>
    </div>
  </div>
</div>


<div class="col mt-md-2">
    <div class="container-fluid m-0 p-0">
        <div class="row p-0">
            <div class="col-md-12 p-0 bg-light">
                <div class="breadcrumb mb-0">
                <a class="breadcrumb-item text-capitalize" href="index.php"><?php echo $user_full_name; ?></a>
                    <a class="breadcrumb-item" href="index.php">Orders</a>
                    <span class="breadcrumb-item active"><?php echo $order['product_name']; ?></span>
                </div>
            </div>
            <?php if($order['order_status']=='accepted'){?>
                   
            <div class="col-12 px-md-3 mt-5  ">
                <div class="card alert-danger">
                    <div class="card-body text-alert">
                    <h4 class="alert-heading pb-2">Hola your order is availble!</h4>
                    <p class="text-justify">We are happy to see you here, please complete the futher steps to get your order delivered. Please make sure that the delivery address and product is correct.</p>
                    <hr>
                    <button  data-toggle="modal" data-target="#payment-confirmination" class="razorpay-payment-button">Complete your payment</button>
                    
                     </div>
                </div>
            </div>
            <?php }?>
            <div   class=" mt-5 option_panel col-12 px-3 px-md-3  mb-4 ">
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

                            }
                            else if($order['order_status'] =='delivering')
                            {
                                $icon = 'fa fa-check-circle';
                                $color='#28a745';
                                $msg='Payment confirmed';
                            }
                            else{
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
                        }
                    
                    if($order['order_status'] =='delivering')
                        {
                            $color='#28a745';
                            $order['order_status_reason'] =
                            '
                            <p> Your order is being shipped, please be patient! </p>';
                        }else if($order['order_status']=='delivered'){
                            $color='#28a745';
                            $order['order_status_reason'] =
                            '
                            <p> Your order has been shipped! </p>
                            <p> Medium : '. $order['delivery_medium'].'</p>
                            <p> Reference : '. $order['delivery_tracking_number'].'</p>
                            ';

                        
                    }else if($order['order_status']=='rejected'){
                     $order['order_status_reason']= $order['order_status_reason'];
                    }
                    else{
                            $color='#28a745';
                            $order['order_status_reason']='Your order has successfully been placed!';
                        }
                    
                    ?>
                    <h3 style="color:<?php echo $color; ?>" >
                    <?php echo $order['order_status_reason']; ?>
                    
                    </h3>
                    </div>
                </div>
                <div class="card-footer text-center">
                    You can anytime get back to us for any kind of assisitance, your order id <strong> OR-<span><?php echo $order['order_id'];?></span> </strong>
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




<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>

function update_the_payment(string){
    $('.loader').css('display','block');
    jQuery.ajax({
        url:"/admin/functions/functions.php",
        type:"POST",
        data: {
            changepaymenttoonline:true,
            order_id : <?php echo $order['order_id'];?>,
            payment_id : string,

            },
        success:function(data){  
            $('.loader').css('display','none');
            window.location="/users/index.php";

            }  
    });
}


var options = {
    "key": "<?php echo $key; ?>", 
    "amount": "<?php echo $order['amount'].'00'; ?>", 
    "currency": "INR",
    "name": "<?php echo $order['product_name'] ?>",
    "description": "You're are subjected to pay an amount of",
    "image": "/images/logo.jpeg",
    "handler": function (response){
       update_the_payment(response.razorpay_payment_id);
    },
    "error": {
        "field": "email",
        "description": "incorrect email address"
    },
    "prefill": {
        "name": "<?php echo $order['full_name']; ?>",
        "email": "<?php echo $order['email_address']; ?>",
        "contact": "<?php echo $order['phone']; ?>"
    },
    "theme": {
        "color": "#F37254"
    }
};
var rzp1 = new Razorpay(options);
document.getElementById('rzp-button1').onclick = function(e){
    rzp1.open();
    e.preventDefault();
}


$('#cod_button').click(function(){
    $('.loader').css('display','block');
    jQuery.ajax({
        url:"/admin/functions/functions.php",
        type:"POST",
        data: {
            changepaymenttocod:true,
            order_id : <?php echo $order['order_id'];?>,
            
            },
        success:function(data){  
            $('#checkstatus').html(data);
            $('.loader').css('display','none');
            window.location="/users/index.php";

            }  
    });
})
</script>

</body>

</html>

