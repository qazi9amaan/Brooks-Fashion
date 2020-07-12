<?php 
session_start();
?>
<?php
require_once '/var/www/html/admin/config/config.php';
$operation = filter_input(INPUT_GET, 'operation', FILTER_SANITIZE_STRING); 
$reg_id =filter_input(INPUT_GET, 'reg_id', FILTER_SANITIZE_STRING); 
$redirect = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_STRING)? filter_input(INPUT_GET, 'q', FILTER_SANITIZE_STRING) : "index.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
        $data_to_db = filter_input_array(INPUT_POST);
        $data_to_db['user']=$reg_id;
        $db = getDbInstance();
        $last_id = $db->insert('user_profiles', $data_to_db);
        if ($last_id)
        {
            $_SESSION['success'] = 'Your  Profile is successfully created!';
            $update['account_status'] = "created";
            $_SESSION['user_account_status'] = "created";
            $db->where('id', $reg_id);
            $last = $db->update('auth_user_account', $update);
            if ($last)
            {   
                $_SESSION['user_logged_in'] = TRUE;
			    $_SESSION['public_user_id'] = $reg_id;
                header('location:/'.$redirect);
                 exit;
        }
     }else{
         echo $db->getLastError();
     }
    
    
	
}