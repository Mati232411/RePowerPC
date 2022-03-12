<?php
include("../con.php");
include("../function.php");
header('Content-Type: application/json');
require_once '../../data/require/dblogin.php';
// check if user is allowed to upload
if(!empty($_POST['key'])){
    $key=$_POST['key'];
}else if(!empty($_COOKIE['apikey'])){
    $key=$_COOKIE['apikey'];
}else{
    die('{"success": false, "msg": "Please provide an API key"}');
}
$file=reset($_FILES);
if(empty($file['size'])){
    die('{"success": false, "msg": "Please provide a file"}');
}

$user=$db->prepare('SELECT id, maxSize, fileCount, fileCountWDel, actSize, allowed FROM users WHERE apikey=?');
$user->execute([$key]);
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


// Hash the file to prevent uploading the same file multiple times, and generate a file name
// If an identical file exists, a new link is generated but points to the same file
// also find file type
$fileType=mime_content_type($file['tmp_name']);
$uploadPath="/srv/www/pfp/";
$name = $_FILES["file"]["name"];
$ext = end((explode(".", $name)));
if($fileType == "image/jpeg" || $fileType == "image/png" || $fileType == "image/gif" || $fileType == "image/jpg" ) {
    
	$filename="$key.$ext";
    move_uploaded_file($file['tmp_name'], $uploadPath.$filename);
    $api=$key;
    $data=$filename;
    updatepfp($con,$api,$data);
    header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
    header("Location: /");
    } else {  
    header("Location: /user/usetting.php");
}
?>
