<?php

$dbhost = "localhost";
$dbuser = "fmc";
$dbpass = "";
$dbname = "fmc";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{

	die("failed to connect!");
}
?>
