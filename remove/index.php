<?php
session_start();
require_once '../admin/config/config.php';
if (isset($_SESSION['associate_logged_in']) && $_SESSION['associate_logged_in'] === TRUE)
{
	header('Location: account.php');
}
?>


<!--  -->
<?php include '../associates/includes/header.php'; ?>
<style>
    #intro{
        padding: 150px 0 25px 0;

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
                <p>Login to your account and sell</p>
            </header>
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
                                    <i style="font-size:8.5rem; color:#00366f"class="fa fa-handshake-o"></i>

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
                                        <button type="submit" class="btn btn-blue btn-sm p-2 btn-block rounded login-button">Login</button>
                                    </div>
                                        Not yet registered? <a href="register.php">Register now</a>

                                   </div>
                                </form>
        </section >
        <br>
        <section class="mt-5">
       
        </section>
<?php include '../associates/includes/footer-2.php' ?>
</main>

