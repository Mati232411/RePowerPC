<?php
// Mostly copies of others with changed tables
function check_login($con,$api)
{
$id = $api;
$query = "select * from users where apikey = '$id' limit 1";
$result = mysqli_query($con,$query);
$user_data = mysqli_fetch_assoc($result);
return $user_data;
}
function filelist($con,$user)
{
$id = $user;
$query = "select * from files where id_user = '$id' limit 1";
$result = mysqli_query($con,$query);
$user_data = mysqli_fetch_assoc($result);
return $user_data;
}
function settings($con,$api)
{
$query = "select * from settings where id = '$api' limit 1";
$result = mysqli_query($con,$query);
$user_data = mysqli_fetch_assoc($result);
return $user_data;
}
function wallupd($con,$data,$api,$parameters)
{
	if ( "$parameters" == "custom" ){
	$id = $data;
	$query = "UPDATE settings SET wallpaper = '0' WHERE id='$api';";
	$result = mysqli_query($con,$query);
	$query = "UPDATE settings SET custom_wallpaper = '$id' WHERE id='$api';";
	$result = mysqli_query($con,$query);
	} else if ( "$parameters" == "0" ) {
	$id = $data;
	$query = "UPDATE settings SET wallpaper = '$id' WHERE id='$api';";
	$result = mysqli_query($con,$query);
	$query = "UPDATE settings SET custom_wallpaper = '0' WHERE id='$api';";
	$result = mysqli_query($con,$query);
	}
}
function gifup($con,$data,$api)
{
	$id = $data;
	$query = "UPDATE settings SET gif = '$id' WHERE id='$api';";
	$result = mysqli_query($con,$query);
}
function liteup($con,$data,$api)
{
	$id = $data;
	$query = "UPDATE settings SET lite = '$id' WHERE id='$api';";
	$result = mysqli_query($con,$query);
}
function chngupload($con,$data,$api)
{
	$id = $data;
	$query = "UPDATE settings SET uploads = '$id' WHERE id='$api';";
	$result = mysqli_query($con,$query);
}
function deleteDir($path) {
    return is_file($path) ?
            @unlink($path) :
            array_map(__FUNCTION__, glob($path.'/*')) == @rmdir($path);
}
function admintooldel($con,$id)
{
$query = "select * from users where id = '$id' limit 1";
$result = mysqli_query($con,$query);
$user_data = mysqli_fetch_assoc($result);
return $user_data;
}
function userquery($con,$id)
{
$query = "select * from users where id = '$id' limit 1";
$result = mysqli_query($con,$query);
$user_data = mysqli_fetch_assoc($result);
return $user_data;
}
function setquery($con,$id)
{
$query = "select * from settings where id = '$id' limit 1";
$result = mysqli_query($con,$query);
$user_data = mysqli_fetch_assoc($result);
return $user_data;
}

function updatepfp($con,$api,$data)
{
$query = "UPDATE settings SET pfp = '$data' WHERE id='$api';";
$result = mysqli_query($con,$query);
}
function addpost($con,$user,$text)
{
$date = date('h:i:s d:m:Y'); 
$query = "INSERT INTO community (date, user, text) VALUES ('$date', '$user', '$text')";
$result = mysqli_query($con,$query);
}
function addpostanon($con,$user,$text)
{
$date = date('h:i:s d:m:Y'); 
$query = "INSERT INTO community (date, user, text) VALUES ('$date', '$user', '$text')";
$result = mysqli_query($con,$query);
}
function customgif($con,$data,$api)
{
$query = "UPDATE settings SET custom_gif = '$data' WHERE id='$api';";
$result = mysqli_query($con,$query);
}
function  delcustomgif($con,$api)
{
$query = "UPDATE settings SET custom_gif = '0' WHERE id='$api';";
$result = mysqli_query($con,$query);
}
?>
