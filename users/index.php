<?php
session_start();
require_once '/var/www/html/admin/config/config.php';

require_once PARENT . '/associates/lib/Orders/Orders.php';
$orders = new Orders();

function dateDifference($start_date, $end_date)
{
    $diff = strtotime($start_date) - strtotime($end_date);
    return ceil(abs($diff / 86400));
}

$order_by	= filter_input(INPUT_GET, 'order_by');
$order_dir	= filter_input(INPUT_GET, 'order_dir');
$search_str	= filter_input(INPUT_GET, 'search_str');
$current_user = $_SESSION['public_user_id'] ;
$pagelimit = 10;

$page = filter_input(INPUT_GET, 'page');
if (!$page) {
	$page = 1;
}

if (!$order_by) {
	$order_by = 'o.order_id';
}
if (!$order_dir) {
	$order_dir = 'Desc';
}

$db = getDbInstance();

if ($search_str) {
	$db->where('product_name', '%' . $search_str . '%', 'like');
	$db->orwhere('product_category', '%' . $search_str . '%', 'like');
}
if ($order_dir) {
	$db->orderBy($order_by, $order_dir);
}

$db->pageLimit = $pagelimit;
$db->where('o.user_id', $current_user);
$db->join("products p", "o.product_id=p.id", "INNER");
$rows = $db->arraybuilder()->paginate('orders o', $page);
$total_pages = $db->totalPages;

?>
<?php include 'includes/header.php' ?>
<style>
.order img{
    width:100px;
    object-fit: cover;
    height:100px;
    border-radius:50%;
}
.order .card{
    box-shadow:
}
.stretched-link{
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 1;
    pointer-events: auto;
    content: "";
    background-color: rgba(0,0,0,0);
}

.badge-theme{   border: 0px !important;
    background: #ffd79c33 !important;
    color: #ff9700 !important;
    border-radius: .85rem !important;
}
</style>
<div style="margin-bottom:95px;" class="col mt-md-3 ">
    <div class="container-fluid m-0 p-0">
        <div class="row p-0">
            <div class="col-md-12 p-0 bg-light">
                <div class="breadcrumb mb-0">
                    <a class="breadcrumb-item text-capitalize" href="index.php"><?php echo $user_full_name; ?></a>
                    <span class="breadcrumb-item active">Orders</span>
                </div>
            </div>

            <div style ="height:500px" class="col-12 p-0 mt-3 mb-5">
                <div class=" mx-4 mt-2 mx-md-5  border-bottom pb-2 ">
                <p class="  ml-1 h2 ">
                    My Orders
                </p>
                </div>
                
                <div class="p-3 px-md-5">
                <div class="order list-group" >
                <?php foreach ($rows as $row): ?>
                   
                        <?php 
                         $state ="";
                            $images = explode(",",$row['file_name']);
                            $first_img = $images[0];
                            $first_imgURL = '/admin/uploads/'.$first_img;
                            switch($row['order_status']){
                                case "accepted":
                                    $state ="bg-danger text-white";
                                    break;
                                case "confirming":
                                    $state ="";
                                    break;
                               
                            }

                        ?>
                        <div class="card border-0 py-2">
                            <div class="media position-relative align-items-center">
                                <img src="<?php echo $first_imgURL;?>" class="mr-3" alt="...">
                                <div class="media-body mt-2">
                                    <h5 class="mt-0 lead"><?php echo $row['product_name'];?> </h5>
                                    <span class="badge badge-theme p-2 font-weight-light text-uppercase"><?php
                                        if($row['order_status'] =='accepted')
                                        {
                                            echo 'Incomplete Payment';
                                        }
                                        else if($row['order_status'] =='delivering')
                                        {
                                            echo 'Shipped';
                                        }
                                        else{
                                            echo $row['order_status'];
                                        }
                                ?></span><br>
                                 <small class="py-0 my-0 text-muted pl-2"><?php echo dateDifference($row['ordered_at'],date('Y-m-d'));?> days ago</small>

                                    <a href="order_details.php?order_id=<?php echo $row['order_id'];?>" class="stretched-link"></a>
                                </div>
                                <span style="color:#ff9700"><i class="fa fa-arrow-circle-right"> </i></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    </div>

                                    <div class="text-center">
                        <?php echo paginationLinks($page, $total_pages, 'index.php'); ?>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
