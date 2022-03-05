<?php
require_once '../data/require/dblogin.php';
include("../other/con.php");
include("../other/function.php");
$api = $_COOKIE['apikey'];
$user_data = check_login($con,$api);
$settings = settings($con,$api);

if( (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443 ){
$secure="https";
} else {
$secure="http";
}
if( $_SERVER['SERVER_NAME'] == "repowerpc.warszwa.pl") {
    $adres = "repowerpc.warszwa.pl:8079";
    } else {
    $adres = $_SERVER['SERVER_NAME'];
    }
// check if the user is allowed to delete the file
if(!empty($_POST['key'])){
    $key=$_POST['key'];
}else if(!empty($_COOKIE['apikey'])){
    $key=$_COOKIE['apikey'];
}else{
    die('{"success": false, "msg": "Please provide an API key"}');
}
if(empty($_POST['file'])){
    die('{success": false, "msg": "Please select a file to delete"}');
}
$user=$db->prepare('SELECT id,fileCount,actSize,apikey,allowed FROM users WHERE apikey=?');
$user->execute([$key]);
$user=$user->fetch();
if(empty($user)){
    die('{"success": false, "msg": "wrong API key"}');
}
if($user['allowed']==0){
    die('{"success": false, "msg": "This user is not allowed to delete"}');
}
$file=$db->prepare('SELECT id, size, newName, thumbnail, deleted, id_user FROM files WHERE id=?');
$file->execute([$_POST['file']]);
$file=$file->fetch();
if(empty($file)||$file['deleted']!=0||$file['id_user']!==$user['id']){
    die('{"success": false, "msg": "This file does not exist, or it\'s not yours."}');
}

// delete the file and update the database
$user['fileCount']--;
$user['actSize']-=$file['size'];
$qu=$db->prepare('UPDATE users SET fileCount=?, actSize=? WHERE id=?');
$qf=$db->prepare('UPDATE files SET deleted=1 WHERE id=?');
$qu->execute([$user['fileCount'], $user['actSize'], $user['id']]);
$qf->execute([$file['id']]);
$path1 = $conf['path'];
$name = $file['newName'];
$final = "$path1$api/$name";
unlink($final);
if($file['thumbnail']==1) unlink($conf['thumbnailsPath'].$file['newName']);

// end
echo '{"success": true}';
if($settings['uploads'] == 'PHP') {
    $home="upload.php";
} else {
    $home="uploads.html";
}
header("Location: /user/$home");
?>
