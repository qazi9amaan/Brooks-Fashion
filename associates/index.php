<?php 
session_start();
if (isset($_SESSION['associate_logged_in']) && $_SESSION['associate_logged_in'] === TRUE)
{
	header('Location: account.php');
}

?>
<?php include '../associates/includes/header.php'; ?>
<section id="intro" class="clearfix">
<div class="container">
<div class="intro-img">
<img src="http://tempcloud.ml/assets/img/hiw.png" alt="" class="img-fluid">
</div>
<div class="intro-info">
<h2>Become your <br>own boss..</h2>
<h2>Become a <br>Bookstore affiliate</h2>

<div>
<a href="login.php" class="btn-get-started scrollto">Login to your account</a>
<a href="register.php" class="btn-services scrollto">Register</a>
</div>
</div>
</div>
</section>
<?php include BASE_PATH . '/includes/flash_messages.php'; ?>
