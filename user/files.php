<?php
require_once '../data/require/dblogin.php';
require_once '../data/require/cookieLogin.php';
include("../other/con.php");
include("../other/function.php");
$api = $_COOKIE['apikey'];
$settings = settings($con,$api);
$user_data = check_login($con,$api);
$maxmb = $user_data['maxSize'] / (1024 * 1024);
$curkb = $user_data['actSize'] / 1024;
if ($maxmb > "1023") {
    $maxgb = $maxmb / 1024;
    $max = "$maxgb GB";
} else {
    $max = "$maxmb MB";
}
if ($curkb > "1023") {
    $curmb = $curkb / 1024;
    if ($curmb > "1023") {
        $cur = $curmb / 1024;
        $cur = "$cur GB";
    } else {
        $curmb = number_format((float)$curmb, 2, '.', '');
        $cur = "$curmb MB";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="icon" type="image/x-icon" href="/data/icon.png">
        <title>Re:PowerPC - Home</title>
    </head>
    <body style="background-image: url(../data/<?php echo $settings['wallpaper']; ?>)">
        <div class="rest">
            <b>User info:</b></br>
            <p>Upload limit: <?php echo $max; ?></br>
            Current size: <?php echo $cur; ?></br>
            File count: <?php echo $user['fileCount']; ?><br></p>
        </div>
        <div class="homeContainer">
                <div class="inHome">
        <div class="srest">
            <div class="btn"><center>
        <div class="wrapper">
            <h2 class="nomargintop marginbottom">Welcome to Files</h2>
            <form action="../api/upload.php" method="post" enctype="multipart/form-data">
                <input type="file" name="file" id="inputFile">
                <input type="submit" value="Upload" name="submit">
            </form></br>
                <input type="button" value="Uploads" onclick="location='<?php if($settings["uploads"] == "PHP") {echo "upload.php"; } else {echo "uploads.html";} ?>'" /></br>
                <input type="button" value="Back to home" onclick="location='account.php'" />
            <p></p>
    </center></div></div></div>
    </div>
    </body>
</html>
