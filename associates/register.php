<?php
session_start();
require_once '../admin/config/config.php';
require_once 'includes/auth_validate.php';

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
		header('location: index.php');
		exit;
	}
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Book Store</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#03a6f3">

    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="assests/css/styles-affiliates.css">

</head>
<style>

</style>
<body>
    <?php include 'includes/header.php'?>
   
    <div class="sticky-top  ">

   <section class="header-add" class="mt-0">
        <center>
         <span>   ****  GOOD THINGS TAKE TIME WE ARE HERE   ****</span>
        </center>
   </section>
 </div>
    <section class="static about-sec mt-2">
      <div class="container mt-5">
      <?php include  '../admin/includes/flash_messages.php'; ?>

        <div class="row">
            <div class="col-md-6">
                
            </div>
              
            <div  class="col-md-6">
                    <div id ="register_view" class="card">
                            <div class="card-header">Associate Register</div>
                            <div class="card-body">

                                <form class="form-horizontal" method="post" action="register.php">

                                    <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Your Name</label>
                                        <div class="cols-sm-10">
                                            <div class="input-group d-flex align-items-baseline">
                                                <span class="input-group-addon "><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                                <input type="text" class="form-control ml-2" name="name" id="name" placeholder="Enter your Name" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="bussiness_name" class="cols-sm-2 control-label">Bussiness Name</label>
                                        <div class="cols-sm-10">
                                            <div class="input-group d-flex align-items-baseline">
                                                <span class="input-group-addon "><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                                <input type="text" class="form-control ml-2" name="bussiness_name" id="bussiness_name" placeholder="Enter your Bussiness Name" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="address" class="cols-sm-2 control-label">Bussiness Address</label>
                                        <div class="cols-sm-10">
                                            <div class="input-group d-flex align-items-baseline">
                                                <span class="input-group-addon "><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                                                <input type="text" class="form-control ml-2" name="address" id="address" placeholder="Enter your Bussiness Address" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email_address" class="cols-sm-2 control-label">Your Email</label>
                                        <div class="cols-sm-10">
                                            <div class="input-group d-flex align-items-baseline">
                                                <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                                                <input type="text" class="form-control ml-2" name="email_address" id="email_address" placeholder="Enter your Email" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone" class="cols-sm-2 control-label">Phone Number</label>
                                        <div class="cols-sm-10">
                                            <div class="input-group d-flex align-items-baseline">
                                                <span class="input-group-addon"><i class="fa fa-phone fa" aria-hidden="true"></i></span>
                                                <input type="number" class="form-control ml-2" name="phone" id="phone" placeholder="Enter your Phone Number" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="cols-sm-2 control-label">Password</label>
                                        <div class="cols-sm-10">
                                            <div class="input-group d-flex align-items-baseline">
                                                <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                                <input type="password" class="form-control ml-2" name="password" id="password" placeholder="Enter your Password" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="confirm" class="cols-sm-2 control-label">Confirm Password</label>
                                        <div class="cols-sm-10">
                                            <div class="input-group d-flex align-items-baseline">
                                                <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                                <input type="password" class="form-control ml-2"  id="confirm" placeholder="Confirm your Password" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group text-center pt-3">
                                    <button type="submit" class="btn black btn-sm p-2 btn-block rounded login-button">Register</button>
                                    </div>
                                    
                                </form>
                                <div class="pt-2">
                                        Already Have an account?
                                        <a id ="login_show_btn" href="index.php">Login</a>
                                </div>

                            </div>
                    </div>
            </div>
        </div>
      </div>
    </section>
  

   <?php include 'includes/footer-nav.php' ?>

    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/owl.carousel.min.js"></script>
    <script src="/js/custom.js"></script>
    <script>
   

    </script>
</body>

</html>