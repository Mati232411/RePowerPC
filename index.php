<?php 
if(empty($_COOKIE['apikey'])){
    require_once 'user/index.html';
}else{
    header("Location: /user/account.php");
}
?>
