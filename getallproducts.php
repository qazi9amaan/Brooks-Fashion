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

	<?php  if(substr(CURRENT_PAGE,0,18) != 'product-single.php'){ ?>
	<meta name="description" content="Brooks Fashion deals in all kind of branded products.This is also the best platform to boost your online business">
	<meta name="keywords" content="online store,online business,ecom,ecommerce website,
shopping cart,e business,what is ecommerce,ecomerce,Fashion,Kashmir ecom,Brooks,Affiliates,affiliate marketing,online money,how to, free shopping,branded clothes, clothing,earning,earning">
<?php  }else{?>
<div class="meta" > </div>
<?php } ?>
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
	$db->where('product_category',  $category , 'like');
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

<link rel="stylesheet" href="/css/categories-navbar.css">
<div id="loading-bar" class="container-fluid m-0 p-0">
    <div class="fixed-top progress-line"></div>
</div>

<header  style="margin-bottom:-25px;">
        
        <div class="main-menu">
            
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light">
                <div class="d-flex pb-1 align-items-center">
                        <button class="navbar-toggler ml-0 " type="button" onclick="openNav()" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <a class="navbar-brand ml-3 pt-1" href="index.php">
                        <h1 class="display-5 py-3"><span style='color:#ff9700; letter-spacing: 0.1em;font-weight:400'>Bro</span><span style='color:#2d2d2d; letter-spacing: 0.1em;font-weight:400'>ok's</span></h1>
                        </a>
                    </div>


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
                           
                            <?php if(isset($_SESSION['public_user_id'])){?>
                                <li class="navbar-item">
                                <a href="/users/index.php" class="nav-link">Account</a>
                            </li>
                            <li class="navbar-item">
                                <a href="/users/logout.php" class="nav-link">Logout</a>
                            </li>
                            <?php }else{ ?>
                                <li class="navbar-item">
                                <a href="/login.php" class="nav-link">Login</a>
                            </li>
                            <?php }?>

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


    <div class=" bg-white">
        <div class="breadcrumb mb-0 border-top-1">
            <div class="container">
                <a class="breadcrumb-item" href="index.php">Home</a>
                <span class="breadcrumb-item active" >Shop</span>
                <span class="breadcrumb-item "><?php echo str_replace("-"," ",$category) ?></span>
            </div>
        </div>
    </div>
    <div class="wrapper">
    <div id="mySidenav" class="sidenav_mob">
            <nav id="sidebar">

<div class="p-4">
<h5 class=" h2  d-flex align-items-center"><i style="color:#333; font-size:25px" href="javascript:void(0)" onclick="closeNav()" id="dismiss" class="fa fa-angle-left"></i>&nbsp;
B<span style="color:#2d2d2d"> F<small style="font-size:20px" class="ml-0 pl-0">ASHION</small></span> </h1>
</div>

<ul id="mobile-nav" class="list-unstyled ">
<span class="text-muted header pl-3">Categories</span>
<div id="accordion">       
<div class="list-group mt-2 px-2">
        <button 
            data-toggle="collapse" data-target="#collapseOne-a" aria-expanded="true" aria-controls="collapseOne-a"
            type="button" 
            class="list-group-item border-0 rounded  cat-head d-flex justify-content-between align-items-center ">
            Clothing
            <i class="fa fa-caret-down"></i>
        </button>
        <div id="collapseOne-a" class=" collapse show" aria-labelledby="headingOne" data-parent="#accordion" >
            <a href="getallproducts.php?cat=Mens-Fashion" class="list-group-item border-0 list-group-item-action">Mens Fashion</a>
            <a href="getallproducts.php?cat=Womens-Fashion" class="list-group-item border-0 list-group-item-action">Women's Fashion</a>
        </div>

        <button 
            data-toggle="collapse" data-target="#collapse2-a" aria-expanded="true" aria-controls="collapse2-a"
            type="button" 
            class="list-group-item border-0 mt-2 collapsed rounded  cat-head d-flex justify-content-between align-items-center ">
            Bridal Wear
            <i class="fa fa-caret-down"></i>
        </button>
        <div id="collapse2-a" class=" collapse " aria-labelledby="headingOne" data-parent="#accordion" >
            <a href="getallproducts.php?cat=Lehanga" class="list-group-item border-0 list-group-item-action">Lehanga</a>
            <a href="getallproducts.php?cat=Bridal-Gown" class="list-group-item border-0 list-group-item-action">Bridal Gown</a>
            <a href="getallproducts.php?cat=Brocket-Suit" class="list-group-item border-0 list-group-item-action">Brocket Suit</a>

        </div>

        <button 
            data-toggle="collapse" data-target="#collapse3-a" aria-expanded="true" aria-controls="collapse3-a"
            type="button" 
            class="list-group-item border-0 mt-2 collapsed rounded  cat-head d-flex justify-content-between align-items-center ">
            Accessories
            <i class="fa fa-caret-down"></i>
        </button>
        <div id="collapse3-a" class=" collapse " aria-labelledby="headingOne" data-parent="#accordion" >
            <a href="getallproducts.php?cat=Watches" class="list-group-item border-0 list-group-item-action">Watches</a>
            <a href="getallproducts.php?cat=Shoes" class="list-group-item border-0 list-group-item-action">Shoes</a>
            <a href="getallproducts.php?cat=Handbags" class="list-group-item border-0 list-group-item-action">Bags , Handbags</a>
        </div>

        <button 
            data-toggle="collapse" data-target="#collapse4-a" aria-expanded="true" aria-controls="collapse4-a"
            type="button" 
            class="list-group-item border-0 mt-2 collapsed rounded  cat-head d-flex justify-content-between align-items-center ">
            Electronics
            <i class="fa fa-caret-down"></i>
        </button>
        <div id="collapse4-a" class=" collapse " aria-labelledby="headingOne" data-parent="#accordion" >
            <a href="getallproducts.php?cat=Speakers" class="list-group-item border-0 list-group-item-action">Speakers</a>
            <a href="getallproducts.php?cat=Ear-buds" class="list-group-item border-0 list-group-item-action">Ear buds</a>
            <a href="getallproducts.php?cat=Head-phone" class="list-group-item border-0 list-group-item-action">Head phone</a>
            <a href="getallproducts.php?cat=Smart-watches" class="list-group-item border-0 list-group-item-action">Smart watches</a>
        </div>

        <button 
            data-toggle="collapse" data-target="#collapse5-a" aria-expanded="true" aria-controls="collapse5-a"
            type="button" 
            class="list-group-item border-0 mt-2 rounded collapsed  cat-head d-flex justify-content-between align-items-center ">
            Home And Decor
            <i class="fa fa-caret-down"></i>
        </button>
        <div id="collapse5-a" class=" collapse " aria-labelledby="headingOne" data-parent="#accordion" >
            <a href="getallproducts.php?cat=Grocerries" class="list-group-item border-0 list-group-item-action">Grocerries</a>
            <a href="getallproducts.php?cat=Islamic-Scriptures" class="list-group-item border-0 list-group-item-action">Islamic Scriptures</a>
            <a href="getallproducts.php?cat=Customised-Gifts" class="list-group-item border-0 list-group-item-action">Customised Gifts </a>

        </div>

        <button 
            data-toggle="collapse" data-target="#collapse6-a" aria-expanded="true" aria-controls="collapse6-a"
            type="button" 
            class="list-group-item border-0 mt-2 rounded collapsed cat-head d-flex justify-content-between align-items-center ">
            Cosmetic
            <i class="fa fa-caret-down"></i>
        </button>
        <div id="collapse6-a" class=" collapse " aria-labelledby="headingOne" data-parent="#accordion" >
            <a href="getallproducts.php?cat=Bridal-Makeup" class="list-group-item border-0 list-group-item-action">Bridal Makeup</a>
        </div>

               
        </div> 
           </div> 
</ul>
<p class="text-muted header mt-3 mb-0 mb-2 pl-3">PAGES</p>

<div class="list-group list-group-flush px-3">
    <a href="/search.php" class="list-group-item pl-1 border-0 list-group-item-action"><i class="fa fa-search">&nbsp; &nbsp;</i>Search</a>
    <a href="/index.php" class="list-group-item border-0 pl-1 list-group-item-action"><i class="fa fa-home">&nbsp; &nbsp;</i>Home</a>
    <a href="/shop.php" class="list-group-item  border-0 pl-1 list-group-item-action"><i class="fa fa-shopping-bag">&nbsp; &nbsp;</i>Shop</a>
    <a href="/about.php" class="list-group-item  border-0 pl-1 list-group-item-action"><i class="fa fa-info-circle">&nbsp; &nbsp;</i>About</a>
    <a href="/faq.php" class="list-group-item  border-0 pl-1 list-group-item-action"><i class="fa fa-question-circle">&nbsp; &nbsp;</i>FAQ</a>
    <a href="/associates/" class="list-group-item  border-0 pl-1 list-group-item-action"><i class="fa fa-handshake-o">&nbsp; &nbsp;</i>Affiliates</a>
    <?php if(isset($_SESSION['public_user_id'])){?>
        <a href="/users/index.php"  class="list-group-item  border-0 pl-1   list-group-item-action"><i class="fa fa-user-circle-o">&nbsp; &nbsp;</i>Account</a>
        <a href="/users/logout.php"  class="list-group-item   border-0  pl-1 list-group-item-action"><i class="fa fa-arrow-circle-left">&nbsp; &nbsp;</i>Logout</a>
            <?php }else{ ?>
                <a href="/users/logout.php"  class="list-group-item    border-0 pl-1 list-group-item-action"><i class="fa fa-user-circle-o">&nbsp; &nbsp;</i>Login</a>
            <?php }?>
    </div>
</nav>
            </div>
            
                <div class="container-fluid ">
                    <div class="row">
                       <div class="col-3 hide-mob">
                            <div class="list-group mt-5 ">
                               
                                <button 
                                    data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"
                                    type="button" 
                                    class="list-group-item border-0 rounded  cat-head d-flex justify-content-between align-items-center ">
                                    Clothing
                                    <i class="fa fa-caret-down"></i>
                                </button>
                                <div id="collapseOne" class=" collapse show" aria-labelledby="headingOne" data-parent="#accordion" >
                                    <a href="getallproducts.php?cat=Mens-Fashion" class="list-group-item border-0 list-group-item-action">Mens Fashion</a>
                                    <a href="getallproducts.php?cat=Womens-Fashion" class="list-group-item border-0 list-group-item-action">Women's Fashion</a>
                                </div>

                                <button 
                                    data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapse2"
                                    type="button" 
                                    class="list-group-item border-0 mt-2 rounded  cat-head d-flex justify-content-between align-items-center ">
                                    Bridal Wear
                                    <i class="fa fa-caret-down"></i>
                                </button>
                                <div id="collapse2" class=" collapse show" aria-labelledby="headingOne" data-parent="#accordion" >
                                    <a href="getallproducts.php?cat=Lehanga" class="list-group-item border-0 list-group-item-action">Lehanga</a>
                                    <a href="getallproducts.php?cat=Bridal-Gown" class="list-group-item border-0 list-group-item-action">Bridal Gown</a>
                                    <a href="getallproducts.php?cat=Brocket-Suit" class="list-group-item border-0 list-group-item-action">Brocket Suit</a>

                                </div>

                                <button 
                                    data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3"
                                    type="button" 
                                    class="list-group-item border-0 mt-2 rounded  cat-head d-flex justify-content-between align-items-center ">
                                    Accessories
                                    <i class="fa fa-caret-down"></i>
                                </button>
                                <div id="collapse3" class=" collapse show" aria-labelledby="headingOne" data-parent="#accordion" >
                                    <a href="getallproducts.php?cat=Watches" class="list-group-item border-0 list-group-item-action">Watches</a>
                                    <a href="getallproducts.php?cat=Shoes" class="list-group-item border-0 list-group-item-action">Shoes</a>
                                    <a href="getallproducts.php?cat=Handbags" class="list-group-item border-0 list-group-item-action">Bags , Handbags</a>
                                </div>

                                <button 
                                    data-toggle="collapse" data-target="#collapse4" aria-expanded="true" aria-controls="collapse4"
                                    type="button" 
                                    class="list-group-item border-0 mt-2 rounded  cat-head d-flex justify-content-between align-items-center ">
                                    Electronics
                                    <i class="fa fa-caret-down"></i>
                                </button>
                                <div id="collapse4" class=" collapse show" aria-labelledby="headingOne" data-parent="#accordion" >
                                    <a href="getallproducts.php?cat=Speakers" class="list-group-item border-0 list-group-item-action">Speakers</a>
                                    <a href="getallproducts.php?cat=Ear-buds" class="list-group-item border-0 list-group-item-action">Ear buds</a>
                                    <a href="getallproducts.php?cat=Head-phone" class="list-group-item border-0 list-group-item-action">Head phone</a>
                                    <a href="getallproducts.php?cat=Smart-watches" class="list-group-item border-0 list-group-item-action">Smart watches</a>
                                </div>

                                <button 
                                    data-toggle="collapse" data-target="#collapse5" aria-expanded="true" aria-controls="collapse5"
                                    type="button" 
                                    class="list-group-item border-0 mt-2 rounded  cat-head d-flex justify-content-between align-items-center ">
                                    Home And Decor
                                    <i class="fa fa-caret-down"></i>
                                </button>
                                <div id="collapse5" class=" collapse " aria-labelledby="headingOne" data-parent="#accordion" >
                                    <a href="getallproducts.php?cat=Grocerries" class="list-group-item border-0 list-group-item-action">Grocerries</a>
                                    <a href="getallproducts.php?cat=Islamic-Scriptures" class="list-group-item border-0 list-group-item-action">Islamic Scriptures</a>
                                    <a href="getallproducts.php?cat=Customised-Gifts" class="list-group-item border-0 list-group-item-action">Customised Gifts </a>

                                </div>

                                <button 
                                    data-toggle="collapse" data-target="#collapse6" aria-expanded="true" aria-controls="collapse6"
                                    type="button" 
                                    class="list-group-item border-0 mt-2 rounded collapsed cat-head d-flex justify-content-between align-items-center ">
                                    Cosmetic
                                    <i class="fa fa-caret-down"></i>
                                </button>
                                <div id="collapse6" class=" collapse " aria-labelledby="headingOne" data-parent="#accordion" >
                                    <a href="getallproducts.php?cat=Bridal-Makeup" class="list-group-item border-0 list-group-item-action">Bridal Makeup</a>
                                </div>

                                
                           
                            </div>   
                            
                           


                       </div>
                       <div class="col">
                           <div class="px-3">

                           <section   id="featured-associate" class="recomended-sec hide-mob mt-5 pt-0  ">
                                    <div class="container-fluid">
                                    <div class="service-38 wrap-service38-box">
                                <div class="row bg-orange no-gutters card-lift--cursor">
                                    <div  class="col-lg-6 position-absolute img-position"><img id="featured-img" src="/images/bag.svg" class="  img-fluid" /> </div>
                                    <div class="container">
                                    <div class="row py-5">
                                        <div class="col-lg-6">
                                        <div class="p-3"> 
                                            <h3 class="mb-3 text-white text-uppercase"><span><?php echo str_replace("-"," ",$category) ?></span> <small>By Brooks</small></h3>
                                            <p class="text-white op-8">"You can have anything you want in life if you dress for it. —Edith Head".</p>
                                        
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                        
                                </div>
                                    </div>
                        </section>
                            <div class="container show-mob mt-0 p-5 align-content-center text-center category-name-holder align-content-center">
                            <h2 id="<?php echo $category ?>"><?php echo str_replace("-"," ",$category) ?></h2>
                            </div>
                            <section class="static about-sec mt-2">
                                <div class="container-fluid">
                               
                                    <div class="recent-book-sec mb-1 pb-1">
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
                                                        <div class="col-md-12  p-5 mb-3 ">
                                                        <div class="text-center">
                                                        <h2 class="lead">Good things take time!</h2><br>
                                                        
                                                        </div>
                                                        <a href="shop.php" class="btn btn-sm">Shop Again..</a>
                                                    </div>
                                                <?php
                                                    }
                                            ?>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                    <?php echo paginationLinks($page, $total_pages, 'getallproducts.php'); ?>
                                    </div>

                                    <?php include 'includes/new_arriavls.php' ?>

                                </div>
                                </section>
                           </div>
                       </div>
                    </div>
                </div>
        </div>


    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/owl.carousel.min.js"></script>
    <script src="js/custom.js"></script>

	<script>

$(document).ready(function() {

$("#loading-bar").delay(1000).fadeOut("slow");

})
function openNav() {
  document.getElementById("mySidenav").style.width = "350px";
}

/* Set the width of the side navigation to 0 */
function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
} 
	</script>
	<script>

$(document).ready(function() {

$("#loading-bar").delay(1000).fadeOut("slow");

})
	</script>
</body>

</html>