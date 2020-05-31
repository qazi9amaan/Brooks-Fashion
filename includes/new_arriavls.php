<?php
require_once  'admin/config/config.php';

// Costumers class
require_once  'admin/lib/Products/Products.php';
$costumers = new Products();
        
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
$select = array('id', 'product_name', 'product_desc', 'product_category', 'file_name', 'product_price','product_discount_price', 'product_quality','created_at', 'updated_at');

// Start building query according to input parameters
// If search string

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
                    <h2 class="text-left">NEW ARRIAVLS </h2>
                        <div class="row">
                            
                            <?php
                        if($rows){
                            foreach ($rows as $row): 
                            
                            $images = explode(",",$row['file_name']);
                            $imageURL = 'admin/uploads/'.$images[0]
                            ?>
                                <div class="col-lg-3 col-md-6 mt-sm-3">
                                    <div class="item">
                                        <a href="product-single.php?id=<?php echo $row['id']; ?>"><img style="width:135px; height:218px" src="<?php echo $imageURL; ?>" alt="img"></a>
                                        <h3 class="text-capitalize ">
                                            <?php echo $row['product_name']?>
                                        </h3>
                                        <h6><span class="price">₹<?php echo $row['product_discount_price']?></span> / <a href="product-single.php?id=<?php echo $row['id']; ?>">Buy Now</a></h6>
                                       <?php                                           
                                        $off = $row['product_price'] - $row['product_discount_price'];               
                                       ?>
                                        <div class="sale">₹ <?php echo $off?> OFF!</div>
                                        

                                        <div class="hover">
                                            <a href="product-single.php?id=<?php echo $row['id']; ?>">
                                                <span><i class="fa fa-shopping-cart" aria-hidden="true"></i></span>
                                            </a>
                                        </div>
                            </div>
                                </div>
                                <?php endforeach; }?>
                        </div>
                    </div>




                </div>