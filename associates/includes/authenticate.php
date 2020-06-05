<?php
require_once '/var/www/html/admin/config/config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
	$username = filter_input(INPUT_POST, 'email');
	$password = filter_input(INPUT_POST, 'password');
	$remember = filter_input(INPUT_POST, 'remember');
    
	// Get DB instance.
	$db = getDbInstance();

	$db->where('email_address', $username);
	$row = $db->getOne('associate_accounts');

	if ($db->count >= 1)
    {
		$db_password = $row['password'];
		$user_id = $row['id'];

		if (password_verify($password, $db_password))
        {
			$_SESSION['associate_logged_in'] = TRUE;
            $_SESSION['associate_user_id'] = $row['id'];

			if ($remember)
            {
				$series_id = randomString(16);
				$remember_token = getSecureRandomToken(20);
				$encryted_remember_token = password_hash($remember_token,PASSWORD_DEFAULT);


				setcookie('associate_series_id', $series_id, $expires, '/');
				setcookie('associate_remember_token', $remember_token, $expires, '/');

				$db = getDbInstance();
				$db->where ('id',$user_id);

				$update_remember = array(
					'series_id'=> $series_id,
					'remember_token' => $encryted_remember_token,
				);
				$db->update('associate_accounts', $update_remember);
			}
			// Authentication successfull redirect user
			header('Location: ../account.php');
		}
        else
        {
			$_SESSION['login_failure'] = 'Invalid user name or password';
			header('Location: ../login.php');
		}
		exit;
	}
    else
    {
		$_SESSION['login_failure'] = 'Invalid user name or password';
		header('Location: ../login.php');
		exit;
	}
}
else
{
	die('Method Not allowed');
}
