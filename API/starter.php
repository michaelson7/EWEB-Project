<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "eweb";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$connection  = mysqli_connect($servername, $username, $password)
    or die("Error");

mysqli_select_db($connection, $database);

//defaults
define('IMG_PATH', '../assets/img/');
define('PDF_PATH', '../assets/pdf/');

define('GET_IMG', 'assets/img/');
define('GET_PDF', 'assets/pdf/');
