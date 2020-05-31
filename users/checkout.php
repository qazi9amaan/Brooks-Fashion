<?php
session_start();

require_once  '../admin/config/config.php';
$product_id = $_GET['id'];
$db_products = getDbInstance();
$db_products->where('id', $product_id);
$product = $db_products->getOne('products');

$images = explode(",",$product['file_name']);
$first_img = $images[0];
$first_imgURL = '/admin/uploads/'.$first_img;

$db = getDbInstance();
// $user_id = $_SESSION['public_user_id'];

$user_id = $_SESSION['public_user_id'];
$db->where('user', $user_id);
$account = $db->getOne('user_profiles');

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$data_to_db = filter_input_array(INPUT_POST);
	
    $data_to_db['product_id'] = $product_id;
    $data_to_db['owner'] =$product['product_owner'] ;
    $data_to_db['user_id'] = $user_id;
    $data_to_db['payment_type'] = 'cod';
    $data_to_db['ordered_at'] = date('Y-m-d H:i:s');
	$db = getDbInstance();
	$last_id = $db->insert('orders', $data_to_db);
	if ($last_id)
	{
		$_SESSION['success'] = 'Your  order is successfully submitted!';
		header('location: index.php');
		exit;
	}
}


?>
<?php include '../includes/header.php' ?>
<style>
#toggler-billing i{
    font-size:25px;
    cursor:pointer;
}
</style>
<div class="breadcrumb">
        <div class="container">
            <a class="breadcrumb-item" href="/shop.php">Shop</a>
            <a href ="/getallproducts.php?cat=<?php echo $product['product_category'] ?>" class="breadcrumb-item "><?php echo $product['product_category'] ?></a>
            <a href ="/product-single.php?id=<?php echo $product['id'] ?>" class="breadcrumb-item "><?php echo $product['product_name'] ?></a>
            <span class="breadcrumb-item ">Buy Now</span>
        </div>
    </div>

    <section class="static about-sec mb-0">
        <div class="container-fluid">
              <div class="row">
                <div class="col-md-12 col-lg-5  my-md-auto pt-md-5 px-md-4 pl-md-5 border-right ">
                    <div class="row ">
                    
                      <div class="col-5 col-md-3">
                          <img src="<?php echo  $first_imgURL;  ?>" class=" img-fluid">
                      </div>
                      <div class="col-7 ml-0">
                      <h1 class="mb-1"><?php echo $product['product_name'] ?></h1>
                      <p class="mb-0 text-justify"><?php echo substr($product['product_desc'],0,50) ?> ...</p>
                        <strong>
                        <p class="mb-0">Quality : <?php echo $product['product_quality'] ?></p>
                        <p class="mb-0">Rs <strong><?php echo $product['product_discount_price'] ?></strong>/=</p>
                      </strong> 
                      </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-7 ml-0 pl-0 text-left">
                <h3 class="ml-3 mt-4">Buyer Details</h3>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Name :</strong> &nbsp;  &nbsp;<?php echo $account['full_name'] ?></li>
                    <li class="list-group-item"><strong>Email Address :</strong>&nbsp;  &nbsp;<?php echo $account['email_address'] ?></li>
                    <li class="list-group-item"><strong>Phone Number :</strong>&nbsp;  &nbsp;<?php echo $account['phone'] ?></li>
                    <li class="list-group-item">
                    <strong>Address :</strong>
                    &nbsp;  &nbsp;
                    <?php echo $account['init_address'] .', '.$account['final_address'].', '.$account['town'].' '.$account['landmark'].', '.$account['state'].'-'.$account['pincode'] ?></li>
                  </ul>
                </div>
              </div>
              <div class="row  px-md-4 ">
                <div class="col-12 px-0 ">
                    <div class="d-flex justify-content-between align-items-baseline">
                    <h3 class=" ml-4 mt-4  ">Billing Details</h3>
                    <span id="toggler-billing" data-state ="hide" class="mr-3"><i class="fa fa-caret-down"></i></span>
                    </div>
                    <hr id="billing-line">

                    <ul id="billing-board" style="display:none;" class="list-group pt-0 list-group-flush">
                    <li class="list-group-item d-flex justify-content-between"><strong>Date :</strong> &nbsp;  &nbsp;<?php echo date('Y-m-d ') ?></li>
                    <li class="list-group-item d-flex justify-content-between"><strong>Name :</strong> &nbsp;  &nbsp;<?php echo $account['full_name'] ?></li>
                    <li class="list-group-item d-flex justify-content-between"><strong>Phone Number :</strong>&nbsp;  &nbsp;<?php echo $account['phone'] ?></li>
                    <li class="list-group-item d-flex justify-content-between"><strong>Product :</strong> &nbsp;  &nbsp;<?php echo $product['product_name'] ?></li>
                    <li class="list-group-item d-flex justify-content-between"><strong>Product price :&nbsp; </strong> <span><strike>Rs <?php echo $product['product_price'] ?>/=</strike> &nbsp;<strong> Rs <span id="product-price"> <?php echo $product['product_discount_price'] ?></span>/= </strong></span></li>
                    <li class="list-group-item d-flex justify-content-between"><strong>Discount :&nbsp;</strong> Rs <?php echo $product['product_price']- $product['product_discount_price'] ?>/= </li>
                    <li class="list-group-item d-flex justify-content-between"><strong>Delivery Charges :&nbsp;</strong><span> Rs <span id="delivery-charges">50</span>/=</span></li>
                    <li class="list-group-item d-flex justify-content-between">
                    <strong>Final Price :</strong> 
                   <strong>
                  &nbsp; Rs <span class="final-price"> </span>/=
                   </strong></li>

                    </ul>
                </div>
                <div class="col-12 px-0 mt-4">
                    <h3 class=" ml-4 mt-4">Payment Details</h3>
                    <ul class="list-group list-group-flush">
                    <li class="list-group-item "><strong>Product price :&nbsp; </strong> Rs <span id="product-price"> <?php echo $product['product_discount_price'] ?></span>/= </strong></span></li>
                    <li class="list-group-item "><strong>Delivery Charges :&nbsp;</strong><span> Rs <span id="delivery-charges">50</span>/=</span></li>

                    <li class="list-group-item ">
                    <strong>Final Cost :</strong> 
                   Rs <span class="final-price"> </span>/=
                   </li>
                
                    </ul>
                    <div class="text-right mt-4 mr-4">
                    <form action="#" method="POST">

                    <a href="/product-single.php?id=<?php echo $product['id'] ?>" class="btn black">Cancel </a>
                    <input type="text" hidden name="amount" id="upload_f_price" >
                    <button type="submit" class="btn ">Proceed</button>
                    </form>
                    </div>
                </div>
              </div>
  
        </div>
    </section>







    <footer class="mt-3">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="address">
                        <h4>Our Address</h4>
                        <h6>The BookStore, PES University </h6>
                        <h6>Call : 000 000 000</h6>
                        <h6>Email : info@bookstore.com</h6>
                    </div>

                </div>
                <div class="col-md-3">
                    <div class="navigation">
                        <h4>Navigation</h4>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><a href="about.html">About Us</a></li>
                            <li><a href="privacy-policy.html">Privacy Policy</a></li>
                            <li><a href="terms-conditions.html">Terms</a></li>
                            <li><a href="products.html">Products</a></li>
                        </ul>
                    </div>
                    <div class="navigation">
                        <h4>Help</h4>
                        <ul>
                            <li><a href="">Shipping & Returns</a></li>
                            <li><a href="privacy-policy.html">Privacy</a></li>
                            <li><a href="faq.html">FAQ’s</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form">
                        <h3>Quick Contact us</h3>
                        <h6>We are now offering some good discount on selected books go and shop them</h6>
                        
                            <div class="row">
                                <div class="col-md-6">
                                    <input placeholder="Name" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="email" placeholder="Email" required>
                                </div>
                                <div class="col-md-12">
                                    <textarea placeholder="Messege"></textarea>
                                </div>
                                <div class="col-md-12">
                                    <button class="btn black">Alright, Submit</button>
                                </div>
                            </div>
                        </>
                    </div>
                </div>
            </div>
        </div>
        <div class="copy-right">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h5>(C) 2019. All Rights Reserved. BookStore W</h5>
                    </div>
                    <div class="col-md-6">
                        <div class="share align-middle">
                            <span class="fb"><i class="fa fa-facebook-official"></i></span>
                            <span class="instagram"><i class="fa fa-instagram"></i></span>
                            <span class="twitter"><i class="fa fa-twitter"></i></span>
                            <span class="pinterest"><i class="fa fa-pinterest"></i></span>
                            <span class="google"><i class="fa fa-google-plus"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/owl.carousel.min.js"></script>
    <script src="/js/custom.js"></script>

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
   
    </script>
</body>

</html>