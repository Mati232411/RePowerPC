<?php 
include("../other/con.php");
include("../other/function.php");
$api = $_COOKIE['apikey'];
$settings = settings($con,$api);
$user_data = check_login($con,$api);
if($_SERVER['REQUEST_METHOD'] == "POST")
	{
        if ($_POST['walld'])
    {
		$dataz = $_POST['wall'];
		$data = "$dataz.png";
		wallupd($con,$data,$api);
        header("Location: /");
    } elseif ($_POST['GIF']) {
        if($_POST['GIF'] == "ON") {
            $data = "1";
        } else {
            $data = "0";
        }
        print $data;
		gifup($con,$data,$api);
        header("Location: /");
    } elseif ($_POST['LITE']) {
        if($_POST['LITE'] == "ON") {
            $data = "1";
        } else {
            $data = "0";
        }
		liteup($con,$data,$api);
        header("Location: /");
    } elseif ($_POST['UPLVER']) {
        $data = $_POST['UPLVER'];
		chngupload($con,$data,$api);
        header("Location: /");
    }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Re:PowerPC - User Settings</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="icon" type="image/x-icon" href="/data/icon.png">
</head>
<body style="background-image: url(../data/<?php echo $settings['wallpaper']; ?>)">
    <div class="settings">
        <center>
            <b><h1>Settings</h1></b>
            <br>
            <b><h4>Wallpaper</h4></b>
			<table>
                <tr>
                    <th>Number</th>
                    <th>Wallpaper</th>
                    <th>Number</th>
                    <th>Wallpaper</th>
                </tr>
                <tr>
                    <th>1</th>
                    <th><img src="/data/1.png"></th>
                    <th>5</th>
                    <th><img src="/data/5.png"></th>
                    
                </tr>
                <tr>
                    <th>2</th>
                    <th><img src="/data/2.png"></th>
                    <th>6</th>
                    <th><img src="/data/6.png"></th>
                </tr>
                <tr>
                    <th>3</th>
                    <th><img src="/data/3.png"></th>
                    <th>7</th>
                    <th><img src="/data/7.png"></th>
                </tr>
                <tr>
                    <th>4</th>
                    <th><img src="/data/4.png"></th>
                    <th>8</th>
                    <th><img src="/data/8thm.png"></th>
                </tr>
                </table>
            <p>Type in number and press submit</p>
			<form id="button" method="post">
				         <input id="text" type="text" name="wall">
                        <input id="button" type="submit" name="walld" value="Submit"><br><br>
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
			<a href="/user/account.php" link>Back to home</a>
			</center>
    </div>
</body>
</html>
