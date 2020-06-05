
<!-- ADD REMEMBER ME -->
<?php
require_once  '/var/www/html/admin/config/config.php';
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
	$username = filter_input(INPUT_POST, 'phone_number');
	$password = filter_input(INPUT_POST, 'password');
	$remember = filter_input(INPUT_POST, 'remember');

	// Get DB instance.
	$db = getDbInstance();

	$db->where('phone_number', $username);
	$row = $db->getOne('auth_user_account');

	if ($db->count >= 1)
    {
		$db_password = $row['password'];
		$user_id = $row['id'];

		if (password_verify($password, $db_password))
        {
			$_SESSION['user_logged_in'] = TRUE;
			$_SESSION['public_user_id'] = $row['id'];
			$_SESSION['user_account_status']=$row['account_status'];
			
			if ($remember)
            {
				$series_id = randomString(16);
				$remember_token = getSecureRandomToken(20);
				$encryted_remember_token = password_hash($remember_token,PASSWORD_DEFAULT);

				$expiry_time = date('Y-m-d H:i:s', strtotime(' + 30 days'));
				$expires = strtotime($expiry_time);

				setcookie('series_id', $series_id, $expires, '/');
				setcookie('remember_token', $remember_token, $expires, '/');

				$db = getDbInstance();
				$db->where ('id',$user_id);

				$update_remember = array(
					'series_id'=> $series_id,
					'remember_token' => $encryted_remember_token,
					'expires' =>$expiry_time
				);
				$db->update('auth_user_account', $update_remember);
			}

			if(isset($_POST['q']))
			{
				if($row['account_status']=='new'){
					header('location: /users/account-setup.php?reg_id='.$_SESSION['public_user_id'].'&user='. $username.'&operation=create&q='.$_POST['q']);
					exit;
				}
				header('Location:/'.$_POST['q']);
				exit;
			}else{
				if($row['account_status']=='new'){
					header('location: /users/account-setup.php?reg_id='.$_SESSION['public_user_id'].'&user='. $username.'&operation=create');
					exit;
				}
				header('Location: /users');
				exit;
			}
		}
        else
        {
			$_SESSION['login_failure'] = 'Invalid user name or password';
			header('Location: /login.php');
		}
		exit;
	}
    else
    {
		$_SESSION['login_failure'] = 'Invalid user name or password';
		header('Location: /login.php');
		exit;
	}
}
else
{
	die('Method Not allowed');
}
