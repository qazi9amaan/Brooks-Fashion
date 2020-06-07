    <!-- HEADER -->
    <?php 
    require_once  'admin/config/config.php';
    include 'includes/header.php' ?>

<?php
    $pagelimit = 4;
    $page = 1;
    $order_by = 'id';
    $db = getDbInstance();
    $select = array('id', 'product_name', 'product_desc', 'product_category', 'file_name', 'product_discount_price', 'product_quality','created_at', 'updated_at');
    $db->orderBy($order_by);
    $db->pageLimit = $pagelimit;
    $rows = $db->arraybuilder()->paginate('products', $page, $select);
    $total_pages = $db->totalPages;

?>

    <!-- HEADER -->
    <section class="slider">
        <div class="container">
            <div id="owl-demo" class="owl-carousel owl-theme">
                <div class="item">
                    <div class="slide">
                        <img src="images/slide1.jpg" alt="slide1">
                        <div class="content">
                            <div class="title">
                                <h3>welcome to bookstore</h3>
                                <h5>Discover the best books online with us</h5>
                                <a href="shop.php" class="btn">shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="slide">
                        <img src="images/slide2.jpg" alt="slide1">
                        <div class="content">
                            <div class="title">
                                <h3>welcome to bookstore</h3>
                                <h5>Discover the best books online with us</h5>
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
                                <h3>welcome to bookstore</h3>
                                <h5>Discover the best books online with us</h5>
                                <a href="shop.php" class="btn">shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="slide">
                        <img src="images/slide4.jpg" alt="slide1">
                        <div class="content">
                            <div class="title">
                                <h3>welcome to bookstore</h3>
                                <h5>Discover the best books online with us</h5>
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
                <h2>highly recommendes books</h2>
                <hr>
            </div>
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
    </section>

   




    <section class="about-sec">
        <div class="about-img">
            <figure style="background:url(./images/about-img.jpg)no-repeat;"></figure>
        </div>
        <div class="about-content">
            <h2>About bookstore,</h2>
            <p>hello</p>
            <p>bte</p>
            <div class="btn-sec">
                <a href="shop.php" class="btn yellow">shop books</a>
                <a href="login.php" class="btn black">subscriptions</a>
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
                    <h3>30- DAY RETURN</h3>
                    <h5>Moneyback guarantee</h5>
                    <h6>If you want to return the book we are here for you</h6>
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
                    <h3>I can never read all the books I want; I can never be all the people I want and live all the lives I want. I can never train myself in all the skills I want. And why do I want? I want to live and feel all the shades, tones and variations
                        of mental and physical experience possible in my life. And I am horribly limited.</h3>
                    <div class="box-user">
                        <h4 class="author">Sylvia Plath</h4>
                        <span class="country">The Unabridged Journals of Sylvia Plath</span>
                    </div>
                </div>
                <div class="item">
                    <h3>What really knocks me out is a book that, when you're all done reading it, you wish the author that wrote it was a terrific friend of yours and you could call him up on the phone whenever you felt like it. That doesn't happen much,
                        though
                    </h3>
                    <div class="box-user">
                        <h4 class="author">J.D. Salinger</h4>
                        <span class="country">The Catcher in the Rye</span>
                    </div>
                </div>
                <div class="item">
                    <h3>Sometimes, you read a book and it fills you with this weird evangelical zeal, and you become convinced that the shattered world will never be put back together unless and until all living humans read the book.</h3>
                    <div class="box-user">
                        <h4 class="author">John Green</h4>
                        <span class="country"> The Fault in Our Stars</span>
                    </div>
                </div>
                <div class="item">
                    <h3>Fairy tales are more than true: not because they tell us that dragons exist, but because they tell us that dragons can be beaten</h3>
                    <div class="box-user">
                        <h4 class="author">Neil Gaiman</h4>
                        <span class="country">Coraline</span>
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
