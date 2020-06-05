<?php
require_once '/var/www/html/admin/config/config.php';
session_start();
session_destroy();

header('Location:/login.php');
exit;

 ?>