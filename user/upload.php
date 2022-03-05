<?php
include("../other/con.php");
include("../other/function.php");
$api = $_COOKIE['apikey'];
$settings = settings($con,$api);
$user_data = check_login($con,$api);
$user = $user_data['id'];
if( (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443 ){
$secure="https";
} else {
$secure="http";
}
if( $_SERVER['SERVER_NAME'] == "89.186.17.159") {
$adres = "89.186.17.159:8079";
} else {
$adres = $_SERVER['SERVER_NAME'];
}
$base = "$secure://$adres/files/$api/";

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Re:PowerPC - Uploads</title>
<link rel="stylesheet" href="/css/style.css">
<style>
    img {
    width : 256;
    height: auto; 
    }
</style>
<link rel="icon" type="image/x-icon" href="/data/icon.png">
</head>
<body style="background-image: url(../data/<?php echo $settings['wallpaper']; ?>)">
    <center><div class="files">
    <h2><b>Files</b></h2>
<?php
include_once '/other/con.php';
$result = mysqli_query($con,"SELECT * FROM files WHERE id_user=$user EXCEPT select * from files where deleted=1;");
?>
<?php
if (mysqli_num_rows($result) > 0) {
?>
<table border=1>
<tr>
<td>Thumbnail</td>
<td>Filename</td>
<td>New Name</td>
<td> </td>
<td> </td>
</tr>
<?php
$i=0;
while($row = mysqli_fetch_array($result)) {
?>
<tr>
<td><img src="http://<?php print $adres; ?>/thm/<?php if($row["thumbnail"] == "1") {echo $row["newName"]; } else {print "blank.png";} ?>" width="128" height="128" /></td>
<td><?php echo $row["name"]; ?></td>
<td><?php echo $row["newName"]; ?></td>
<td><form action=<?php print $base.$row['newName']; ?>><input id="button" type="submit" value="Download"></form></td>
<td><form method="post" action="/api/delete.php">
        <input type="hidden" name="file" value="<?php echo $row['id']; ?>"/>
        <input type="submit" name="action" value="Remove"/>
      </form></td>
</tr>
<?php
$i++;
}
?>
</table></br>
<input type="button" value="Back to files" onclick="location='/user/files.php'" />
<?php
}
else{
echo "No result found";
}
?>
</center>
</body>
</html>
