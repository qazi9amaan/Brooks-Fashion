
<?php
session_start();

require_once '/var/www/html/admin/config/config.php';


// Serve POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

    if (isset($_SESSION['user_account_status']) && $_SESSION['user_account_status'] === 'new')
    {
        $data_to_db = filter_input_array(INPUT_POST);
        // Check whether the user name already exists
    
        $data_to_db['user']=$_SESSION['public_user_id'];
        $db = getDbInstance();
        $last_id = $db->insert('user_profiles', $data_to_db);

        if ($last_id)
        {
            $_SESSION['success'] = 'Your  Profile is successfully created!';
            $update['account_status'] = "created";
            $_SESSION['user_account_status'] = "created";
            $db->where('id', $_SESSION['public_user_id']);
            $db->update('auth_user_account', $update);
            header('location: index.php');
            exit;
        }
    }
    
	
}

?>

<?php include '../includes/header.php' ?>

    <div class="breadcrumb">
        <div class="container">
             <a class="breadcrumb-item" href="/index.php">Home</a>
            <a class="breadcrumb-item" href="#">Registration</a>
            <span class="breadcrumb-item active">Account-Setup</span>
        </div>
    </div>
    <section class="static about-sec mb-0">
        <div class="container">
            <h1>We are happy to see you here!</h1>
            <p class="text-justify">Dear user, please set up your profile before begining ahead. 
            There's a lot comming up next to you!</p>
            <div class="form">
            
				
                <form  method="post">
                    <?php include 'forms/user_setup.php' ?>
                </form>
            </div>
        </div>
    </section>
    <footer class="mt-3">
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
                            <li><a href="index.html">Home</a></li>
                            <li><a href="about.html">About Us</a></li>
                            <li><a href="privacy-policy.html">Privacy Policy</a></li>
                            <li><a href="terms-conditions.html">Terms</a></li>
                            <li><a href="products.html">Products</a></li>
                        </ul>
                    </div>
                    <div class="navigation">
                        <h4>Help</h4>
                        <ul>
                            <li><a href="">Shipping & Returns</a></li>
                            <li><a href="privacy-policy.html">Privacy</a></li>
                            <li><a href="faq.html">FAQ’s</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form">
                        <h3>Quick Contact us</h3>
                        <h6>We are now offering some good discount on selected books go and shop them</h6>
                        <>
                            <div class="row">
                                <div class="col-md-6">
                                    <input placeholder="Name" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="email" placeholder="Email" required>
                                </div>
                                <div class="col-md-12">
                                    <textarea placeholder="Messege"></textarea>
                                </div>
                                <div class="col-md-12">
                                    <button class="btn black">Alright, Submit</button>
                                </div>
                            </div>
                        </>
                    </div>
                </div>
            </div>
        </div>
        <div class="copy-right">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h5>(C) 2019. All Rights Reserved. BookStore W</h5>
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
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/owl.carousel.min.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>