    <?php
    session_start();
    require_once '/var/www/html/admin/config/config.php';
    require_once PARENT.'/associates/includes/auth_validate.php';

    $show_product_now_id = filter_input(INPUT_GET, 'product_id', FILTER_VALIDATE_INT);
    $db = getDbInstance();
    $db->where('id', $show_product_now_id);
    $show_product_now = $db->getOne('products');
    $images = explode(",",$show_product_now['file_name']);
    $firstImage= '/admin/uploads/'.$images[0];
    ?>
    <style>
    .product-img{
        width:150px;
        height:200px;
        padding:5px;
        object-fit:cover;
        border-radius:.75rem;
    }
    #page-wrapper{
        margin-bottom:45px;
    }
    #all-images-holder{
        padding:25px;
    }
    #text-holder{
        padding-left:25px;
        padding-right:25px;

    }
    @media only screen and (max-width: 600px) {
        .product-img{
        width:200px;
        height:250px;

        }
        #all-images-holder{
        padding:0px;
        }
    
    }
    .product-img-header{
        border-radius: 50% !important;
        height: 250px;
        width: 250px;
        object-fit:cover;
        
    }

    #img-holder{
        padding:25px;
    }
    }
    </style>
<?php  include PARENT . '/associates/includes/header-nav.php'; ?>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12 ">
                <h2 class="page-header"><?php echo $show_product_now['product_name']?></h2>
            </div>
        </div>
        <div class="row">

            <div id="img-holder" class="col-md-6 text-center">
                    <img src="<?php echo $firstImage?>" class="product-img-header " alt="" srcset="">
                </div>

            <div id="text-holder" class="col-md-6">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Product ID : </strong><?php echo $show_product_now['id']?></li>
                    <li class="list-group-item"><strong>Title : </strong><?php echo $show_product_now['product_name']?></li>
                    <li class="list-group-item"><strong>Description : </strong><?php echo $show_product_now['product_desc']?></li>
                    <li class="list-group-item"><strong>Quality : </strong><?php echo $show_product_now['product_quality']?></li>
                    <li class="list-group-item"><strong>Cost Price :  </strong> INR <?php echo $show_product_now['product_cost_price']?> /= <span class="badge badge-success">YOUR QUOTE</span></li>
                    <li class="list-group-item"><strong>Selling Price :  </strong> INR <?php echo $show_product_now['product_discount_price']?> /=</li>

                </ul>
            </div>

    
        </div>
        <div id="all-images-holder" class="row">
        <div class="col-md-12 ">
        <h3 class=" ml-4"> Product Images</h3>

                <?php if(isset($show_product_now) && ($show_product_now!= null)){
                    foreach ($images as &$image)
                    {
                        $imageURL = '/admin/uploads/'.$image;
                        ?>
                            <img class="product-img" src="<?php echo $imageURL; ?>" alt="" />
                        <?php
                    }}
                ?>
            </div>
        </div>
    </div>


    <?php include PARENT.'/associates/includes/footer.php'; ?>

