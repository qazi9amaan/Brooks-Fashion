<?php 
session_start();
require_once '/var/www/html/admin/config/config.php';
require_once '/var/www/html/associates/includes/auth_validate.php';

$del_id = filter_input(INPUT_POST, 'del_id');
if ($del_id && $_SERVER['REQUEST_METHOD'] == 'POST') 
{

	
    $product_id = $del_id;

    $data_to_db['product_status'] = "Rechecking";

    $db = getDbInstance();
    $db->where('id', $product_id);
    $status = $db->update('associate_products', $data_to_db);
   
    if ($status) 
    {
        $_SESSION['info'] = "Product resubmitted successfully!";

        $notification['notification_type'] = "product_resubmitted";
        $notification['id'] = $product_id;

        $db = getDbInstance();
        $db->where('id', $product_id);
        $db->delete('admin_notifications');

        $last_id = $db->insert('admin_notifications', $notification);


        if ($last_id) {
        header('location: products.php');
        exit;
        } else
    {
    	$_SESSION['failure'] = "Unable to resubmit product";
    	header('location: products.php');
        exit;

    }
    }
    else
    {
    	$_SESSION['failure'] = "Unable to resubmit product";
    	header('location: products.php');
        exit;

    }
    
}