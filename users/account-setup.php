<?php include '../includes/header.php' ?>
<script>
document.getElementById('loading-bar').innerHTML="";
</script>

<?php
require_once '/var/www/html/admin/config/config.php';
$phone_number = filter_input(INPUT_GET, 'user', FILTER_SANITIZE_STRING);
$operation = filter_input(INPUT_GET, 'operation', FILTER_SANITIZE_STRING); 
$reg_id =filter_input(INPUT_GET, 'reg_id', FILTER_SANITIZE_STRING); 


$edit=false;

?>




    <div class="breadcrumb">
        <div class="container">
             <a class="breadcrumb-item" href="#">Home</a>
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
                <form action="helper/set-account.php?reg_id=<?php echo @$_GET['reg_id']?>&operation=<?php echo @$_GET['operation']?>&q=<?php echo @$_GET['q']?>"  method="post">
                    <?php include 'forms/user_setup.php' ?>
                </form>
            </div>
        </div>
    </section>
    <?php include '/var/www/html/includes/footer.php'; ?>