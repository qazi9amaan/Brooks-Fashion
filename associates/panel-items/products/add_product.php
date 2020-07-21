<?php
session_start();
require_once '/var/www/html/admin/config/config.php';
require_once '/var/www/html/associates/includes/auth_validate.php';

$db = getDbInstance();
$db->where('id', $_SESSION['associate_user_id']);
$account_status = $db->getValue('associate_accounts','account_status');
if(  $account_status == 'banned'){
    header('Location:blocked-notifi.php');
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    
    $data_to_db = array_filter($_POST);
    $data_to_db['product_owner'] = $_SESSION['associate_user_id'];
    $data_to_db['created_by'] = $_SESSION['associate_user_id'];
    $data_to_db['created_at'] = date('Y-m-d H:i:s');
    $data_to_db['file_name'] = 'null';
    $data_to_db['product_desc'] = $_POST['product_desc'];

    $db = getDbInstance();
    $last_id = $db->insert('associate_products', $data_to_db);

    if ($last_id)
    {
        $_SESSION['success'] = 'Product added successfully, please add pictures.';
        header('Location: helper/?id='.$last_id.'&name='.$data_to_db['product_name']);
    	exit();
    }
    else
    {
        echo 'Insert failed: ' . $db->getLastError();
        exit();
    }
}

// We are using same form for adding and editing. This is a create form so declare $edit = false.
$edit = false;
?>






<?php include PARENT.'/associates/includes/header-nav.php'; ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">Add Product</h2>
        </div>
    </div>
    <!-- Flash messages -->
    <?php include BASE_PATH.'/includes/flash_messages.php'; ?>
    <form class="form" action="" method="post" id="customer_form" enctype="multipart/form-data">
        <?php include PARENT.'/associates/forms/product_form.php'; ?>
    </form>
</div>

<?php include PARENT.'/associates/includes/footer.php'; ?>
