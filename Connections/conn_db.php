<?php
$dsn = "mysql:host=localhost;dbname=expstore;charset=utf8";
$user = "sales";
$password = "123";
$link = new PDO($dsn, $user, $password);
date_default_timezone_set("Asia/Taipei");
?>