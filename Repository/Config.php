<?php
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','password');
define('DB_NAME','crud');
session_start();
$db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

