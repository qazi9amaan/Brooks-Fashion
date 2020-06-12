<?php
    require_once  'admin/config/config.php';
    require_once  'admin/lib/Products/Products.php';
?>
 <?php
    $costumers = new Products();
    $order_by	= filter_input(INPUT_GET, 'order_by');
    $order_dir	= filter_input(INPUT_GET, 'order_dir');
    $search_str	= filter_input(INPUT_GET, 'search_str');

    $pagelimit = 15;
    $page = filter_input(INPUT_GET, 'page');
    if (!$page) {
        $page = 1;
    }
    if (!$order_by) {
        $order_by = 'id';
    }
    if (!$order_dir) {
        $order_dir = 'Desc';
    }
    $db = getDbInstance();
    $select = array('id', 'product_name', 'product_desc', 'product_category', 'file_name', 'product_price','product_discount_price', 'product_quality','created_at', 'updated_at');
    if ($order_dir) {
        $db->orderBy($order_by, $order_dir);
    }
    if ($search_str) {
        $db->where('product_name', '%' . $search_str . '%', 'like');
        $db->orwhere('product_category', '%' . $search_str . '%', 'like');

    }
    $db->pageLimit = $pagelimit;
    $rows = $db->arraybuilder()->paginate('products', $page, $select);
    $total_pages = $db->totalPages;       
?>
    <?php include 'includes/header.php' ?>
    <div class="breadcrumb mb-0 border-top-1">
        <div class="container">
            <a class="breadcrumb-item" href="index.php">Home</a>
            <span class="breadcrumb-item active" >Shop</span>
            <a class="breadcrumb-item" href="search.php">Search</a>
           </div>
    </div>
    <div class="sticky-top border-bottom bg-white">
    <div class="container  pt-3">
        <form action="" >
            <div class="d-flex">
                <input class="form-control" name="search_str" value="<?php echo htmlspecialchars($search_str, ENT_QUOTES, 'UTF-8'); ?>" placeholder="Search for product" type="search">
                <button type="submit" value="" class="btn rounded btn-sm ml-2"><i class="fa fa-search"></i> </button>
            </div>
        </form>
    </div>
</div>
  


    <section class="static about-sec mt-5 mb-0">
        <div class="container">
            <h2 class="pl-md-5">Search Results <?php echo '('.htmlspecialchars($search_str, ENT_QUOTES, 'UTF-8') . ')'; ?></h2>
                <div class="recomended-sec">
                    <div class="container">
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
                                <?php endforeach; }else{
                                    ?>
                                        <div class="col-12">
                                        <div class="card">
                                            <div class="card-body pt-5">
                                                <h2>Sorry!</h2>
                                                <h3> No results Found</h3>
                                                <p class="mt-0">We are working on our products, we will soon add it to your list!</p>
                                            </div>
                                        </div>
                                        </div>
                                <?php   }?>
                        </div>
                        <div class="row">
                                <div class="col-12 text-center">
    	                            <?php echo paginationLinks($page, $total_pages, 'search.php'); ?>
 
                                </div>
                        </div>
                    </div>




                </div>
    </section>

    <?php include 'includes/categories.php'?>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/owl.carousel.min.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>