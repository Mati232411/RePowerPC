<?php
$api = $_COOKIE['apikey'];
require_once '../data/require/dblogin.php';
require_once '../data/require/cookieLogin.php';
include("../other/general.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/newstyle.css">
                <link rel="icon" type="image/x-icon" href="/data/icon.png">
        <title>Re:PowerPC - Home</title>
        <style>
            body {
                background-image: url(<?php echo $wallpaper; ?>);
                <?php echo $parameters; ?>
            }
        </style>
    </head>
    <body><div class="container">
        <div class="middle"><center>
            <b><h2>Re:PowerPC</h2></b>
            <p>The PowerPC is back!!</p></br>
        </center></div>
        <div class="rightbox">
	    <p></p>
	<img src="http://<?php echo $adres; ?>/pfp/<?php echo $settings['pfp']; ?>" height="96" width="96"></br>

	<p>Welcome <b><?php echo $user_data['name']; ?></b></p>
    
       <form action="usetting.php"><input id="button" type="submit" value="Settings"></form>
       <form action="/other/logout.php"><input id="button" type="submit" value="Logout"></form>
        <p></p>    
    </div>
        <div class="leftbox">
        <p></p>
                <form action="files.php"><input id="button" type="submit" value="Disk"></form>
 <form action="posts.php"><input id="button" type="submit" value="Community"></form>
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
    <a href="https://www.debian.org" link><img src="/data/pix/1.gif"></a>
<?php if( $settings['custom_gif'] != "0" ) {
$customgif = $settings['custom_gif'];
echo "<img src=http://$adres/pfp/$customgif >";
}
?>
<p></p><img src="/data/pix/2.gif"><a href="https://landchad.net/"><img src="/data/pix/landchad.gif" alt="LandChad.net"></a>
    </div>
</div></body>
</html>
