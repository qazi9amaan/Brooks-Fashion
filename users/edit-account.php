

<?php
session_start();

require_once '/var/www/html/admin/config/config.php';
$db = getDbInstance();
$operation = filter_input(INPUT_GET, 'operation', FILTER_SANITIZE_STRING); 
$reg_id = $_SESSION['public_user_id'];

($operation == 'edit') ? $edit = true : $edit = false;


if ($edit)
{
    $db->where('user', $reg_id);
    // Get data to pre-populate the form.
    $customer = $db->getOne('user_profiles');
    
}

if ($edit)
{
    $db->where('id', $reg_id);
    // Get data to pre-populate the form.
    $user_settings = $db->getOne('auth_user_account');
}

// Serve POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if(isset($_POST['password']))
    {   
        $db2 = getDbInstance();

        $data_to_db = filter_input_array(INPUT_POST);
        $data_to_db['password'] = password_hash($data_to_db['password'], PASSWORD_DEFAULT);

      
            $db2->where('id', $reg_id);
            $stat = $db2->update('auth_user_account', $data_to_db);
        
        
        if ($stat)
        {
            $_SESSION['success'] = 'Account updated successfully!';
            header('Location:index.php');
            exit();
        }
    }else{
        $data_to_db = filter_input_array(INPUT_POST);
        if($customer == null)
        {   $data_to_db['user'] = $reg_id;
            $stat = $db->insert('user_profiles', $data_to_db);
        }else{
            $data_to_db['user'] = $reg_id;
            $db->where('user', $reg_id);
            $stat = $db->update('user_profiles', $data_to_db);
        }
    if ($stat)
    {
        if(isset($_GET['q'])){
            header('Location:'. $_GET['q'] );
            exit();
        }
        $_SESSION['success'] = 'Account updated successfully!';
        header('Location: edit-account.php?operation=edit');
        exit();
    }
}
}

// If edit variable is set, we are performing the update operation.

?>

<?php include 'includes/header.php' ?>

<div class="col mt-md-2">
    <div class="container-fluid m-0 p-0">
        <div class="row p-0">
            <div class="col-md-12 p-0 bg-light">
                <div class="breadcrumb mb-0">
                <a class="breadcrumb-item text-capitalize" href="index.php"><?php echo $user_full_name; ?></a>
                    <span class="breadcrumb-item active">Settings</span>
                </div>
            </div>

            <div class="col-12 p-0 mt-3 ">
                <div class="d-flex mx-4 mt-2   pb-0 mb-0 align-items-center justify-content-between">
                    <section  class="static about-sec mb-0">
                        <div class="container-fluid">
                            <h1   class="border-bottom py-4">Account Settings</h1>
                            <p class="text-justify">Dear user, please provide the details where you want the shippment
                        to be placed, you can edit it anytime. Please feel free to contact us if you face any problem.</p>
                        <div class="form">
                            <form  method="post">
                                 <?php include 'forms/user_setup.php' ?>
                            </form>
                        </div>
                        </div>
                    </section>
                    
                </div>
            <div class="d-flex mx-4 mt-0  border-bottom pt-0 pb-2 align-items-center justify-content-between">
                    <section class="static about-sec pt-0 mb-0">
                        <div class="container-fluid">
                            <h1 id="privacy-settings" class="border-bottom py-4">Privacy Settings</h1>
                            <p class="text-justify">Dear user, please find your privacy settings here, change your account's password now, donot share any of it to anyone.</p>
                        <div class="form">
                            <form  method="post">
                            <div class="row">
                                
                                <div class="col-md-4">
                                    <input type="password" name="password"   placeholder="Password" required>
                                    <span class="required-star">*</span>
                                </div>
                                <div class="col-md-4">
                                    <input type="password" placeholder="Confirm Password" required>
                                    <span class="required-star">*</span>
                                </div>
                                <div class="col-md-4 ">
                                    <button  type="submit" class="btn black">Update </button>
                                </div>
                                </div>
                            </form>
                        </div>
                        </div>
                    </section>
                    
                </div>
                </div>

        </div>
    </div>
</div>
<?php include 'includes/footer.php' ?>
