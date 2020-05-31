<?php
require_once  'admin/config/config.php';

// Costumers class
require_once  'admin/lib/Products/Products.php';
$costumers = new Products();


$category = $_GET['cat'];

$order_by	= filter_input(INPUT_GET, 'order_by');
$order_dir	= filter_input(INPUT_GET, 'order_dir');
$search_str	= filter_input(INPUT_GET, 'search_str');

// Per page limit for pagination
$pagelimit = 15;

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
    <link rel="stylesheet" href="css/styles.css">
</head>
<style>
    .product-main-img{
        height : 270px;
        padding : 2px;
    }

    .category-name-holder h2{
        font-size: 35px;
        margin-bottom: 10px;
        font-weight: 300;
    }
</style>
<body>
    <header>


        <div class="main-menu">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand" href="index.html"><img src="images/logo.png" alt="logo"></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                            <li class="navbar-item">
                                <a href="index.html" class="nav-link">Home</a>
                            </li>
                            <li class="navbar-item active">
                                <a href="shop.php" class="nav-link">Shop</a>
                            </li>
                            <li class="navbar-item">
                                <a href="about.html" class="nav-link">About</a>
                            </li>
                            <li class="navbar-item">
                                <a href="faq.html" class="nav-link">FAQ</a>
                            </li>
                            <li class="navbar-item">
                                <a href="login.html" class="nav-link">Login</a>
                            </li>
                        </ul>
                        <div class="cart my-2 my-lg-0">
                            <span>
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i></span>
                            <span class="quntity">3</span>
                        </div>
                        <form class="form-inline my-2 my-lg-0">
                            <input class="form-control mr-sm-2" type="search" placeholder="Search here..." aria-label="Search">
                            <span class="fa fa-search"></span>
                        </form>
                    </div>
                </nav>
            </div>
        </div>
    </header>
    <div class="breadcrumb mb-0">
        <div class="container">
            <a class="breadcrumb-item" href="index.html">Home</a>
            <a class="breadcrumb-item" href="shop.php">Categories</a>
            <span class="breadcrumb-item "><?php echo str_replace("-"," ",$category) ?></span>
        </div>
    </div>
   <div class="container mt-0 p-5 align-content-center text-center category-name-holder align-content-center">
            <h2 id="<?php echo $category ?>"><?php echo str_replace("-"," ",$category) ?></h2>

   </div>



    <section class="static about-sec mt-2">
        <div class="container">

            
            
            <div class="recent-book-sec">
                <div class="row">
                <?php 
                if($rows){
                    foreach ($rows as $row): 
                    
                    $images = explode(",",$row['file_name']);
                    $imageURL = 'admin/uploads/'.$images[0]
                    ?>
                    <div class="col-md-3">
                        <div class="item">
                            <a href="product-single.php?id=<?php echo $row['id']; ?>"><img class="product-main-img" src="<?php echo $imageURL; ?>" alt="img"></a>
                            <h3><a href="product-single.php?id=<?php echo $row['id']; ?>" class="text-capitalize "><?php echo $row['product_name']?></a></h3>
                            <h6><span class="price">₹<?php echo $row['product_discount_price']?></span> / <a href="product-single.php?id=<?php echo $row['id']; ?>">Buy Now</a></h6>
                        </div>
                    </div>
                <?php endforeach; }else{
                    ?>
                    <div class="col-md-12 border p-5">
                    <div class="text-center">
                    <h2>Good things take time!</h2><br>
                    
                    </div>
                    <a href="shop.php" class="btn btn-sm">Shop Again..</a>
                </div>
            <?php
                }
            ?>
            </div>
                </div>
            <div class="text-center">
            <?php echo paginationLinks($page, $total_pages, 'getllproducts.php'); ?>
            </div>

            
           <?php include 'includes/new_arriavls.php' ?>
        </div>
    </section>
    
    
    


    <?php include 'includes/categories.php'; ?>

    
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/owl.carousel.min.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>