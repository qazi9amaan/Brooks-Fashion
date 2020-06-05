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
<style>
@media (min-width:768px) {
    .mt-md-11, .my-md-11 {
    margin-top: 9rem !important;
    }
}
#bg{
    background: url(/images/associate_main.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
  opacity : 0.9;
  
}
.card-header i{
    font-size:20px;
}
</style>
<body id="bg">
<div class="sticky-top  ">
    <?php include 'includes/header.php'?>
</div>
   <section class="header-add" class="mt-0">
        <center>
         <span>   ****  GOOD THINGS TAKE TIME WE ARE HERE   ****</span>
        </center>
   </section>
    <section   class="static about-sec mt-4 mt-md-11 mb-4">
      <div class="container">
      <?php include  '../admin/includes/flash_messages.php'; ?>
     
          <div class="row">
              
              
              <div  class="col-md-6 offset-md-8">
                    <div  id ="login_view" class="card">
                            <div class="card-header"><i class="fa fa-handshake-o"></i> &nbsp;Associate Login</div>
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
                                   <div class="px-3">
                                    <div class="text-center py-4">
                                    <i style="font-size:8.5rem;"class="fa fa-user-circle-o"></i>

                                    </div>
                                   <div class="form-group">
                                        <label for="email" class="cols-sm-2 control-label">Your email</label>
                                        <div class="cols-sm-10">
                                            <div class="input-group ">
                                                <input type="text" class="form-control" name="email" id="email" placeholder="Enter your Email" />
                                            </div>
                                        </div>
                                    </div>
                                   
                                    <div class="form-group">
                                        <label for="password" class="cols-sm-2 control-label">Password</label>
                                        <div class="cols-sm-10">
                                            <div class="input-group ">
                                                <input type="password" class="form-control" name="password" id="password" placeholder="Enter your Password" />
                                            </div>
                                        </div>
                                    </div>
                                    
                                   
                                    <div class="form-group text-center pt-3">
                                        <button type="submit" class="btn black btn-sm p-2 btn-block rounded login-button">Login</button>
                                    </div>
                                        <div class="pt-2">
                                       Not yet registered?
                                        <a id ="register_show_btn" href="register.php">Register Now</a>
                                        </div>

                                   </div>
                                </form>
                            </div>

                            </div>
                    </div>
              </div>
              
      </div>
    </section>
  


    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/owl.carousel.min.js"></script>
    <script src="/js/custom.js"></script>
    
</body>

</html>