<?php 
session_start();
require_once '/var/www/html/admin/config/config.php';
include '/var/www/html/includes/header.php' ;
$order_id = filter_input(INPUT_GET, 'order_id', FILTER_VALIDATE_INT);


$db = getDbInstance();
$db->where('orders.order_id', $order_id);
$db->join("products p", "orders.product_id=p.id", "INNER");
$db->join("user_profiles u", "u.user=orders.user_id", "INNER");
$order = $db->getOne("orders");

if($order['order_status']!='accepted'){
    echo ' <script> window.location.href="order-success.php" </script>';
}

$db = getDbInstance();
$pincode=$db->where('user',$_GET['user'])->getValue('user_profiles','pincode');
function getCodFor($pincode,$arr){
    if (in_array($pincode, $arr)) {
        return true;
    }else{
            return false;
        }
}


?>
<style>
#toggler-billing i{
    font-size:25px;
    cursor:pointer;
}

.badge-theme{   border: 0px !important;
    background: #ffd79c33 !important;
    color: #ff9700 !important;
    border-radius: .85rem !important;
}
.btn-sm{
    padding: 6px 30px 6px; !important;
}
.final{
    display:none;
}
</style>


    <section class="static about-sec mb-0 mt-md-5 pt-md-3">

        <div class="modal fade" id="complete-payment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
            <div class="modal-header">
                <p class="mb-0">Complete Payment Online</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to proceed this step?
                <div class="d-flex align-items-baseline">
                    <i class="fa fa-arrow-circle-right"></i>
                    <span class="pl-2">
                        Paying Online
                    </span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm black" data-dismiss="modal">Close</button>
                <button type="button" id="online-button" class="btn btn-sm ">Proceed</button>
            </div>
            </div>
        </div>
        </div>
        <div class="container">
              <div id="" class="row basic px-md-4 ">
                <div class="col-12 px-0 mt-4">
                  <div class="card badge-theme mx-2">
                  <h3 class=" ml-4 mt-4">Payment Details</h3>
                  <div class="card-body pt-0">
                <p class="text-justify">Dear user, <br>Please complete your payment process for your order. We are eager to serve you.
                For the sake of your trust we provide COD for maximum products and a trustfull easeless and secure payment solution.</p>
                
                <strong class=" text-underline ">Cash On Delivery (COD):</strong>
                <p>Dear user, you're asked to pay the whole amount at the time of the delivery!</p>
                <strong class=" text-underline ">Pay Online:</strong>
                <p class="text-justify">Dear user, you'll be redirected to a whatsapp group where one of our executive will help you to complete the steps.!</p>
                </div>
            
                  </div>
                </div>
                <div class="col-12 mt-1 px-1">
                <div class="card badge-theme ">
                <div class="card-body ">
                <?php if(!getCodFor($pincode,$allowed_pincodes)){?>
                    <p class="pb-0 mb-0 font-weight-bold">Sorry! COD is not available on this product..</p>
                <?php }?>
                <span class="">Dear user, you're requested to pay an amount of Rs <?php echo $order['amount']?>/= </span>

                </div>
                </div>
                <div class="card-body">
                    <div class="text-right">
                    <?php if(getCodFor($pincode,$allowed_pincodes)){?>
                        <a id="cod_button" href="#" class="btn btn-sm my-2"> Cash On Delivery</a>
                        <?php }?>
                    <button   type="button"  data-toggle="modal" data-target="#complete-payment"  class="btn btn-sm black "> Pay Now</button>
                    </div>
                </div>
              </div>
  
        </div>

        <div id="" class="final row px-md-4">
        <div class="col-12 px-0 mt-4">
        <div class="card mb-3 badge-theme mx-2">
                <div class="card-body">
                <span class="pl-2">
                    Complete the payment :
                    <ul class="pl-2">
                        <li>Click on button to connect our whatsapp payment executive.</li>
                        <li>Send the predefined message.</li>
                        <li>Proceed.</li>
                    </ul>
                </span>
                </div>
            </div>
            <div class="card mb-3 badge-theme mx-2">
            </div>
            <?php 
                $data = 'I want to complete the payment of my order'.' break_line*'.
                'Order:'.$order_id.'* break_line*'.
                $order['full_name'] .'* break_line '.
                $order['email_address'] .'break_line'.
                $order['init_address'].' ,'. $order['landmark'].', '.$order['town'].', '.$order['state'].' - '.$order['pincode'] .'break_line'.
                $order['phone'].'break_line https://brooksfashion.ml/product-single.php?id='.$order['product_id'];
                $customerdetails = str_replace('break_line','%0A',urlencode($data));?>
                <div id="pay-using-whatsapp" class="text-center mx-2">
                    <a href="https://api.whatsapp.com/send?phone=+917006276749&text=<?php echo $customerdetails;?>"class="btn wht-btn btn-sm final btn-block rounded ">Make Payment</a>
                    <a href="https://api.whatsapp.com/send?phone=+917889776055&text=aaaaaaaaaaaaaaa" class="btn final btn-sm  black btn-block rounded "> Alternate Number </a>
                </div>
            
                  </div>
        </div>
        
        </div>
    </section>





    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/owl.carousel.min.js"></script>
    <script src="/js/custom.js"></script>

<script>

$(document).ready(function() {
$("#loading-bar").delay(1000).fadeOut("slow");
})

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
            window.location="order-success.php";

            }  
    });
})

$('#online-button').click(function(){
    $('.loader').css('display','block');
    jQuery.ajax({
        url:"/admin/functions/functions.php",
        type:"POST",
        data: {
            changepaymenttoonline:true,
            order_id : <?php echo $order['order_id'];?>,
            
            },
        success:function(data){  
            $('#complete-payment').modal('hide');
            $('.loader').css('display','none');
            if(data=='success'){
                $('.basic').css('display','none');
                $('.final').css('display','block');
            }
      
        }  

    });
})


</script>

</body>

</html>

