        <!-- HEADER -->
        <?php 
    require_once  'admin/config/config.php';
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
<style>
    .cat-btn{
    border: 0px !important;
    background: #ffd79c33 !important;
    color: #ff9700 !important;
    border-radius: .85rem !important;
    }
    
</style>
<?php
    $pagelimit = 12;
    $page = 1;
    $order_by = 'id';
    $db = getDbInstance();
    $select = array('id', 'product_name', 'product_desc', 'product_category', 'file_name', 'product_discount_price', 'product_quality','created_at', 'updated_at');
    $db->orderBy($order_by);
    $db->pageLimit = $pagelimit;
    $rows = $db->arraybuilder()->paginate('products', $page, $select);
    $total_pages = $db->totalPages;

    $numProducts = $db->where('id','4')->getValue('products','count(*)');
?>
<style>

#owl-demo .item img {
    background: linear-gradient(-90deg, rgba(255, 177, 0, 1) 9%, rgba(255, 151, 0, 1) 45%, rgba(255, 143, 0, 1) 76%);
    height: 731.383px;
    object-fit: cover;
}
@media screen and (max-width: 600px) {
    #owl-demo .item img {
    height: 300.283px;
        object-fit: cover;
        margin-top:15px
    }
    .service-38 .img-position {
    right: 0px !important;
    z-index: 1;}
    .service-38 .bg-orange {
    background: #ff9700 !important; 
}
.slider .slide .content .title h3 {
    margin-top:25px !important;
}

.slider .slide .content .title h5 {
    font-size: 18px;
    text-transform: uppercase;
    font-weight: 300;
    
}

}
#show-cat-btn:hover{
    cursor:pointer;
}

.slider .slide .content .title {
   
    margin-top:25px;
}

</style>

<link rel="stylesheet" href="/css/categories-navbar.css">

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
                        Cosmotics
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
        
    <section class="slider my-3 mb-4 ">
        <div class="container">
        <p type="button" id="show-cat-btn" data-state="close" onclick="toggleNav()" class="p-2 px-5 show-mob text-center btn-block cat-btn border hov-pointer rounded shadow"><i class="fa fa-bars"></i> &nbsp;Tap for categories </p>

            <div id="owl-demo" class="owl-carousel owl-theme">
                <div class="item">
                    <div class="slide">
                              <img src="images/test/1.jpg" >

                        <div class="content">
                            <div class="title">
                                <h3>welcome to brooks</h3>
                                <h5>Discover the best fashion online with us</h5>
                                <a href="shop.php" class="btn">SHOP NOW</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="slide">
                    <img src="images/main/1.jpeg" alt="slide1">
                        <div class="content">
                            <div class="title">
                            <h3>Become an Ecom Affiliate</h3>
                                <h5>Start Selling your products now</h5>
                                <a href="/associates/" class="btn">Become an Affiliate</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="item">
                    <div class="slide">
                        <img src="images/main/4.jpeg" alt="slide1">
                        <div class="content">
                            <div class="title">
                                <h3>Discover THE BEST</h3>
                                
                                <h5>You can get anything you want <br> in life if you dress for it..</h5>
                                <a href="shop.php" class="btn">shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="slide">
                        <img src="images/main/3.jpeg" alt="slide1">
                        <div class="content">
                            <div class="title">
                            <h3>Brooks Fashion</h3>
                                <h5>Life is too short to wear boring clothes</h5>
                                <a href="shop.php" class="btn">shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="slide">
                        <img src="images/test/4.jpg" alt="slide1">
                        <div class="content">
                            <div class="title">
                                <h3>"Style is the simple thing of <br> saying complicated things"</h3>
                                <h5>Jean Cocteau</h5>

                                <a href="shop.php" class="btn">shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <section id="featured-associate" class="recomended-sec mb-5 mt-0 pt-0  ">
                <div class="container">
                <div class="service-38 wrap-service38-box">
            <div class="row bg-orange no-gutters card-lift--cursor">
                <div class="col-lg-6 position-absolute hide-mob img-position"><img id="featured-img" src="/featured/modest-budget.jpg" class="  rounded-circle img-fluid" /> </div>
                <div class="container">
                <div class="row py-5">
                    <div class="col-lg-6">
                    <div class="p-3"> 
                        <h3 class="mb-3 text-white text-uppercase">Modest budget <small>By Raihana</small></h3>
                        <p class="text-white op-8">"You can have anything you want in life if you dress for it. —Edith Head".</p>
                        <a href="thankyou.php" class="text-white pr-3 font-weight-bold">#HighestGrosser</a>    
                        <a href="thankyou.php" class="text-white font-weight-bold">#MostFeaturedAssociate</a>    
                        <a href="thankyou.php" class="text-white font-weight-bold">#SeeWhatBrooksSays</a>    

                    
                        </div>
                    </div>
                </div>
                </div>
            </div>
       
            </div>
                </div>
    </section>

  
    <section class="recomended-sec mt-2 ">
        <div class="container">
            <div class="title">
                <h2>highly recommendes </h2>
                <hr>
            </div>
            <div class="row">
                <?php
                    if($rows){
                    foreach ($rows as $row): 

                    $images = explode(",",$row['file_name']);
                    $imageURL = 'admin/uploads/'.$images[0]
                ?>
                <div class="col-lg-3 col-md-6 mt-3">
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
    </section>
       
  
    <section class="about-sec mb-0 pb-1">
        <div class="about-img">
            <figure style="background:url(./images/main/5.jpeg)no-repeat;"></figure>
        </div>
        <div class="about-content">
            <h2>About brooks,</h2>
            <p class="text-justify">Brooks is a one stop shop for all your fashion and lifestyle needs. Being one of the largest e-commerce store for fashion and lifestyle products, Brooks aims at providing a hassle free and enjoyable shopping experience to shoppers across the country with the widest range of brands and products on its portal.</p>
            <p class="text-justify"> The brand is making a conscious effort to bring the power of 
            fashion to shoppers with an array of the latest and trendiest products available in the country.</p>
            <div class="btn-sec">
                <a href="shop.php" class="btn yellow">shop now</a>
                <a href="/associates" class="btn black">Become a Seller</a>
            </div>
        </div>
    </section>
    

    <?php include 'includes/footer.php' ?>
<script>
$('#featured-associate').click(function(){
    window.location.href ='thankyou.php';
})

</script>
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
function toggleNav() {
    var btn = $('#show-cat-btn');
    if(btn.attr('data-state')=='close'){
      document.getElementById("mySidenav").style.width = "350px";
      btn.attr('data-state','open');


  }else{
    btn.attr('data-state','close');
    document.getElementById("mySidenav").style.width = "0";
  }  
} 
	</script>