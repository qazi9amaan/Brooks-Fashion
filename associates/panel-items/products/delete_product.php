<?php 
session_start();
require_once '/var/www/html/admin/config/config.php';
require_once '/var/www/html/associates/includes/auth_validate.php';

$del_id = filter_input(INPUT_POST, 'del_id');
if ($del_id && $_SERVER['REQUEST_METHOD'] == 'POST') 
{

	
    $product_id = $del_id;

    $db = getDbInstance();
    $db->where('id', $product_id);
    $status = $db->delete('associate_products');
    
    if ($status) 
    {
        $_SESSION['info'] = "Product deleted successfully!";
        header('location: products.php');
        exit;
    }
    else
    {
    	$_SESSION['failure'] = "Unable to delete product";
    	header('location: products.php');
        exit;

    }
    
}