<?php // Creates a table with all uploaded files orderd by date from newest to oldest.
$api = $_COOKIE['apikey'];
include("../other/general.php");
$user = $user_data['id']; // a function for checking users data
$base = "http://$adres/files/$api/" // a base adress that is used for downloading files or displaying thumbnails
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
    body {
                background-image: url(<?php echo $wallpaper; ?>);
                <?php echo $parameters; ?>
    }
</style>
<link rel="icon" type="image/x-icon" href="/data/icon.png">
</head>
<body>
    <center><div class="links">
        <p> </p>
    <p> <form action="files.php"><input id="button" type="submit" value="Back to files"></form> </p>
</div>
    <div class="files">
    <h2><b>Files</b></h2>
<?php
include_once '/other/con.php';
$result = mysqli_query($con,"SELECT * FROM files WHERE id_user=$user EXCEPT select * from files where deleted=1 ORDER BY date DESC;");
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
<td><img src="http://<?php print $adres; ?>/thm/<?php if($row["thumbnail"] == "1") {echo $row["newName"]; } else {
echo "blank.png";
} ?>" width="128" height="128" /></td>
<td><?php echo $row["name"]; ?></td>
<td><?php echo $row["newName"]; ?></td>
<td><form method="get" action=<?php print $base.$row['newName']; ?>><input id="button" type="submit" value="Download"></form></td>
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
<?php
}
else{
echo "No result found";
}
?>
</center>
</body>
</html>
