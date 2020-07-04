
<?php

// If User has already logged in, redirect to dashboard page.
if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === TRUE)
{
	header('Location: /users/index.php');
}


require_once '/var/www/html/admin/config/config.php';
require_once 'lib/User/User.php';
$User = new User();

// Serve POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$data_to_db = filter_input_array(INPUT_POST);
    // Check whether the user name already exists
	$db = getDbInstance();
    $db->where('phone_number', $data_to_db['phone_number']);

	$db->get('auth_user_account');

	if ($db->count >= 1)
	{
		header('location: register.php?failure=User already exists');
		exit;
	}

	// Encrypting the password
	$data_to_db['password'] = password_hash($data_to_db['password'], PASSWORD_DEFAULT);
    // Reset db instance
    $data_to_db['created_at'] = date('Y-m-d H:i:s');

	$db = getDbInstance();
	$last_id = $db->insert('auth_user_account', $data_to_db);
    if ($last_id)
	{
        $_SESSION['public_user_id']=$last_id;
        $_SESSION['user_account_status']='new';
        $q=(isset($_GET['q']))?$_GET['q']:'index.php';
        header('location: /users/account-setup.php?reg_id='.$last_id.'&user='.$data_to_db['phone_number'].'&operation=create&q='.$q);
        $edit=false;
		exit;
	}
}

?>
<?php include 'includes/header.php' ?>

    <div class="breadcrumb">
        <div class="container">
            <a class="breadcrumb-item" href="index.php">Home</a>
            <span class="breadcrumb-item active">Register</span>
        </div>
    </div>
    <section class="static about-sec">
        <div class="container">
            <h1>My Account / REgister</h1>
            <p>We are just more then happy to see you here. </p>
            <div class="form">
            <?php if (isset($_GET['failure'])): ?>
				<div class="alert alert-danger alert-dismissable">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<?php
					echo $_GET['failure'];
					?>
				</div>
				<?php endif; ?>
                <form  method="post">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" name="phone_number" pattern="[0-9]{10}" title="Donot include the country code" placeholder="Phone Number" required>
                            <span class="required-star">*</span>
                        </div>
                        <div class="col-md-4">
                            <input name="password" type="password" placeholder="Password" required>
                            <span class="required-star">*</span>
                        </div>
                        <div class="col-md-4">
                            <input type="password" placeholder="Repeat Password" required>
                            <span class="required-star">*</span>
                        </div>
                        <div class="col-lg-8 col-md-12">
                            <button type="submit" class="btn black">Register</button>
                            <h5>Already Registered? <a href="login.php">Login here</a></h5>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <?php include 'includes/footer.php' ?>
