<?php 

require_once  '../admin/config/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$data_to_db = filter_input_array(INPUT_POST);
	$data_to_db['payment_type'] = 'not-yet';
$data_to_db['order_status'] = 'accepted';
	$data_to_db['ordered_at'] = date('Y-m-d H:i:s');
	if(!$data_to_db['owner']){
		$data_to_db['owner']=null;
	} 

	$db = getDbInstance();
	$last_id = $db->insert('orders', $data_to_db);
	if($last_id){
		header('Location: helper/complete-payment.php?order_id='.$last_id.'&user='.$data_to_db['user_id']);
        exit;
    }else{
    	echo $db->getLastError();
    }
}else{
	header('Location:404.php ');
}

?>