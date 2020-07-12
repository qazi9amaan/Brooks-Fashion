<?php 

include '../includes/header.php' ;
require_once  '../admin/config/config.php';

if(isset($_SESSION['completed-payment_order_id'])){
    echo ' <script> window.location.href="helper/already-ordered.php" </script>';
}

$product_id = $_GET['id'];

$db_products = getDbInstance();
$db_products->where('id', $product_id);
$product = $db_products->getOne('products');

$images = explode(",",$product['file_name']);
$first_img = $images[0];
$first_imgURL = '/admin/uploads/'.$first_img;

$db = getDbInstance();

$user_id = $_SESSION['public_user_id'];
$db->where('user', $user_id);
$account = $db->getOne('user_profiles');

if($account == null)
{
    header('location: /users/account-setup.php?reg_id='.$_SESSION['public_user_id'].'&operation=create&q=users/checkout.php?id='.$product_id);
    exit;
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
</style>
<div class="breadcrumb">
        <div class="container">
            <a class="breadcrumb-item" href="/shop.php">Shop</a>
           
            <a href ="/product-single.php?id=<?php echo $product['id'] ?>" class="breadcrumb-item "><?php echo $product['product_name'] ?></a>
            <span class="breadcrumb-item ">Buy Now</span>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content ">
        <div class="modal-header">
            <p class="modal-title lead" id="exampleModalLabel">Confimination</p>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="complete-order" action="buy-product.php" method="POST">
        <div class="modal-body">
            Dear customer, are you sure you want to proceed with the order?
        <input type="text" hidden name="amount" id="upload_f_price" >
        <input type="text" hidden name="product_id" value="<?php echo  $product_id ;?>"  >
        <input type="text" hidden name="owner" value="<?php echo  $product['product_owner']  ;?>"  >
        <input type="text" hidden name="user_id" value="<?php echo  $user_id ;?>"  >
        </div>
        <div class="modal-footer border-top-0 py-0">
            <button id="proceed-btn" class="btn rounded">Proceed </button>
        </div>
        </form>

        </div>
    </div>
    </div>


    <section class="static about-sec mb-0">
        <div class="container">
              <div class="row">
                <div class="col-md-12 col-lg-5  my-md-auto pt-md-5 px-md-4 pl-md-5  ">
                    <div class="row ">
                      <div class="col-5 col-md-3">
                          <img src="<?php echo  $first_imgURL;  ?>" class=" img-fluid">
                      </div>
                      <div class="col-7 ml-0">
                      <h1 class="mb-1"><?php echo $product['product_name'] ?></h1>
                     
                        <strong>
                        <p class="mb-0">Quality : <?php echo $product['product_quality'] ?></p>
                        <p class="mb-0">INR <strong><?php echo $product['product_discount_price'] ?></strong>/=</p>
                      </strong> 
                      </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-7  pr-lg-4 text-left">
                    <div class="card badge-theme mr-lg-1">
                    <h3 class="ml-3 mt-4">Buyer Details</h3>
                    <ul class="list-group  list-group-flush">
                        <div class="p-3 border-bottom border-top font-weight-light border-white"><span>Name :</span> &nbsp;  &nbsp;<?php echo $account['full_name'] ?></div>
                        <div class="p-3 border-bottom font-weight-light border-white"><span>Email Address :</span>&nbsp;  &nbsp;<?php echo $account['email_address'] ?></div>
                        <div class="p-3 border-bottom font-weight-light border-white"><span>Phone Number :</span>&nbsp;  &nbsp;<?php echo $account['phone'] ?></div>
                        <div class="p-3 border-bottom font-weight-light border-white">
                        <span>Address :</span>
                        &nbsp;  &nbsp;
                        <?php echo $account['init_address'] .', '.$account['final_address'].', '.$account['town'].' '.$account['landmark'].', '.$account['state'].'-'.$account['pincode'] ?></div>
                    </ul>
                    </div>
                </div>
              </div>
              <div class="row  px-md-4 ">
                <div class="col-12 px-0 pt-2">
                    <div class="card badge-theme mx-2 mb-2">
                        <div class="d-flex pb-2 justify-content-between align-items-baseline">
                        <h3 class=" ml-4 mt-4  ">Billing Details</h3>
                        <span id="toggler-billing" data-state ="hide" class="mr-3"><i class="fa fa-caret-down"></i></span>
                        </div>
                    </div>

                    <div  id="billing-board" style="display:none;"  class="card badge-theme mx-2">
                        <ul class="list-group pt-0 list-group-flush">
                            <div class="p-3 border-bottom border-top font-weight-light border-white"><strong>Date :</strong> &nbsp;  &nbsp;<?php echo date('Y-m-d ') ?></div>
                            <div class="p-3 border-bottom font-weight-light border-white"><strong>Name :</strong> &nbsp;  &nbsp;<?php echo $account['full_name'] ?></div>
                            <div class="p-3 border-bottom font-weight-light border-white"><strong>Phone Number :</strong>&nbsp;  &nbsp;<?php echo $account['phone'] ?></div>
                            <div class="p-3 border-bottom font-weight-light border-white"><strong>Product :</strong> &nbsp;  &nbsp;<?php echo $product['product_name'] ?></div>
                            <div class="p-3 border-bottom font-weight-light border-white"><strong>Product price :&nbsp; </strong> <span><strike>Rs <?php echo $product['product_price'] ?>/=</strike> &nbsp;<strong> Rs <span id="product-price"> <?php echo $product['product_discount_price'] ?></span>/= </strong></span></div>
                            <div class="p-3 border-bottom font-weight-light border-white"><strong>Discount :&nbsp;</strong> Rs <?php echo $product['product_price']- $product['product_discount_price'] ?>/= </div>
                            <div class="p-3 border-bottom font-weight-light border-white"><strong>Delivery Charges :&nbsp;</strong><span> Rs <span id="delivery-charges">50</span>/=</span></div>
                            <div class="p-3 border-bottom font-weight-light border-white">
                                <strong>Final Price :</strong> 
                                <strong>
                                    &nbsp; Rs <span class="final-price"> </span>/=
                                </strong>
                        </div>
                        </ul>
                    </div>
                </div>
                <div class="col-12 px-0 mt-4">
                  <div class="card badge-theme mx-2">
                  <h3 class=" ml-4 mt-4">Payment Details</h3>
                    <ul class="list-group list-group-flush">
                    <div class="p-3 border-bottom border-top font-weight-light border-white "><strong>Product price :&nbsp; </strong> Rs <span id="product-price"> <?php echo $product['product_discount_price'] ?></span>/= </strong></span></div>
                    <div class="p-3 border-bottom border-top font-weight-light border-white "><strong>Delivery Charges :&nbsp;</strong><span> Rs <span id="delivery-charges">50</span>/=</span></div>

                    <div class="p-3 border-bottom border-top font-weight-light border-white ">
                    <strong>Final Cost :</strong> 
                        Rs <span class="final-price"> </span>/=
                   </div>
                
                    </ul>
            
                  </div>
                  <div class="text-right mt-4 mb-5 mr-4">

                  <a href="/product-single.php?id=<?php echo $product['id'] ?>" class="btn black">Cancel </a>
                    <button data-toggle="modal" data-target="#exampleModal" class="btn" value="" >Proceed</button>
                    </div>
                </div>
              </div>
  
        </div>
    </section>






    <?php include 'includes/footer.php' ?>


    <script>
    $('.final-price').html(
        parseInt($('#product-price').html()) + parseInt($('#delivery-charges').html())
    )
    $('#upload_f_price').attr("value", parseInt($('#product-price').html()) + parseInt($('#delivery-charges').html()))

    $('#toggler-billing').click(function() {
        if($('#toggler-billing').attr('data-state')==="hide")
        {
            $('#billing-board').show();
            $('#billing-line').hide();
            $('#toggler-billing').attr('data-state','show')

        }else{
            $('#billing-board').hide();
            $('#billing-line').show();
            $('#toggler-billing').attr('data-state','hide')


        }
    })
   $('#proceed-btn').click(function(){
       $(this).prop('disabled',true);
       $(this).html('Please wait...')
        $('#complete-order').submit();
   })
    </script>
</body>

</html>