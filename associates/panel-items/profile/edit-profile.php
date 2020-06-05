<?php
session_start();
require_once '/var/www/html/admin/config/config.php';
require_once '/var/www/html/associates/includes/auth_validate.php';

// Sanitize if you want
$operation = filter_input(INPUT_GET, 'operation', FILTER_SANITIZE_STRING); 
$edit = true ;
$db = getDbInstance();

// Handle update request. As the form's action attribute is set to the same script, but 'POST' method, 
if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $data_to_db = filter_input_array(INPUT_POST);

    $db = getDbInstance();
    $db->where('id', $_SESSION['associate_user_id']);
    $stat = $db->update('associate_accounts', $data_to_db);

    if ($stat)
    {
        $_SESSION['success'] = 'Account updated successfully!';
        header('Location: /associates');
        exit();
    }
}

if ($edit)
{
    $db->where('id', $_SESSION['associate_user_id']);
    $account = $db->getOne('associate_accounts');
}
?>
<?php include PARENT.'/associates/includes/header-nav.php'; ?>
<div id="page-wrapper">
    <div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">Update Profile</h2>
        </div>
    </div>
    <!-- Flash messages -->
    <?php include BASE_PATH.'/includes/flash_messages.php'; ?>
    <form class="form" action="" method="post"  enctype="multipart/form-data">
    <fieldset>
    <div class="form-group">
        <label for="name" class="cols-sm-2 control-label">Your Name</label>
        <div class="cols-sm-10">
            <div class="input-group d-flex align-items-baseline">
                <span class="input-group-addon "><i class="fa fa-user fa" aria-hidden="true"></i></span>
                <input type="text" class="form-control ml-2" value ="<?php echo ($edit) ? $account['name'] : ''; ?>" name="name" id="name" placeholder="Enter your Name" />
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="bussiness_name" class="cols-sm-2 control-label">Bussiness Name</label>
        <div class="cols-sm-10">
            <div class="input-group d-flex align-items-baseline">
                <span class="input-group-addon "><i class="fa fa-user fa" aria-hidden="true"></i></span>
                <input type="text" class="form-control ml-2" value ="<?php echo ($edit) ? $account['bussiness_name'] : ''; ?>" name="bussiness_name" id="bussiness_name" placeholder="Enter your Bussiness Name" />
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="address" class="cols-sm-2 control-label">Bussiness Address</label>
        <div class="cols-sm-10">
            <div class="input-group d-flex align-items-baseline">
                <span class="input-group-addon "><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                <input type="text" class="form-control ml-2" value ="<?php echo ($edit) ? $account['address'] : ''; ?>" name="address" id="address" placeholder="Enter your Bussiness Address" />
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="email_address" class="cols-sm-2 control-label">Your Email</label>
        <div class="cols-sm-10">
            <div class="input-group d-flex align-items-baseline">
                <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                <input type="text" class="form-control ml-2" value ="<?php echo ($edit) ? $account['email_address'] : ''; ?>" disabled id="email_address" placeholder="Enter your Email" />
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="phone" class="cols-sm-2 control-label">Phone Number</label>
        <div class="cols-sm-10">
            <div class="input-group d-flex align-items-baseline">
                <span class="input-group-addon"><i class="fa fa-phone fa" aria-hidden="true"></i></span>
                <input type="number" class="form-control ml-2" value ="<?php echo ($edit) ? $account['phone'] : ''; ?>" name="phone" id="phone" placeholder="Enter your Phone Number" />
            </div>
        </div>
    </div>
    <div class="form-group text-center pt-3">
    <button type="submit" class="btn btn-success p-2  rounded ">Update</button>
    </div>
</div>

    </form>
    </div>
</div>
<?php include PARENT.'/associates/includes/footer.php'; ?>
