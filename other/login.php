<?php 
include("../other/con.php");
include("../other/function.php");
// Nginx handles brute-force attacks, not this script or any other
require_once '../data/require/dblogin.php';
// Verify login informations
$q=$db->prepare('SELECT id, pwd, apikey FROM users WHERE name=?');
$q->execute([$_POST['name']]);
$q=$q->fetch();
if(empty($q['pwd'])){
    die('Wrong username');
}
if(password_verify($_POST['pwd'], $q['pwd'])==false){
    die('Wrong password');
}
// Setting "expire" to 0 so the cookie is deletted when the browser closes
if( (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443 ){
setcookie('apikey', $q['apikey'], 0, '/', null, true);
} else {
    setcookie('apikey', $q['apikey'], 0, '/', null);
}
header("Location: /user/account.php");
exit;
?>