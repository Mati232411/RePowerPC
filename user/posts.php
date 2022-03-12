<?php
include("../other/con.php");
include("../other/function.php");
if(empty($_COOKIE['apikey'])) {
$loggedin="0";
    $wallpaper = 'background-image: url(/data/1.png);';
} else {
$loggedin="1";
$api = $_COOKIE['apikey'];
include("../other/general.php");
$user = $user_data['id'];
}
if ($_POST['postbtn']) {
 	if( $loggedin == "1" ) { 
	$text = $_POST['post'];
	$user =  $user_data['id'];
	addpost($con,$user,$text);
	$_POST = array();
	} else { 
	$user = $loggedin;
        $text = $_POST['post'];
	echo $user;
	addpostanon($con,$user,$text);
	$_POST = array();
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Re:PowerPC - Community</title>
<link rel="stylesheet" href="/css/style.css">
<link rel="icon" type="image/x-icon" href="/data/icon.png">
<style>
            body {
                background-image: url(<?php echo $wallpaper; ?>);
                <?php echo $parameters; ?>
            }
	   input[type=text] {
		height:100px;
		width:300px;
	}
</style>
</head>
<body>
    <center><div class="files">
    <h2><b>Community</b></h2>
<p>Write your post here and submit it!</p>
<form id="button" method="post">
                <input id="text" type="text" name="post">
                <input id="button" type="submit" name="postbtn" value="Submit"><br><br>
</form>
<?php
$result = mysqli_query($con,"SELECT * FROM community ORDER BY date DESC");
?>
<?php
if (mysqli_num_rows($result) > 0) {
?>
<table border=1>
<tr>
<td>User</td>
<td>Date</td>
<td></td>
</tr>
<?php
$i=0;
while($row = mysqli_fetch_array($result)) {
?>
<tr>
<td>
<?php $id = $row['user'];
	if ( $row['user'] == "0") {
	$username = "Anonymous";
	echo "<img src=http://{$adres}/pfp/blank.png height='64' width='64'/>";
	} else {
        $userquery = userquery($con, $id);
        $username = $userquery['name'];
	$set = setquery($con, $userquery['apikey']);
	echo "<img src=http://{$adres}/pfp/{$set['pfp']} height='64' width='64'/>"; 
	} ?>
<?php echo $username; ?></td>
<td><?php echo $row["date"]; ?></td>
<td><?php echo $row["text"]; ?></td>
</tr>
<?php
$i++;
}
?>
</table></br>
<?php
}
else{
echo "Huh empty?";
}
?>
<form action="/"><input id="button" type="submit" value="Back to home"></form>

</center>
</body>
</html>
