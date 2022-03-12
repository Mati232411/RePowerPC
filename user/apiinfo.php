<?php
$api = $_COOKIE['apikey'];
include("../other/con.php");
include("../other/function.php");
include("../other/general.php");

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
        <style>
            body {
                background-image: url(<?php echo $wallpaper; ?>);
                <?php echo $parameters; ?>
            }
        </style>
    </head>
    <body>
        <div class="api">
            <p>User: <?php print $user_data['name'] ?></p>
            <p>Mail: <?php print $user_data['mail'] ?></p>
            <p>API: <?php print $user_data['apikey'] ?></p>
            <p>Files: <?php print $user_data['fileCount'] ?></p>
            <input type="button" value="Back to home" onclick="location='account.php'" />
        </div>
    </body>
</html>
