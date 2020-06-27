    <!-- HEADER -->
    <?php 
    require_once  'admin/config/config.php';
    include 'includes/header.php' ?>

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

?>
<style>

#owl-demo .item img {
    height: 731.383px;
    object-fit: cover;
}
@media screen and (max-width: 600px) {
    #owl-demo .item img {
    height: 271.283px;
    object-fit: cover;
}
}
</style>
    <!-- HEADER -->
<section class="slider">

        <div class="container">

            <div id="owl-demo" class="owl-carousel owl-theme">
                
                <div class="item">
                    <div class="slide">
                                                <img src="images/slide1.jpg" alt="slide1">

                        <div class="content">
                            <div class="title">
                                <h3>welcome to brooks</h3>
                                <h5>Discover the best fashion online with us</h5>
                                <a href="shop.php" class="btn">MORE</a>
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
                        <img src="images/slide3.jpg" alt="slide1">
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
    <section class="recomended-sec">
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

   




    <section class="about-sec">
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

    <section class="features-sec">
        <div class="container">
            <ul>
                <li>
                    <span class="icon"><i class="fa fa-shopping-cart" aria-hidden="true"></i></span>
                    <h3>SAFE SHOPPING</h3>
                    <h5>Safe Shopping Guarantee</h5>
                    <h6>You can trust us, we are here to provde better service</h6>
                </li>
                <li>
                    <span class="icon return"><i class="fa fa-reply-all" aria-hidden="true"></i></span>
                    <h3>6 Days Delivery</h3>
                    <h5>Faster Delivery</h5>
                    <h6>Within 6 days you will receive your product</h6>
                </li>
                <li>
                    <span class="icon chat"><i class="fa fa-comments" aria-hidden="true"></i></span>
                    <h3>24/7 SUPPORT</h3>
                    <h5>online Consultations</h5>
                    <h6>We are available here for your assistance 24/7 any time any where</h6>
                </li>
            </ul>
        </div>
    </section>

    <section class="testimonial-sec">
        <div class="container">
            <div id="testimonal" class="owl-carousel owl-theme">
                <div class="item">
                    <h3>I got my Gshock watch and i love it.The design is to die for.Cannot wait for the bag,i am dealing with Brooks Fashion since 2017.Best of luck for your website</h3>
                    <div class="box-user">
                        <h4 class="author">Faiq</h4>
                        <span class="country">Engineer</span>
                    </div>
                </div>
                <div class="item">
                    <h3>Thankyou so much to Brooks Fashion for making our wedding party absolutely amazing!
                    </h3>
                    <div class="box-user">
                        <h4 class="author">Anand </h4>
                        <span class="country">Developer</span>
                    </div>
                </div>
                <div class="item">
                    <h3>Your products are awesome,cheaper then anyother and most important,you are trustworthy.From whatsapp shopping ,you gave us awesome platform.Thankyou Mr.Owais yaqoob</h3>
                    <div class="box-user">
                        <h4 class="author">Shadab</h4>
                        <span class="country"> Singer</span>
                    </div>
                </div>
                <div class="item">
                    <h3>This is great platfrom for resellers like me,Thankyou so much for your support.</h3>
                    <div class="box-user">
                        <h4 class="author">Rihana</h4>
                        <span class="country">Modest Budget</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="left-quote">
            <img src="images/left-quote.png" alt="quote">
        </div>
        <div class="right-quote">
            <img src="images/right-quote.png" alt="quote">
        </div>
    </section>
    <?php include 'includes/footer.php' ?>
