<?php 
session_start();
require_once '/var/www/html/admin/config/config.php';

$id = filter_input(INPUT_POST, 'order_id');
$db = getDbInstance();
if ($id && $_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $db->where('order_id', $id);
    $data_to_db['order_status'] = 'accepted';
    $data_to_db['order_updated_on'] =date('Y-m-d H:i:s');
    $data_to_db['order_status_reason'] = "Your order has been accepted!";
    $stat=$db->update('orders', $data_to_db);
    
    if($stat){
        $db->where('order_id',$id)->delete('order_notifcations');
        $notification['notification_type']="assocaite_order_accepted";
        $notification['id']=$id;
        $last_id = $db->insert('admin_notifications', $notification);
        
        if($last_id){
            $_SESSION['success'] = "Order accepted accepted!";
            header('Location:accepted_orders.php');
            exit;
        }
    }
   
    
}