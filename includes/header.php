<?php 
session_start();
?>

<!DOCTYPE php>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Brook's Fashion</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#03a6f3">

	<?php  if(substr(CURRENT_PAGE,0,18) != 'product-single.php'){ ?>
	<meta name="description" content="Brooks Fashion deals in all kind of branded products.This is also the best platform to boost your online business">
	<meta name="keywords" content="online store,online business,ecom,ecommerce website,
shopping cart,e business,what is ecommerce,ecomerce,Fashion,Kashmir ecom,Brooks,Affiliates,affiliate marketing,online money,how to, free shopping,branded clothes, clothing,earning,earning">
<?php  }else{?>
<div class="meta" > </div>
<?php } ?>
	<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="PUBLIC">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/css/styles.css">
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-171025214-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-171025214-2');
</script>

    
</head>
<style>
.progress-line, .progress-line:before {
  height: 5px;
  width: 100%;
  margin: 0;
}
.progress-line {
  background-color: #fff3cd;
  display: -webkit-flex;
  display: flex;
}
.progress-line:before {
  background-color: #ff9700;
  content: '';
  -webkit-animation: running-progress 2s cubic-bezier(0.4, 0, 0.2, 1) infinite;
  animation: running-progress 2s cubic-bezier(0.4, 0, 0.2, 1) infinite;
}
@-webkit-keyframes running-progress {
  0% { margin-left: 0px; margin-right: 100%; }
  50% { margin-left: 25%; margin-right: 0%; }
  100% { margin-left: 100%; margin-right: 0; }
}
@keyframes running-progress {
  0% { margin-left: 0px; margin-right: 100%; }
  50% { margin-left: 25%; margin-right: 0%; }
  100% { margin-left: 100%; margin-right: 0; }
}

</style>
<body>

<div id="loading-bar" class="container-fluid m-0 p-0">
    <div class="fixed-top progress-line"></div>
</div>

<header  style="margin-bottom:-25px;">
        
        <div class="main-menu">
            
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand" href="index.php">
                    <h1 class="display-5 py-3"><span style='color:#ff9700; letter-spacing: 0.1em;font-weight:400'>Bro</span><span style='color:#2d2d2d; letter-spacing: 0.1em;font-weight:400'>ok's</span></h1>
                    </a>
                   
                    
                    <button class="navbar-toggler ml-0 " type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>


                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                            <li class="navbar-item ">
                                <a href="/index.php" class="nav-link">Home</a>
                            </li>
                            <li class="navbar-item">
                                <a href="/shop.php" class="nav-link">Shop</a>
                            </li>
                            <li class="navbar-item">
                                <a href="/about.php" class="nav-link">About</a>
                            </li>
                            <li class="navbar-item">
                                <a href="/faq.php" class="nav-link">FAQ</a>
                            </li>
 <li class="navbar-item">
                                 <a href="/associates/" class="nav-link">Affiliates</a>
                            </li>                            
                            <li class="navbar-item">
                                <?php if(isset($_SESSION['public_user_id'])){?>
                                <a href="/users/index.php" class="nav-link">Account</a>
                                <?php }else{ ?>
                                    <a href="/login.php" class="nav-link">Login</a>
                                <?php }?>


                            </li>
                        </ul>
                        <form action ="/search.php" method="GET" class="form-inline my-2 my-lg-0">
                            <input id="searchbar" class="form-control mr-sm-2"  name="search_str" value="<?php echo htmlspecialchars($search_str, ENT_QUOTES, 'UTF-8'); ?>" type="search" placeholder="Search here..." aria-label="Search">
                            <span class="fa fa-search"></span>
  
                        </form>

                    </div>
                </nav>
            </div>
        </div>
    </header>

	<script>

$(document).ready(function() {

$("#loading-bar").delay(1000).fadeOut("slow");

})
	</script>
