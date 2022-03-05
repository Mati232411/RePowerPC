<?php
header('Content-Type: application/json');
require_once '../data/require/dblogin.php';

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
$uploadPath="/var/www/srv/files/{$key}/";
$thmbnl=0;
$fileType=mime_content_type($file['tmp_name']);
$hash=hash_file('md5', $file['tmp_name']);
if(strrpos($file['name'], '.')==false||strlen($file['name'])-strrpos($file['name'], '.')>7){
    do{
        $filename=substr(str_shuffle('azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN'), 0, 5);
    }while(file_exists($uploadPath.$filename));
}else{
    do{
        $filename=substr(str_shuffle('azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN'), 0, 5).substr($file['name'], strrpos($file['name'], '.'));
    }while(file_exists($uploadPath.$filename));
}
$qExists=$db->prepare('SELECT id, newName, thumbnail FROM files WHERE hash=? AND deleted=0');
$qExists->execute([$hash]);
$qExists=$qExists->fetch();
if(empty($qExists)){
    if(!$fileType == "image/jpeg" || !$fileType == "image/png" || !$fileType == "image/gif" ) {
       header("Location: /user/usetting.php");
    }
    move_uploaded_file($file['tmp_name'], $uploadPath.$filename);
}
echo '{"success":true,"url":"'.$conf['url'].$filename.'"}';
header("Location: /user/usetting.php");
?>