<?php

$pagelimit = 15;
$page = filter_input(INPUT_GET, 'page');
if (!$page) {
	$page = 1;
}
$order_by = 'notification_id';
$order_dir = 'Desc';
$db = getDbInstance();

$db->orderBy($order_by, $order_dir);
$db->pageLimit = $pagelimit;

$not_rows = $db->where('associate_id',$_SESSION['associate_user_id'])->arraybuilder()->paginate('associate_notifications', $page);
$order_rows = $db->where('owner',$_SESSION['associate_user_id'])->arraybuilder()->paginate('order_notifcations', $page);
$total_pages = $db->totalPages;
?>


<div id="notification_drawer" style="overflow-y:scroll" class="overlay px-3">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <div class="Activity_title"><span>Activity</span></div>
        
    <div class="overlay-content">
            <div class="container-fluid">
            <div class="row">
                <div style="padding-right:15px; padding-bottom:5px;" class="col-12 text-right">
                    <?php if(sizeof($not_rows)){ ?>
                    <a href="/associates/includes/clear_notifications.php?all" class="btn btn-primary">Clear all</a>
                    <?php }?>
                </div>
            </div>
            <div class="list-group">
            <?php foreach ($not_rows as $noti): ?>

                <?php 
                    $db = getDbInstance();

                    switch($noti['notification_type']){

                        case "product_rejected":
                            $product = $db->where('id',$noti['id'])->getOne("associate_products");
                            $msg = 'Your product <strong>'.$product['product_name']."</strong> has been rejected because it's ".$product['product_status_reason'];
                            $icon ='fa fa-times fa-fw';
                            $class="danger";
                            $link ='/associates/panel-items/products/products.php';

                            break;
                        case "product_accepted":
                            $product = $db->where('id',$noti['id'])->getOne("products");
                            $msg = 'Your product <strong>'.$product['product_name']."</strong> has been accepted ";
                            $icon ='fa fa-check fa-fw';
                            $link ='/associates/panel-items/products/approved_products.php';

                            break;
                       
                       
                    }


                ?>
                  <a href="<?php echo $link ?>" class="<?php echo $class ?> list-group-item list-group-item-action notification_item">
                            <div>
                            <i class="<?php echo $icon ?>"></i>
                        
                        <span><?php echo $msg ?></span>
                            </div>
                              <span class="timestamp">
                                  <?php echo date( 'm/d/y g:i A', strtotime($noti['created-at'])); ?>
                              </span>
                          
                  </a>
             

            <?php endforeach; ?>

            </div>

            </div>

            <?php include 'order_notifications.php'?>


                    
        </div>
</div>