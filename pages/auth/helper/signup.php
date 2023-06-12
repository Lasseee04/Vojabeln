<?php
$name = $_POST['name'];
$password = $_POST['password'];

session_start();
$_SESSION['name'] = $name;

header('LOCATION ../../index.html');
exit();
