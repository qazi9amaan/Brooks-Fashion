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

     $numProducts =  $db->where('product_owner',4)->getValue('products','count(*)');
    ?>
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Dancing+Script" />
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
    #featured-img{

    }

}
#featured-img{
    width: 310px;
margin-top: 26px;
}

@import url(//fonts.googleapis.com/css?family=Montserrat:300,500);
.service-38 {
  font-family: "Montserrat", sans-serif;
  color: #8d97ad;
  font-weight: 300;
}

.service-38 h1,
.service-38 h2,
.service-38 h3,
.service-38 h4,
.service-38 h5,
.service-38 h6 {
  color: #3e4555;
}

.service-38 .subtitle {
  color: #8d97ad;
  line-height: 24px;
}

.service-38 .card.card-shadow {
  -webkit-box-shadow: 0px 0px 30px rgba(115, 128, 157, 0.1);
  box-shadow: 0px 0px 30px rgba(115, 128, 157, 0.1);
}

.service-38 .text-success-gradiant {
    background: linear-gradient(90deg, rgba(255,177,0,1) 11%, rgba(247,170,6,0.7917367630646008) 56%);     -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
    text-fill-color: transparent;
}

.service-38 .img-position {
		right: 0px;
    z-index: 1;
}

.service-38 .op-8 {
		opacity: 0.8;
}

.service-38 .bg-orange {
    background: linear-gradient(-90deg, rgba(255,177,0,1) 9%, rgba(255,151,0,1) 45%, rgba(255,143,0,1) 76%); 
}

@media (max-width: 1023px) {
	.service-38 .position-absolute {
    position: relative !important;
	}
}

.service-38 .display-4 {
	font-size: 3rem !important;
}

#name{
    background: linear-gradient(90deg, rgba(255,177,0,1) 11%, rgba(247,170,6,0.7917367630646008) 56%);     -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
    text-fill-color: transparent;
     font-family: Dancing Script; font-size: 30px; font-style: italic; font-variant: normal; font-weight: 100; line-height: 30px; 
}
</style>


<section class="recomended-sec mt-0 pt-0">
        <div class=" ">
        <div class="service-38 wrap-service38-box">
    <div class="row bg-orange no-gutters">
        <div class="col-lg-6 position-absolute img-position"><img id="featured-img" src="/featured/modest-budget.jpg" class="  rounded-circle img-fluid" /> </div>
        <div class="container">
        <div class="row py-5">
            <div class="col-lg-6">
            <div class="p-3"> 
                <h3 class="mb-3 text-white text-uppercase">Modest budget <small>By Raihana</small></h3>
                <p class="text-white op-8">"You can have anything you want in life if you dress for it. —Edith Head".</p>
                <a href="#" class="text-white pr-3 font-weight-bold">#HighestGrosser</a>    
                <a href="#" class="text-white font-weight-bold">#MostFeaturedAssociate</a>    
            
                </div>
            </div>
        </div>
        </div>
    </div>
    <div class="row no-gutters">
        <div class="col-lg-12">
        <div class="card  border-0">
            <div class="container p-3">
            <div class="row no-gutters">
                <div class="col-lg-3 col-md-4">
                <div class="d-flex my-2">
                    <div class="display-4 mr-4"><span class="text-success-gradiant"><i class="fa fa-shopping-bag"></i></span></div>
                    <div class="">
                    <h3 class="mb-0 font-weight-light"> <?php echo $numProducts ?></h3>
                    <h6 class="subtitle font-weight-light">Products</h6>
                    </div>
                </div>
                </div>
                <div class="col-lg-3 col-md-4">
                <div class="d-flex my-2">
                    <div class="display-4 mr-4"><span class="text-success-gradiant"><i class="fa fa-star"></i></span></div>
                    <div class="">
                    <h3 class="mb-0 font-weight-light">85.5%</h3>
                    <h6 class="subtitle font-weight-light">Success</h6>
                    </div>
                </div>
                </div>
                <div class="col-lg-3 col-md-4">
                <div class="d-flex my-2">
                    <div class="display-4 mr-4"><span class="text-success-gradiant"><i class="fa fa-eye"></i></span></div>
                    <div class="">
                    <h3 class="mb-0 font-weight-light">129</h3>
                    <h6 class="subtitle font-weight-light">Views</h6>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    <div class="row no-gutters">
        <div class="col-lg-12">
        <div class="card  border-0">
            <div class="container p-3">
            <div class="row no-gutters">
                <div class="col-md-12 px-3 text-left">
                
                    <p class="lead">Dear Raihana,</p>
                    <p class="text-justify">
                    We would like to congratulate you for your outstanding contribution in Brooks Fashion. You are an amazing associate, who is diligent and hard working. 
                    You truly were able to think out of the box. Your dedication to work is resulting in an increased traffic for the brooks, 
                    which is increasing the client base. We expect to grow in the future if you deliver the same quality of work.
                    </p>
                    <p class="text-justify"> 
                    It is an honor to have such an amazing affiliate working with us. We are quite aware of the fact that you will grow and succeed in brooks and within a year, we will be seeing you as a leader on major sales of the brooks.
                    We hope to see you working with same dedication at brooks. Congratulations for being the First Most Featured Associate with your <?php echo $numProducts ?> products in first 12 days of Collaboration.
                    </p>

                    <p class="text-justify">    
                    Best regards,
                    </p>

                    <h3 id="name">Brooks Fashion</h3>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>
        </div>
       
    </section>
  
                        

	
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/owl.carousel.min.js"></script>
    <script src="/js/custom.js"></script>
	<script>

$(document).ready(function() {

$("#loading-bar").delay(1000).fadeOut("slow");

})
$('header').css('display','none');
	</script>


</body>

</html>