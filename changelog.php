<?php
include("other/con.php");
include("other/function.php");
if(empty($_COOKIE['apikey'])) {
    $backg = 'background-image: url(/data/1.ong);';
} else {
    $api = $_COOKIE['apikey'];
    $settings = settings($con,$api);
    $walld = $api = $settings['wallpaper'];
    $backg = "background-image: url(/data/$walld);";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Re:PowerPC - Uploads Lite</title>
<link rel="stylesheet" href="/css/style.css">
<style>
    img {
    width : 256;
    height: auto; 
    }
    body {
        <?php print $backg; ?>
    }
</style>
<link rel="icon" type="image/x-icon" href="/data/icon.png">
</head>
<body>
    <center><div class="files">
    <h2><b>Changelog</b></h2>
<?php
include_once '/other/con.php';
$result = mysqli_query($con,"SELECT * FROM chng");
?>
<?php
if (mysqli_num_rows($result) > 0) {
?>
<table border=1>
<tr>
<td>Change</td>
<td>Date</td>
</tr>
<?php
$i=0;
while($row = mysqli_fetch_array($result)) {
?>
<tr>
<td><?php echo $row["text"]; ?></td>
<td><?php echo $row["date"]; ?></td>
</tr>
<?php
$i++;
}
?>
</table></br>
<form action="/"><button>Back</button></form>
<?php
}
else{
echo "No result found";
}
?>
</center>
</body>
</html>
