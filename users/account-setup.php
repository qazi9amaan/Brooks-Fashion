<?php include '../includes/header.php' ?>

<?php

require_once '/var/www/html/admin/config/config.php';
$phone_number = filter_input(INPUT_GET, 'user', FILTER_SANITIZE_STRING);
$operation = filter_input(INPUT_GET, 'operation', FILTER_SANITIZE_STRING); 
$reg_id =filter_input(INPUT_GET, 'reg_id', FILTER_SANITIZE_STRING); 

if(!isset($reg_id))
{
    header('location: index.php');
}

($operation == 'edit') ? $edit = true : $edit = false;
// Serve POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

    if ($operation)
    {
        $data_to_db = filter_input_array(INPUT_POST);
        // Check whether the user name already exists
    
        $data_to_db['user']=$reg_id;
        $db = getDbInstance();
        $last_id = $db->insert('user_profiles', $data_to_db);

        if ($last_id)
        {
            $_SESSION['success'] = 'Your  Profile is successfully created!';
            $update['account_status'] = "created";
            $_SESSION['user_account_status'] = "created";
            $db->where('id', $reg_id);
            $db->update('auth_user_account', $update);
            $_SESSION['user_logged_in'] = TRUE;
			$_SESSION['public_user_id'] = $reg_id;


            if(isset($_GET['q']))
            {
                header('location:/'.$_GET['q']);

            }else{
                header('location: index.php');
            }
            exit;
        }
    }
    
	
}
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
            
				
                <form  method="post">
                    <?php include 'forms/user_setup.php' ?>
                </form>
            </div>
        </div>
    </section>
    <?php include '../includes/footer.php'; ?>