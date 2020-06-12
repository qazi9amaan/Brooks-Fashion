<?php
require_once  'admin/config/config.php';
$token = bin2hex(openssl_random_pseudo_bytes(16));

// If User has already logged in, redirect to dashboard page.
if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === TRUE)
{
	header('Location: /users/index.php');
}

?>
<?php include 'includes/header.php' ?>

<style>
    .affiliate h5 {
        line-height: 50px;
        padding-left: 15px;
        font-weight: 300;
        text-transform: uppercase;
        font-size: 16px;
    }
    .check_box{

    }
</style>


    <div class="breadcrumb">
        <div class="container">
            <a class="breadcrumb-item" href="index.php">Home</a>
            <span class="breadcrumb-item active">Login</span>
        </div>
    </div>
    <section class="static about-sec">
        <div class="container">

            <h1>Login</h1>

            <p>Welcome back to the family, login ahead.</p>
            <div class="form">
                <form method="POST" action="includes/auth/user_authenticate.php">
                    <div class="row">
                        <div class="col-md-5">
                            <input  name="phone_number" pattern="[0-9]{10}" placeholder="Phone Number" required>
                            <span class="required-star">*</span>
                        </div>
                        <div class="col-md-5">
                            <input name="password"  type="password" placeholder="Password" required>
                            <span class="required-star">*</span>
                        </div>
                        <?php if (isset($_SESSION['login_failure'])): ?>
				<div class="col-md-10">
                <div class="alert alert-danger alert-dismissable ">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<?php
					echo $_SESSION['login_failure'];
					unset($_SESSION['login_failure']);
					?>
				</div></div>
				<?php endif; ?>
                           
                        <div class="col-lg-8 col-md-12">
                            <button class="btn black">Login</button>
                            <h5>not Registered? <a href="register.php">Register here</a></h5>
                        </div>

                    </div>
                </form>
            </div>

        </div>
    </section>
    <footer class="border-bottom p-4">
        <div class="container">
            <div class="row affiliate text-center">
                <div class="col-md-12 col-lg-6 text-center col-md-offset-2">
                    <h5>Are you an affiliate?</h5>
                </div>
                <div class="col-md-12 col-lg-6  col-md-offset-2">
                <a class="btn black btn-sm" href="associates">Login Associate</a>

                </div>
            </div>
        </div>
    </footer>
    <?php include 'includes/footer.php' ?>
