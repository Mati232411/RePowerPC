<?php
require_once '../data/require/dblogin.php';
require_once '../data/require/cookieLogin.php';
include("../other/con.php");
include("../other/function.php");
$api = $_COOKIE['apikey'];
$user_data = check_login($con,$api);
$settings = settings($con,$api);
$gif = $settings['gif'];
if( (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443 ){
$secure="Yes";
}
if( $_SERVER['SERVER_NAME'] == "89.186.17.159") {
    $adres = "89.186.17.159:8079";
    } else {
    $adres = $_SERVER['SERVER_NAME'];
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/newstyle.css">
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="../scripts.js"></script>
        <link rel="icon" type="image/x-icon" href="/data/icon.png">
        <title>Re:PowerPC - Home</title>
    </head>
    <body style="background-image: url(../data/<?php echo $settings['wallpaper']; ?>)"><div class="container">
        <div class="middle"><center>
            <b><h2>Re:PowerPC</h2></b>
            <p>The PowerPC is back!!</p></br>
        </center></div>
        <div class="rightbox">
            <p></p>
         Welcome <b><?php echo $user_data['name']; ?></b></br>
       </br>
       <form action="usetting.php"><input id="button" type="submit" value="Settings"></form>
       <form action="/other/logout.php"><input id="button" type="submit" value="Logout"></form>
        <p></p>    
    </div>
        <div class="leftbox">
        <p></p>
                <form action="files.php"><input id="button" type="submit" value="Disk"></form>
                <form action="apiinfo.php"><input id="button" type="submit" value="User info"></form>
                <form action="/changelog.php"><input id="button" type="submit" value="Changelog"></form>
                <form action="about.php"><input id="button" type="submit" value="About this website"></form>
                <?php if($user_data['name'] == "Mateusz Atras") {
			print '<form action="/data/chngupd.php"><input id="button" type="submit" value="Admin tools"></form>';
			print '<form action="/dl"><input id="button" type="submit" value="Download files"></form>';
		}
 		?>
        <p></p>
        </div>
        <div class="secure" <?php if(!empty($secure)){ echo 'style="display:none"'; } ?>>
    <font color="red"><b>You are on NOT SECURE version of this page.</b></font></br>
    <b>If you want to go SSL click here </b><a href="https://<?php print $adres; ?>">SSL</a>
    </div>
    <div class="gif" <?php if($gif == '0'){ echo 'style="display:none"'; } ?>>
    <a href="https://www.debian.org" link><img src="/data/pix/1.gif"></a><p></p><img src="/data/pix/2.gif"><a href="https://landchad.net/"><img src="/data/pix/landchad.gif" alt="LandChad.net"></a>
    </div>
</div></body>
</html>
