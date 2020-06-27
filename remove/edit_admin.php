<?php
session_start();
require_once '../admin/config/config.php';
require_once 'includes/auth_validate.php';

// Users class
require_once 'lib/AssociateUsers/AssociateUsers.php';
$Associate = new Associate();

// User ID for which we are performing operation
$associate_admin_id = filter_input(INPUT_GET, 'associate_user_id');
$operation = filter_input(INPUT_GET, 'operation', FILTER_SANITIZE_STRING);
($operation == 'edit') ? $edit = true : $edit = false;

// Serve POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	// Sanitize input post if we want
	$data_to_db = filter_input_array(INPUT_POST);

	// Check whether the user name already exists
	$db = getDbInstance();
	$db->where('email_address', $data_to_db['email_address']);
	$db->where('id', $associate_admin_id, '!=');
	//print_r($data_to_db['user_name']);die();
	$row = $db->getOne('associate_accounts');
	//print_r($data_to_db['user_name']);
	//print_r($row); die();

	if (!empty($row['email_address']))
	{
		$_SESSION['failure'] = 'Email Address already exists';
		$query_string = http_build_query(array(
			'associate_admin_id' => $associate_admin_id,
			'operation' => $operation,
		));
		header('location: edit_admin.php?'.$query_string );
		exit;
	}

	$associate_admin_id = filter_input(INPUT_GET, 'associate_admin_id', FILTER_VALIDATE_INT);
	// Encrypting the password
	$data_to_db['password'] = password_hash($data_to_db['password'], PASSWORD_DEFAULT);
	// Reset db instance
	$db = getDbInstance();
	$db->where('id', $associate_admin_id);
	$stat = $db->update('associate_accounts', $data_to_db);

	if ($stat)
	{
		$_SESSION['success'] = 'Assocaite acccount user has been updated successfully';
	} else {
		$_SESSION['failure'] = 'Failed to update Admin user: ' . $db->getLastError();
	}

	header('location: index.php');
	exit;
}

// Select where clause
$db = getDbInstance();
$db->where('id', $associate_admin_id);

$admin_account = $db->getOne("associate_accounts");

// Set values to $row
?>
<?php include 'includes/header-nav.php'; ?>
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h2 class="page-header"><?php echo (!$edit) ? 'Add' : 'Privacy'; ?> Settings</h2>
		</div>
	</div>
	<?php include '../admin/includes/flash_messages.php'; ?>
	<form class="well form-horizontal" action="" method="post" id="contact_form" enctype="multipart/form-data">
    <div class="form-group">
    <label class="col-md-4 control-label">Email Address</label>
    <div class="col-md-4 inputGroupContainer">
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input type="text" name="email_address" placeholder="Username" class="form-control" required="" value="<?php echo ($edit) ? $admin_account['email_address'] : ''; ?>" autocomplete="off">
        </div>
    </div>
</div>
<!-- Password input -->
<div class="form-group">
    <label class="col-md-4 control-label">Password</label>
    <div class="col-md-4 inputGroupContainer">
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <input type="password" name="password" placeholder="Password" class="form-control" required="" autocomplete="off">
        </div>
    </div>
</div>

<!-- Submit button -->
<div class="form-group">
    <label class="col-md-4 control-label"></label>
    <div class="col-md-4">
        <button type="submit" class="btn btn-warning">Save <i class="glyphicon glyphicon-send"></i></button>
    </div>
</div>	</form>
</div>
<?php include 'includes/footer.php'; ?>
