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
    if($data_to_db['password']== null || empty($data_to_db['password']))
    {
        header('Location: change-password.php');
        $_SESSION['failure'] = 'Please provide a password';
        exit;
    }
    if($data_to_db['password'] != $data_to_db['c_password'])
    {
        header('Location: change-password.php');
        $_SESSION['failure'] = 'Please check your password, it didn\'t match!';
        exit;
    }
    $db = getDbInstance();
    $data['password'] = password_hash($data_to_db['password'], PASSWORD_DEFAULT);
    $db->where('id', $_SESSION['associate_user_id']);
    $stat = $db->update('associate_accounts', $data);

    if ($stat)
    {
        $_SESSION['success'] = 'Password updated successfully!';
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
    <div class="container mt-5 pt-5" >
    <div class="row mt-5">
        <div class="col-lg-12">
            <h2 class="page-header">Change Password</h2>
        </div>
    </div>
    <!-- Flash messages -->
    <?php include BASE_PATH.'/includes/flash_messages.php'; ?>
    <form class="form mt-5" action="" method="post"  enctype="multipart/form-data">
    <fieldset>
    <div class="form-group">
       
    <div class="form-group">
        <label for="phone" class="cols-sm-2 control-label">Password</label>
        <div class="cols-sm-10">
            <div class="input-group d-flex align-items-baseline">
                <span class="input-group-addon"><i class="fa fa-lock fa" aria-hidden="true"></i></span>
                <input type="password" class="form-control ml-2"  name="password" placeholder="Enter your Password" />
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="phone" class="cols-sm-2 control-label">Confirm Password</label>
        <div class="cols-sm-10">
            <div class="input-group d-flex align-items-baseline">
                <span class="input-group-addon"><i class="fa fa-lock fa" aria-hidden="true"></i></span>
                <input type="password" class="form-control ml-2"  name="c_password"  placeholder="Enter your Password" />
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
