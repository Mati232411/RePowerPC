<?php
include("../con.php");
include("../function.php");
require_once '../../data/require/dblogin.php';
// check if user is allowed to upload
if(!empty($_POST['key'])){
    $api=$_POST['key'];
}else if(!empty($_COOKIE['apikey'])){
    $api=$_COOKIE['apikey'];
}else{
    die('{"success": false, "msg": "Please provide an API key"}');
}
$file=reset($_FILES);
if(empty($file['size'])){
    die('{"success": false, "msg": "Please provide a file"}');
}
$user=$db->prepare('SELECT id, maxSize, fileCount, fileCountWDel, actSize, allowed FROM users WHERE apikey=?');
$user->execute([$api]);
$user=$user->fetch();
if(empty($user)){
    die('{"success": false, "msg": "wrong API key"}');
}
if($user['allowed']==0){
    die('{"success": false, "msg": "This user is not allowed to upload"}');
}
if($file['size']>$user['maxSize']){
    die('{"success": false, "msg": "File too large"}');
}
$settings = settings($con,$api);
$fileType=mime_content_type($file['tmp_name']);
$uploadPath="/srv/www/pfp/";
$name = $_FILES["file"]["name"];
$ext = end((explode(".", $name)));
if($fileType != "image/gif" ) {
       header("Location: /user/usetting.php");
    } else {
    $oldfile = $settings['custom_gif']; // Old name of a wallpaper
    unlink("/srv/www/pfp/$oldfile"); // Remove old wallpaper
	$filename="gif_$api.$ext"; // Filename which is wall_"users apikey"."extension"
    $data=$filename; // New name for a function
    customgif($con,$data,$api);
    move_uploaded_file($file['tmp_name'], $uploadPath.$filename);
}
header("Location: /");
?>
