<?php
require_once  'admin/config/config.php';

// Costumers class
require_once  'admin/lib/Products/Products.php';
$product_id = $_GET['id'];

$db = getDbInstance();

$db->where('id', $product_id);
$product = $db->getOne('products');
?>

<?php
$images = explode(",",$product['file_name']);
$first_img = $images[0];
$first_imgURL = 'admin/uploads/'.$first_img


?>
<?php 
session_start();
?>

<!DOCTYPE php>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Brook's Fashion</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#03a6f3">

	<meta name="title" content="Brooks Fashion | <?php echo $product['product_name']?>">
<meta name="description" content="<?php echo $product['product_desc']?>">
<meta property="og:image:type" content="image/jpg" />
<meta property="og:type" content="fashion-website">
<meta property="og:url" content="https://brooksfashion.ml/product-single.php?id=<?php echo $product_id;?>">
<meta property="og:title" content="<?php echo $product['product_name']?>">
<meta property="og:description" content="<?php echo $product['product_desc']?>">
<meta property="og:image" content="https://brooksfashion.ml/<?php echo  $first_imgURL;  ?>">
<meta property="image" content="https://brooksfashion.ml/<?php echo  $first_imgURL;  ?>">


	<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="PUBLIC">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/css/styles.css">
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-171025214-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-171025214-2');
</script>

    
</head>
<style>
.progress-line, .progress-line:before {
  height: 5px;
  width: 100%;
  margin: 0;
}
.progress-line {
  background-color: #fff3cd;
  display: -webkit-flex;
  display: flex;
}
.progress-line:before {
  background-color: #ff9700;
  content: '';
  -webkit-animation: running-progress 2s cubic-bezier(0.4, 0, 0.2, 1) infinite;
  animation: running-progress 2s cubic-bezier(0.4, 0, 0.2, 1) infinite;
}
@-webkit-keyframes running-progress {
  0% { margin-left: 0px; margin-right: 100%; }
  50% { margin-left: 25%; margin-right: 0%; }
  100% { margin-left: 100%; margin-right: 0; }
}
@keyframes running-progress {
  0% { margin-left: 0px; margin-right: 100%; }
  50% { margin-left: 25%; margin-right: 0%; }
  100% { margin-left: 100%; margin-right: 0; }
}

</style>
<body>

<div id="loading-bar" class="container-fluid m-0 p-0">
    <div class="fixed-top progress-line"></div>
</div>

<header  style="margin-bottom:-25px;">
        
        <div class="main-menu">
            
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand" href="index.php">
                    <h1 class="display-5 py-3"><span style='color:#ff9700; letter-spacing: 0.1em;font-weight:400'>Bro</span><span style='color:#2d2d2d; letter-spacing: 0.1em;font-weight:400'>ok's</span></h1>
                    </a>
                   
                    
                    <button class="navbar-toggler ml-0 " type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>


                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                            <li class="navbar-item ">
                                <a href="/index.php" class="nav-link">Home</a>
                            </li>
                            <li class="navbar-item">
                                <a href="/shop.php" class="nav-link">Shop</a>
                            </li>
                            <li class="navbar-item">
                                <a href="/about.php" class="nav-link">About</a>
                            </li>
                            <li class="navbar-item">
                                <a href="/faq.php" class="nav-link">FAQ</a>
                            </li>
 <li class="navbar-item">
                                 <a href="/associates/" class="nav-link">Affiliates</a>
                            </li>                            
                            <li class="navbar-item">
                                <?php if(isset($_SESSION['public_user_id'])){?>
                                <a href="/users/index.php" class="nav-link">Account</a>
                                <?php }else{ ?>
                                    <a href="/login.php" class="nav-link">Login</a>
                                <?php }?>


                            </li>
                        </ul>
                        <form action ="/search.php" method="GET" class="form-inline my-2 my-lg-0">
                            <input id="searchbar" class="form-control mr-sm-2"  name="search_str" value="<?php echo htmlspecialchars($search_str, ENT_QUOTES, 'UTF-8'); ?>" type="search" placeholder="Search here..." aria-label="Search">
                            <span class="fa fa-search"></span>
  
                        </form>

                    </div>
                </nav>
            </div>
        </div>
    </header>

	<script>

$(document).ready(function() {

$("#loading-bar").delay(1000).fadeOut("slow");

})
	</script>






<!-- MODAL -->


<div class="modal fade register_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Please Login First</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST" action="includes/auth/user_authenticate.php">
          <div class="form-group">
            <label for="phone_number" class="col-form-label">Phone Number</label>
            <input type="text" class="form-control" id="phone_number" name="phone_number">
          </div>
          <div class="form-group">
            <label for="password" class="col-form-label">Password</label>
            <input type="password" class="form-control" id="password"  name="password" >
          </div>
          <input type="text" hidden  value="product-single.php?id=<?php echo $product_id?>" name="q" >

      </div>
      <div class="modal-footer">
        <a href="register.php?q=product-single.php?id=<?php echo $product_id?>" type="button" class="btn">Register</a>
        <button type="submit" class="btn black">Login</button>
      </div>
      </form>

    </div>
  </div>
</div>



    <div class="breadcrumb">
        <div class="container">
            <a class="breadcrumb-item" href="index.php">Home</a>
            <a class="breadcrumb-item" href="shop.php">Shop</a>
            <a href ="getallproducts.php?cat=<?php echo $product['product_category'] ?>" class="breadcrumb-item "><?php echo $product['product_category'] ?></a>
           
            <span class="breadcrumb-item "><?php echo $product['product_name'] ?></span>
        </div>
    </div>
    <section class="product-sec">
        <div class="container">
            <h1><?php echo $product['product_name'] ?></h1>
            <div class="row">
                <div class="col-md-6 slider-sec">
                    <!-- main slider carousel -->
                    <div id="myCarousel" class="carousel slide">
                        <!-- main slider carousel items -->
                        <div class="carousel-inner">

                        <?php
                             $images = explode(",",$product['file_name']);
                             $first_img = $images[0];
                             $first_imgURL = 'admin/uploads/'.$first_img
                             ?>

                            <div class="active item carousel-item" data-slide-number="0">
                                <img src="<?php echo  $first_imgURL;  ?>" class="img-fluid">
                            </div>

                            <?php
                                                             $id= 1;

                             foreach ($images as  $key =>$image)
                             {
                                if($key>0){
                                 $imageURL = 'admin/uploads/'.$image;
                                 ?>
                                 
                                 <div class="item carousel-item" data-slide-number="<?php echo  $id;  ?>">
                                        <img src="<?php echo  $imageURL;  ?>" class="img-fluid">
                                    </div>
                                 <?php
                                    $id +=1;
                             }}
                            
                            ?>
                            
                           
                        </div>
                        <!-- main slider carousel nav controls -->
                        <ul class="carousel-indicators list-inline">
                            <li class="list-inline-item active">
                                <a id="carousel-selector-0" class="selected" data-slide-to="0" data-target="#myCarousel">
                                <img src="<?php echo  $first_imgURL;  ?>" class="img-fluid">
                            </a>
                            </li>
                            <?php
                            $id= 1;
                             foreach ($images as $key =>$image)
                             {
                                if($key>0){
                                 $imageURL = 'admin/uploads/'.$image;
                                 
                                 ?>
                                        <li class="list-inline-item">
                                        <a id="carousel-selector-<?php echo  $id;  ?>" data-slide-to="<?php echo  $id;  ?>" data-target="#myCarousel">
                                        <img src="<?php echo  $imageURL;  ?>" class="img-fluid">
                                    </a>
                                    </li>
                                 <?php
                                 $id +=1;
                             }}
                            
                            ?>

                           
                            
                        </ul>
                    </div>
                    <!--/main slider carousel-->
                </div>
                <div class="col-md-6 slider-content">
                    <?php $name="";
                			if($product['product_belongs_to'] != 'owner'){?>
                    <div class="bg-dark p-3 mb-4 text-white text-uppercase text-center">
                            <?php 
                            $name= $db->where('id',$product['product_owner'])->getValue('associate_accounts','bussiness_name');
                            echo $name;
                            ?>


                    </div>
                            <?php }?> 
                                               <p><?php echo $product['product_name']; ?> </p>

                    <p class="text-justify"><?php echo $product['product_desc'] ?></p>
                    <p><strong><?php echo $product['product_quality'] ?></strong> Quality</p>
                    <ul>
                       
                        <li>
                            <span class="name">Market Price</span><span class="clm">:</span>
                            <span class="price">₹<?php echo $product['product_price'] ?>/=</span>
                        </li>
                        <li>
                            <span class="name">Offer </span><span class="clm">:</span>
                            <span class="price final">₹<?php echo $product['product_discount_price'] ?>/=</span>
                        </li>
                        <li><span class="save-cost">Save ₹ <?php echo $product['product_price']-$product['product_discount_price'] ?>/= </span></li>
                    </ul>
                               

                    <div class="btn-sec">
                     
<a class ="btn btn-sm" href="whatsapp://send?text=%2A<?php echo $product['product_name']?>%2A%20%2A,<?php echo $name;?>%2A%0A%2ABrooks%20Fashion%2A Save ₹ <?php echo $product['product_price']-$product['product_discount_price'] ?>/= %0A Get yours for ₹<?php echo $product['product_discount_price'] ?>/= %0A Buy now https://brooksfashion.ml/product-single.php?id=<?php echo $product_id ?>&data=https://brooksfashion.ml/<?php echo  $first_imgURL;  ?>" data-action="share/whatsapp/share"><i class="fa fa-whatsapp" aria-hidden="true"></i>&nbsp;Share </a>

                    <?php if(isset($_SESSION['user_logged_in'])){?>
                            <a href="/users/checkout.php?id=<?php echo $product['id'] ?>" class="btn black">Buy Now</a>
                        <?php }else{ ?>
                            <a data-toggle="modal" data-target=".register_modal" href="#" class="btn black">Buy Now</a>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="related-books">
        <div class="container">
            <h2>You may also like these ...</h2>
 <?php
                             
    $costumers = new Products();
    $category = $product['product_category'] ;

    $order_by	= filter_input(INPUT_GET, 'order_by');
    $order_dir	= filter_input(INPUT_GET, 'order_dir');

// Per page limit for pagination
$pagelimit = 4;

// Get current pagecostumers
$page = filter_input(INPUT_GET, 'page');
if (!$page) {
	$page = 1;
}

// If filter types are not selected we show latest added data first
if (!$order_by) {
	$order_by = 'id';
}
if (!$order_dir) {
	$order_dir = 'Desc';
}

// Get DB instance. i.e instance of MYSQLiDB Library
$db = getDbInstance();
$select = array('id', 'product_name', 'product_desc', 'product_category', 'file_name', 'product_discount_price', 'product_quality','created_at', 'updated_at');

// Start building query according to input parameters
// If search string
if ($category) {
	$db->where('product_category', '%' . $category . '%', 'like');
}
// If order direction option selected
if ($order_dir) {
	$db->orderBy($order_by, $order_dir);
}

// Set pagination limit
$db->pageLimit = $pagelimit;

// Get result of the query
$rows = $db->arraybuilder()->paginate('products', $page, $select);
$total_pages = $db->totalPages;

                             ?>



            <div class="recomended-sec">
                <div class="container">
                <div class="row">
    <?php
                if($rows){
                    foreach ($rows as $row): 
                    
                    $images = explode(",",$row['file_name']);
                    $imageURL = 'admin/uploads/'.$images[0]
                    ?>
                    <div class="col-lg-3 col-md-6">
                        <div class="item">
                        <a href="product-single.php?id=<?php echo $row['id']; ?>"><img style="width:135px; height:218px" src="<?php echo $imageURL; ?>" alt="img"></a>
                            <h3 class="text-capitalize "><?php echo $row['product_name']?></h3>
                            <h6><span class="price">₹<?php echo $row['product_discount_price']?></span> / <a href="product-single.php?id=<?php echo $row['id']; ?>">Buy Now</a></h6>
                            <div class="sale"> Sale</div>
                            <div class="hover">
                            <a href="product-single.php?id=<?php echo $row['id']; ?>">
                                <span><i class="fa fa-long-arrow-right" aria-hidden="true"></i></span>
                            </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; }?>
                </div>
            </div>




        </div>
    </section>
<script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=5efdbd05e688b700120e99ab&product=inline-share-buttons" async="async"></script>
    <?php include 'includes/categories.php'; ?>
     
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/owl.carousel.min.js"></script>
    <script src="js/custom.js"></script>
	<script>

$(document).ready(function() {

$("#loading-bar").delay(1000).fadeOut("slow");

})
	</script>

</body>

</html>