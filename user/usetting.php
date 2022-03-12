<?php
$api = $_COOKIE['apikey'];
include("../other/general.php");
if($_SERVER['REQUEST_METHOD'] == "POST")
	{
        if ($_POST['walld'])
    {
        $oldfile = $settings['custom_wallpaper']; // Old custom name of a wallpaper
        unlink("/srv/www/pfp/$oldfile"); // Remove old custom wallpaper
		$dataz = $_POST['walld']; // Temporary name of wallpaper
		$data = "$dataz.png"; // Final name of wallpaper
        $parameters = "0"; // See wallupd.php
		wallupd($con,$data,$api,$parameters);
        header("Location: /");
    } elseif ($_POST['GIF']) { // Checks if post is GIF button and if to disable or enable gifs.
        if($_POST['GIF'] == "ON") {
            $data = "1";
        } else {
            $data = "0";
        }
        print $data; 
		gifup($con,$data,$api); // Function in functions.php to change gif status in SQL Database
        header("Location: /");
    } elseif ($_POST['LITE']) {
        if($_POST['LITE'] == "ON") {
            $data = "1";
        } else {
            $data = "0";
        }
		liteup($con,$data,$api); // Currently not used becuase i am fixing it but it is responsible to for changing all buttons to links.
        header("Location: /");
    } elseif ($_POST['UPLVER']) {
        $data = $_POST['UPLVER'];
		chngupload($con,$data,$api); // Change between JS and PHP version of uploads. It's here as a backup but i am trying to get rid of JS version.
        header("Location: /");
    } 
}
if ( $settings['wallpaper'] == "0" ) { // Enforce custom Wallpaper
$wall_custom = "Custom";
} else {
$wall_custom = $settings['wallpaper'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Re:PowerPC - User Settings</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="icon" type="image/x-icon" href="/data/icon.png">
    <style>
            body {
                background-image: url(<?php echo $wallpaper; ?>);
                <?php echo $parameters; ?>
            }
    </style>
</head>
<body>
    <div class="settings">
        <center>
            <b><h1>Settings</h1></b>
            <br>
	    <b><h4>Profile Picture</h4></b>
	    <p>Choose an image and set it up as your profile picture (in future this will be for posting text but right now its in beta)</p>
	    <form action="/other/settings/pfpupd.php" method="post" enctype="multipart/form-data">
                <input type="file" name="file" id="inputFile">
                <input type="submit" value="Set a profile picture" name="submit">
            </form>
            <b><h4>Wallpaper</h4></b>
			<table>
                <tr>
                    <th>Number</th>
                    <th>Wallpaper</th>
                    <th>Number</th>
                    <th>Wallpaper</th>
                </tr>
                <tr>
                    <th><form id="button" method="post"><input id="button" type="submit" name="walld" value="1"></form></th>
                    <th><img src="/data/wallpaper/1.png"></th>
                    <th><form id="button" method="post"><input id="button" type="submit" name="walld" value="5"></form></th>
                    <th><img src="/data/wallpaper/5.png"></th>
                    
                </tr>
                <tr>
                    <th><form id="button" method="post"><input id="button" type="submit" name="walld" value="2"></form></th>
                    <th><img src="/data/wallpaper/2.png"></th>
                    <th><form id="button" method="post"><input id="button" type="submit" name="walld" value="6"></form></th>
                    <th><img src="/data/wallpaper/6.png"></th>
                </tr>
                <tr>
                    <th><form id="button" method="post"><input id="button" type="submit" name="walld" value="3"></form></th>
                    <th><img src="/data/wallpaper/3.png"></th>
                    <th><form id="button" method="post"><input id="button" type="submit" name="walld" value="7"></form></th>
                    <th><img src="/data/wallpaper/7.png"></th>
                </tr>
                <tr>
                    <th><form id="button" method="post"><input id="button" type="submit" name="walld" value="4"></form></th>
                    <th><img src="/data/wallpaper/4.png"></th>
                    <th><form id="button" method="post"><input id="button" type="submit" name="walld" value="8"></form></th>
                    <th><img src="/data/wallpaper/8thm.png"></th>
                </tr>
                </table></br>
	    <p>Currently: <b> <?php echo $wall_custom; ?></b></p>
            <p>Choose a wallpaper by clicking on a button or upload your own wallpaper</p>
            <form action="/other/settings/wallupd.php" method="post" enctype="multipart/form-data">
                <input type="file" name="file" id="inputFile">
                <input type="submit" value="Upload" name="submit">
            </form>
            <b><h4>Uploads page version</h4></b>
            <form id="button" method="post">
                <p>The PHP version of uploads less resource heavy and doesn't need JS while the JS is more resource heavy and has currently broken downloads</p>
                <input id="button" type="submit" name="UPLVER" value="PHP">
                <input id="button" type="submit" name="UPLVER" value="JavaScript">
            </form></br>
            <b><h4>GIF's</h4></b>
            <form id="button" method="post">
                <input id="button" type="submit" name="GIF" value="ON">
                <input id="button" type="submit" name="GIF" value="OFF">
            </form></br>
 	    <b><h4>Custom GIF</h4></b>
		<p>Here you can upload your custom GIF</p>
            <form enctype="multipart/form-data" method="post"  action="/other/settings/customgif.php">
                <input type="file" name="customgif" id="inputFile">
                <input type="submit" value="Upload" name="customgifsubmit">
            </form></br>
			<a href="/user/account.php" link>Back to home</a>
			</center>
    </div>
</body>
</html>
