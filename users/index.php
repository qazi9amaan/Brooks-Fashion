
<?php
session_start();
require_once '/var/www/html/admin/config/config.php';

// Costumers class
require_once PARENT . '/associates/lib/Orders/Orders.php';
$orders = new Orders();

function dateDifference($start_date, $end_date)
{
    // calulating the difference in timestamps 
    $diff = strtotime($start_date) - strtotime($end_date);
      
    // 1 day = 24 hours 
    // 24 * 60 * 60 = 86400 seconds
    return ceil(abs($diff / 86400));
}

// Get Input data from query string
$order_by	= filter_input(INPUT_GET, 'order_by');
$order_dir	= filter_input(INPUT_GET, 'order_dir');
$search_str	= filter_input(INPUT_GET, 'search_str');
$current_user = $_SESSION['public_user_id'] ;
// Per page limit for pagination
$pagelimit = 7;

// Get current pagecostumers
$page = filter_input(INPUT_GET, 'page');
if (!$page) {
	$page = 1;
}

// If filter types are not selected we show latest added data first
if (!$order_by) {
	$order_by = 'o.order_id';
}
if (!$order_dir) {
	$order_dir = 'Desc';
}

// Get DB instance. i.e instance of MYSQLiDB Library
$db = getDbInstance();

// Start building query according to input parameters
// If search string
if ($search_str) {
	$db->where('product_name', '%' . $search_str . '%', 'like');
	$db->orwhere('product_category', '%' . $search_str . '%', 'like');
}
// If order direction option selected
if ($order_dir) {
	$db->orderBy($order_by, $order_dir);
}

// Set pagination limit
$db->pageLimit = $pagelimit;
$db->where('o.user_id', $current_user);
$db->join("products p", "o.product_id=p.id", "INNER");
$rows = $db->arraybuilder()->paginate('orders o', $page);
$total_pages = $db->totalPages;





?>
<?php include 'includes/header.php' ?>
<style>
.order img{
    width:185px;
    object-fit: cover;
    height:135px;
    margin:-1px;
}
</style>
<div style="margin-bottom:95px;" class="col mt-md-2 ">
    <div class="container-fluid m-0 p-0">
        <div class="row p-0">
            <div class="col-md-12 p-0 bg-light">
                <div class="breadcrumb mb-0">
                    <a class="breadcrumb-item text-capitalize" href="index.php"><?php echo $user_full_name; ?></a>
                    <span class="breadcrumb-item active">Orders</span>
                </div>
            </div>

            <div class="col-12 p-0 mt-3 mb-5">
                <div class="d-flex mx-4 mt-2 mx-md-5  border-bottom pb-2 align-items-center justify-content-between">
                <p class="  ml-1 h2 ">
                    My Orders
                </p>
                <i class="fa fa-search" aria-hidden="true"></i>
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
                                case "rejected":
                                    $state ="bg-danger text-white";
                                    break;
                                case "confirming":
                                    $state ="";
                                    break;
                               
                            }

                        ?>
                            
                        <a href="order_details.php?order_id=<?php echo $row['order_id'];?>" class="<?php echo $state; ?> list-group-item p-0 list-group-item-action mt-1 flex-column align-items-start">
                            <div class="d-flex">
                                <img src="<?php echo $first_imgURL;?>" class="rounded-left" alt="">
                                <div class="w-100 p-3">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1"><?php echo $row['product_name'];?></h5>
                                    <small><?php echo dateDifference($row['ordered_at'],date('Y-m-d H:i:s'));?> days ago</small>
                                </div>
                                <p class="mb-0 text-capitalize">Quality : <?php echo $row['product_quality'];?> </p>
                                <p class="mb-0">Price : <?php echo $row['amount'];?>/=</p>

                                <small class="text-capitalize">Status : <?php echo $row['order_status'];?></small>
                                </div>
                            </div>                   
                        </a>
                        


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
<?php include 'includes/footer.php' ?>
