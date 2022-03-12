<?php 
include("con.php");
include("function.php");
// Nginx handles brute-force attacks, not this script or any other
// Verify login informations
$uid = $_POST['name'];
$query = "select * from users where name = '$uid'";
$result = mysqli_query($con,$query);
$data = mysqli_fetch_assoc($result);
if(empty($data['pwd'])){
    die('Wrong username');
}
if(password_verify($_POST['pwd'], $data['pwd'])==false){
    die('Wrong password');
}
// Setting "expire" to 0 so the cookie is deletted when the browser closes
if( (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443 ){
setcookie('apikey', $data['apikey'], 0, '/', null, true);
} else {
    setcookie('apikey', $data['apikey'], 0, '/', null);
}
header("Location: /");
exit;
?>
