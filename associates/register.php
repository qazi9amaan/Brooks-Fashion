<?php
session_start();
require_once '../admin/config/config.php';
// If User has already logged in, redirect to dashboard page.
if (isset($_SESSION['associate_logged_in']) && $_SESSION['associate_logged_in'] === TRUE)
{
	header('Location: account.php');
}


$edit = false;

// Serve POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	// Sanitize input post if we want
	$data_to_db = filter_input_array(INPUT_POST);

	// Check whether the user name already exists
	$db = getDbInstance();
    $db->where('email_address', $data_to_db['email_address']);
    $db->orwhere('phone', $data_to_db['phone']);

	$db->get('associate_accounts');

	if ($db->count >= 1)
	{
		$_SESSION['failure'] = 'User already exists';
		header('location: register.php');
		exit;
	}

	// Encrypting the password
	$data_to_db['password'] = password_hash($data_to_db['password'], PASSWORD_DEFAULT);
	// Reset db instance
	$db = getDbInstance();
	$last_id = $db->insert('associate_accounts', $data_to_db);

	if ($last_id)
	{
		$_SESSION['success'] = 'Your Associate Account is successfully created!';
		header('location: index.php');
		exit;
	}
}
?>

<?php include 'includes/header.php';?>

<style>
    .login100-form {
        width: 560px;
        min-height: 100vh;
        display: block;
        background-color: #f7f7f7;
        padding: 60px 55px 55px 55px;
    }
</style>

<body style="background-color: #666666;">

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <form  method="post" action="register.php" class="login100-form validate-form">
                    <span class="login100-form-title p-b-45">
						Register Affliate
					</span>



                    <div class="wrap-input100 validate-input" data-validate="Valid name is required">
                        <input class="input100" type="text" name="name">
                        <span class="focus-input100"></span>
                        <span class="label-input100">Name</span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Valid bussiness name is required">
                        <input class="input100" type="text" name="bussiness_name">
                        <span class="focus-input100"></span>
                        <span class="label-input100">Bussiness Name</span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Valid email is required">
                        <input name="email_address" class="input100" name="email_address" type="email">
                        <span class="focus-input100"></span>
                        <span class="label-input100">Email</span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Valid phone  is required">
                        <input class="input100" type="phone" name="phone" >
                        <span class="focus-input100"></span>
                        <span class="label-input100">Phone</span>
                    </div>
                    <div class="wrap-input100 validate-input">
                        <textarea class="input100" type="text"  name="address"></textarea>
                        <span class="focus-input100"></span>
                        <span class="label-input100">Address</span>
                    </div>


                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" name="password">
                        <span class="focus-input100"></span>
                        <span class="label-input100">Password</span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" >
                        <span class="focus-input100"></span>
                        <span class="label-input100"> Confirm Password</span>
                    </div>

                    <?php include BASE_PATH . '/includes/flash_messages.php'; ?>


                    <div class="container-login100-form-btn">
                        <button type="submit" class="login100-form-btn">
							Register
						</button>
                    </div>

                    <div class="text-center p-t-46 p-b-20">
                        <span class="txt2">
							Already have an account? <a href="index.php">Login now</a>
						</span>
                    </div>

                   
                </form>
            
                <div class="login100-more" style="background-image: url('images/7.jpg');">
                </div>
            </div>
        </div>
    </div>


</body>
<?php include 'includes/footer-2.php';?>

</html>