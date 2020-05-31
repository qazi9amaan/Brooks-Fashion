<?php
require_once  'admin/config/config.php';

// Costumers class
require_once  'admin/lib/Products/Products.php';
$product_id = $_GET['id'];

$db = getDbInstance();

$db->where('id', $product_id);
$product = $db->getOne('products');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Book Store</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#03a6f3">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/styles.css">>
</head>
<style>
    .carousel-item img{

    }
</style>
<body>
<?php include 'includes/header.php' ?>
    <div class="breadcrumb">
        <div class="container">
            <a class="breadcrumb-item" href="index.html">Home</a>
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
                    <p><?php echo $product['product_name'] ?> </p>
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
                        <button class="btn ">Add To cart</button>
                        <a href="/users/checkout.php?id=<?php echo $product['id'] ?>" class="btn black">Buy Now</a>
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

    <?php include 'includes/categories.php'; ?>
     
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/owl.carousel.min.js"></script>
    <script src="js/custom.js"></script>

</body>

</html>