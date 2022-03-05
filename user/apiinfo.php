<?php
include("../other/con.php");
include("../other/function.php");
require_once '../data/require/dblogin.php';
require_once '../data/require/cookieLogin.php';
$api = $_COOKIE['apikey'];
$settings = settings($con,$api);
$user = check_login($con,$api);

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Re:PowerPC - User info</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/css/newstyle.css">
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="/scripts.js"></script>
        <link rel="icon" type="image/x-icon" href="/data/icon.png">
    </head>
    <body style="background-image: url(../data/<?php echo $settings['wallpaper']; ?>)">
        <div class="api">
            <p>User: <?php print $user['name'] ?></p>
            <p>Mail: <?php print $user['mail'] ?></p>
            <p>API: <?php print $user['apikey'] ?></p>
            <p>Files: <?php print $user['fileCount'] ?></p>
            <input type="button" value="Back to home" onclick="location='account.php'" />
        </div>
    </body>
</html>
