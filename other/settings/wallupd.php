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
if($fileType == "image/jpeg" || $fileType == "image/png" || $fileType == "image/gif" || $fileType == "image/jpg" ) {
    $oldfile = $settings['custom_wallpaper']; // Old name of a wallpaper
    unlink("/srv/www/pfp/$oldfile"); // Remove old wallpaper
	$filename="wall_$api.$ext"; // Filename which is wall_"users apikey"."extension"
    $data=$filename; // New name for a function
    $parameters = "custom"; // Parameter telling the function that there is a custom wallpaper
    wallupd($con,$data,$api,$parameters);
    move_uploaded_file($file['tmp_name'], $uploadPath.$filename);
    header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
    header("Location: /");
    } else {
        header("Location: /user/usetting.php");

}
?>
