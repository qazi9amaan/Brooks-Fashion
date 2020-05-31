<?php
session_start();
require_once '../admin/config/config.php';
// Users class
require_once 'lib/AssociateUsers/AssociateUsers.php';
$token = bin2hex(openssl_random_pseudo_bytes(16));

// If User has already logged in, redirect to dashboard page.
if (isset($_SESSION['associate_logged_in']) && $_SESSION['associate_logged_in'] === TRUE)
{
	header('Location: account.php');
}

// If user has previously selected "remember me option": 
if (isset($_COOKIE['associate_series_id']) && isset($_COOKIE['associate_remember_token']))
{
	// Get user credentials from cookies.
	$series_id = filter_var($_COOKIE['associate_series_id']);
	$remember_token = filter_var($_COOKIE['associate_remember_token']);
	$db = getDbInstance();
	// Get user By series ID: 
	$db->where('series_id', $series_id);
	$row = $db->getOne('associate_accounts');

	if ($db->count >= 1)
	{
		// User found. verify remember token
		if (password_verify($remember_token, $row['remember_token']))
        {

			$_SESSION['associate_logged_in'] = TRUE;
			header('Location: account.php');
			exit;
		}
		else
		{
			clearAuthCookie();
			header('Location: index.php');
			exit;
		}
	}
	else
	{
		clearAuthCookie();
		header('Location: index.php');
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
                    <div  id ="login_view" class="card">
                            <div class="card-header">Associate Login</div>
                            <div class="card-body">

                                <form class="form-horizontal" method="post" action="includes/authenticate.php">
                                <?php if (isset($_SESSION['login_failure'])): ?>
            <div class="alert alert-danger alert-dismissable ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php
                echo $_SESSION['login_failure'];
                unset($_SESSION['login_failure']);
                ?>
            </div>
        <?php endif; ?>
                                    <div class="form-group">
                                        <label for="email" class="cols-sm-2 control-label">Your Email</label>
                                        <div class="cols-sm-10">
                                            <div class="input-group d-flex align-items-baseline">
                                                <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                                                <input type="text" class="form-control ml-2" name="email" id="email" placeholder="Enter your Email" />
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
                                    <div class="checkbox">
                                        <label>
                                            <input class="form-control" name="remember" type="checkbox" value="1">Remember Me
                                        </label>
                                    </div>
                                   
                                    <div class="form-group text-center pt-3">
                                        <button type="submit" class="btn black btn-sm p-2 btn-block rounded login-button">Login</button>
                                    </div>
                                        <div class="pt-2">
                                       Not yet registered?
                                        <a id ="register_show_btn" href="register.php">Register Now</a>
                                        </div>
                                </form>
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
    
</body>

</html>