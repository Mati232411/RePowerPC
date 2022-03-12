<?php
// General config
$uploadlocation="/srv/www/files/"; 
$thumblocation="/srv/www/thm/"; // Where to save


// Database config
$dbhost = "localhost";
$dbuser = "power";
$dbpass = "";
$dbname = "fmc";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{

	die("failed to connect!");
}
?>
