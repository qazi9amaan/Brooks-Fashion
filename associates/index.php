<?php
session_start();
require_once '../admin/config/config.php';
if (isset($_SESSION['associate_logged_in']) && $_SESSION['associate_logged_in'] === TRUE)
{
	header('Location: account.php');
}
?>


<?php include 'includes/header.php';?>
<style>
    .login100-form {
        width: 560px;
        min-height: 100vh;
        display: block;
        background-color: #f7f7f7;
        padding: 180px 55px 55px 55px;
    }
</style>

<body style="background-color: #666666;">

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <form  method="post" action="includes/authenticate.php" class="login100-form validate-form">
                    <span class="login100-form-title p-b-43">
						Login Affiliates
					</span>



                    <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                        <input class="input100" type="text" name="email">
                        <span class="focus-input100"></span>
                        <span class="label-input100">Email</span>
                    </div>


                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" name="password">
                        <span class="focus-input100"></span>
                        <span class="label-input100">Password</span>
                    </div>

                    <?php if (isset($_SESSION['login_failure'])): ?>
                        <span class=" p-t-10 p-b-10 ">
                        <div class="alert alert-danger alert-dismissable ">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <?php
                            echo $_SESSION['login_failure'];
                            unset($_SESSION['login_failure']);
                            ?>
                    </div>
                    </span>
                    <?php endif; ?>


                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
							Login
						</button>
                    </div>

                    <div class="text-center p-t-46 p-b-20">
                        <span class="txt2">
							Not yet registered?
						</span>
                    </div>

                    <div class="login100-form-social flex-c-m">
                        <a href="register.php" class="btn btn-secondary ">
                           Register now
                        </a>


                    </div>
                </form>

                <div class="login100-more" style="background-image: url('images/2.jpg');">
                </div>
            </div>
        </div>
    </div>




    <?php include 'includes/footer-2.php';?>

</body>

</html>