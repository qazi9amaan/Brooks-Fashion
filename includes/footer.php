    
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="address">
                        <h4>Our Address</h4>
                        <h6>The BookStore, PES University </h6>
                        <h6>Call : 000 000 000</h6>
                        <h6>Email : info@bookstore.com</h6>
                    </div>

                </div>
                <div class="col-md-3">
                    <div class="navigation">
                        <h4>Navigation</h4>
                        <ul>
                            <li><a href="/index.php">Home</a></li>
                            <li><a href="/about.php">About Us</a></li>
                            <li><a href="/privacy-policy.php">Privacy Policy</a></li>
                            <li><a href="/terms-conditions.php">Terms</a></li>
                            <li><a href="/shop.php">Products</a></li>
                        </ul>
                    </div>
                    <div class="navigation">
                        <h4>Help</h4>
                        <ul>
                            <li><a href="/contact.php">Contact Us</a></li>
                            <li><a href="/privacy-policy.php">Privacy</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form">
                        <h3>Ecommerce Associates </h3>
                        <h6 class="text-justify">We are now offering an associate based ecommercing, if you want to sell your products nation-wide, please visit <a href="/associates/"> associate panel</a></h6>
                      

                        
                        <form  method="post" action="/associates/includes/authenticate.php">
                            <div class="row">
                            <?php
                            if (isset($_SESSION['associate_logged_in'])) {
                            ?>
                            <div class="col-md-12">
                                <p class="lead">
                                    We are happy to see that you're an associate, visit your account
                                </p>
                            </div>
                            <div class="col-md-5">
                                <a href ="/associates/" class="btn black">My Account</a>
                            </div>
                            <div class="col  ">
                            <a href ="/associates/logout.php" class="btn black">Logout</a>
                            </div>
                                </div>
                            <?php }else{ ?>
                                <div class="col-md-12">
                                    <input placeholder="Email" type ="email" name="email" required>
                                </div>
                                <div class="col-md-12">
                                    <input type="password" name="password" placeholder="password" required>
                                </div>
                                
                                <div class="col-md-5">
                                    <button class="btn black">Alright, Login</button>
                                </div>
                                <div class="col  ">
                                <p>Not yet registered? <a href="/associates/register.php">Register here</a></p>
                                </div>
                        
                            <?php } ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="copy-right">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h5>(C) 2020. All Rights Reserved. BookStore W</h5>
                    </div>
                    <div class="col-md-6">
                        <div class="share align-middle">
                            <span class="fb"><i class="fa fa-facebook-official"></i></span>
                            <span class="instagram"><i class="fa fa-instagram"></i></span>
                            <span class="twitter"><i class="fa fa-twitter"></i></span>
                            <span class="pinterest"><i class="fa fa-pinterest"></i></span>
                            <span class="google"><i class="fa fa-google-plus"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</footer>
	
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/owl.carousel.min.js"></script>
    <script src="/js/custom.js"></script>
	<script>

$(document).ready(function() {

$("#loading-bar").delay(1000).fadeOut("slow");

})
	</script>


</body>

</html>