<?php

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
function wallupd($con,$data,$api)
{
	$id = $data;
	$query = "UPDATE settings SET wallpaper = '$id' WHERE id='$api';";
	$result = mysqli_query($con,$query);
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
function updatepfp($con,$data)
{
$query = "UPDATE settings SET pfp = '$data' WHERE id='$api';";
$result = mysqli_query($con,$query);
$user_data = mysqli_fetch_assoc($result);

}
?>