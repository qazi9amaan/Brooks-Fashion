<?php
require_once  'admin/config/config.php';

// Costumers class
require_once  'admin/lib/Products/Products.php';
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

<body>
    <?php include 'includes/header.php' ?>

    <div class="sticky-top bg-white">
    <div class="breadcrumb mb-0 border-top-1">
        <div class="container">
            <a class="breadcrumb-item" href="index.html">Home</a>
            <span class="breadcrumb-item active" >Shop</span>
            <a class="breadcrumb-item" href="shop.php">Categories</a>

        </div>
    </div>

</div>
    <footer class="mt-0 mb-4">
        <div class="container mt-0">
            <div class="row">
                <div class="col-md-4">
                    <div class="navigation">
                        <h4>Clothing</h4>
                        <ul>
                            <li><a href="getallproducts.php?cat=Mens-Fashion">Mens Fashion</a></li>
                            <li><a href="getallproducts.php?cat=Womens-Fashion">Womens Fashion</a></li>

                        </ul>
                    </div>

                    <div class="navigation">
                        <h4>Electronics</h4>
                        <ul>
                            <li><a href="getallproducts.php?cat=Speakers">Speakers</a></li>
                            <li><a href="getallproducts.php?cat=Ear-buds">Ear buds</a></li>
                            <li><a href="getallproducts.php?cat=Head-phone">Head phone</a></li>
                            <li><a href="getallproducts.php?cat=Smart-watches">Smart watches</a></li>


                        </ul>
                    </div>



                </div>

                <div class="col-md-5">
                    <div class="navigation">
                        <h4>Accessories</h4>
                        <ul>
                            <li><a href="getallproducts.php?cat=Watches">Watches</a></li>
                            <li><a href="getallproducts.php?cat=Shoesn">Shoes</a></li>
                            <li><a href="getallproducts.php?cat=Handbags">Bags , Handbags</a></li>

                        </ul>
                    </div>
                    <div class="navigation">
                        <h4>Home And Decor</h4>
                        <ul>
                            <li><a href="getallproducts.php?cat=Grocerries">Grocerries</a></li>
                            <li><a href="getallproducts.php?cat=Islamic-Scriptures">Islamic Scriptures</a></li>
                            <li><a href="getallproducts.php?cat=Customised-Gifts">Customised Gifts </a>

                        </ul>
                    </div>

                   
                </div>
                <div class="col-md-3">
                    <div class="navigation">
                        <h4>Bridal Wear</h4>
                        <ul>
                            <li><a href="">Lehanga</a></li>
                            <li><a href="getallproducts.php?cat=Bridal-Gown">Bridal Gown</a></li>
                            <li><a href="getallproducts.php?cat=Brocket-Suit">Brocket Suit</a></li>

                        </ul>
                    </div>

                    <div class="navigation">
                        <h4>Cosmotics</h4>
                        <ul>
                            <li><a href="getallproducts.php?cat=Bridal-Makeup">Bridal Makeup</a></li>

                        </ul>
                    </div>




                    
                </div>
            </div>
        </div>

    </footer>


    <section class="static about-sec mt-4 mb-0">
        <div class="container">
            <h2>highly recommendes products</h2>
            <?php
                             
            $costumers = new Products();
        
            $order_by	= filter_input(INPUT_GET, 'order_by');
            $order_dir	= filter_input(INPUT_GET, 'order_dir');
        
        // Per page limit for pagination
        $pagelimit = 25;
        
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
    </section>

    </div>
    </section>
    <footer style="background: none;">
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
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/owl.carousel.min.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>