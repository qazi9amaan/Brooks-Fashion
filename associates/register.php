<?php
session_start();
require_once '../admin/config/config.php';
// If User has already logged in, redirect to dashboard page.
if (isset($_SESSION['associate_logged_in']) && $_SESSION['associate_logged_in'] === TRUE)
{
	header('Location: account.php');
}

// Users class
require_once 'lib/AssociateUsers/AssociateUsers.php';
$Associate = new Associate();

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
		header('location: login.php');
		exit;
	}
}
?>

<!--  -->
<?php include '../associates/includes/header.php'; ?>
<style>
    #intro{
        padding: 150px 0 20px 0;

    }
</style>


<!-- LOGIN AND TOP  -->
<section id="intro" class="clearfix">
</section>



<main id="main">
    <!-- REGISTER -->
    <section id="register">
        <div class="container">
            <header class="section-header mt-5">
                <h3>Start selling today!</h3>
                <p>Register now and be a part of us</p>
            </header>
            <form class="form-horizontal" method="post" action="register.php">
                <div class="form-row">
                <?php include BASE_PATH . '/includes/flash_messages.php'; ?>

                <div class="form-group col-md-6 ">
                    <label for="name" class="cols-sm-2 control-label">Your Name</label>
                    <div class="cols-sm-10">
                        <div class="input-group d-flex align-items-baseline">
                            <input required type="text" class="form-control " name="name" id="name" placeholder="Enter your Name" />
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-6 ">
                    <label for="bussiness_name" class="cols-sm-2 control-label">Bussiness Name</label>
                    <div class="cols-sm-10">
                        <div class="input-group d-flex align-items-baseline">
                            
                            <input required type="text" class="form-control " name="bussiness_name" id="bussiness_name" placeholder="Enter your Bussiness Name" />
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <label for="address" class="cols-sm-2 control-label">Bussiness Address</label>
                    <div class="cols-sm-10">
                        <div class="input-group d-flex align-items-baseline">
                            <textarea name="address"class="form-control " placeholder="Enter your Bussiness Address" id="address"  rows="5"></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-6 ">
                    <label for="email_address" class="cols-sm-2 control-label">Your Email</label>
                    <div class="cols-sm-10">
                        <div class="input-group d-flex align-items-baseline">
                            <input required type="text" class="form-control " name="email_address" id="email_address" placeholder="Enter your Email" />
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-6 ">
                    <label for="phone" class="cols-sm-2 control-label">Phone Number</label>
                    <div class="cols-sm-10">
                        <div class="input-group d-flex align-items-baseline">
                            <input required type="number" class="form-control " name="phone" id="phone" placeholder="Enter your Phone Number" />
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-6 ">
                    <label for="password" class="cols-sm-2 control-label">Password</label>
                    <div class="cols-sm-10">
                        <div class="input-group d-flex align-items-baseline">
                            <input required type="password" class="form-control " name="password" id="password" placeholder="Enter your Password" />
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-6 ">
                    <label for="confirm" class="cols-sm-2 control-label">Confirm Password</label>
                    <div class="cols-sm-10">
                        <div class="input-group d-flex align-items-baseline">
                            <input required type="password" class="form-control "  id="confirm" placeholder="Confirm your Password" />
                        </div>
                    </div>
                </div>

                </div>
                <div class="form-group  text-center col-md-12  mt-5">
                    <button type="submit" class="btn btn-primary ">Register</button>
                    <a href="login.php" class="btn btn-outline-primary ">Login to your account</a>

                </div>
            </form>
        </section >
        <br>
        <section class="mt-5">
       
        </section>

</main>

<?php include '../associates/includes/footer-2.php' ?>