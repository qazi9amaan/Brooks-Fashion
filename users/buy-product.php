<?php 

require_once  '../admin/config/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$data_to_db = filter_input_array(INPUT_POST);
	$data_to_db['payment_type'] = 'not-yet';
	$data_to_db['ordered_at'] = date('Y-m-d H:i:s');
	$db = getDbInstance();
	$last_id = $db->insert('orders', $data_to_db);
	if($last_id){
		header('Location: /users?success=Your order is successfully submitted!');
        exit;
    }else{
    	echo $db->getLastError();
    }
}else{
	header('Location:404.php ');
}

?>