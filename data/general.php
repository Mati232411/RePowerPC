<?php
require_once '../data/require/dblogin.php';
require_once '../data/require/cookieLogin.php';
include("../other/con.php");
include("../other/function.php");
$api = $_COOKIE['apikey'];
$user_data = check_login($con,$api);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/style.css">
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="../scripts.js"></script>
        <link rel="icon" type="image/x-icon" href="/data/icon.png">
        <title>Re:PowerPC - INFO</title>
    </head>
    <body style="background-image: url(../data/<?php echo $user_data['walld']; ?>)">
        <div class="srest"><div class="btn"><center>
            <b>User: <?php print $user_data['name']; ?></b></br>
            <p>Upload limit: <span class="size"><?php echo $user_data['maxSize']; ?></span></br>
            Current size: <span class="size"><?php echo $user_data['actSize']; ?></span></br>
            File count: <?php echo $user['fileCount']; ?><br></p>
        </div></div>
    </body>
</html>