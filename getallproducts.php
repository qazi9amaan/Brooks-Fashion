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
    <?php include 'includes/header.php' ?>

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

    <div class="breadcrumb mb-0">
        <div class="container">
            <a class="breadcrumb-item" href="index.php">Home</a>
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