<?php
include("../other/con.php");
include("../other/function.php");
if(empty($_COOKIE['apikey'])) { // Checks if user logged in if not displays basic background and if yes displays user choice
$link = "/"; // Where to back button should lead
$css = "base.css"; // Choice of css file
} else {
$link = "account.php";
$css = "style.css";
}
if(empty($_COOKIE['apikey'])) {
    $backg = 'background-image: url(/data/1.png);';
} else {
    $api = $_COOKIE['apikey'];
    include("../other/general.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Re:PowerPC - About this website</title>
        <link rel="stylesheet" href="/css/<?php echo $css; ?>">
        <link rel="icon" type="image/x-icon" href="/data/icon.png">
        <style>
            body {
                background-image: url(<?php echo $wallpaper; ?>);
                <?php echo $parameters; ?>
            }include("../other/general.php");

        </style>
    </head>
    <body >
        <div class="srest">
            <div class="btn"><center>
        <div class="bigwrapper">
            <div class="inBigWrapper">
                Welcome<br><br>
                This is my school project my magnum opus. This website was created to store files a be accesible and fast on old computers like my PowerBook G4 Titanium but i also tested it on <a href="https://ibb.co/3MW5VfL">Pentium 2</a> and <a href="https://ibb.co/Sf0s6rh">Quadra 800</a> with 40Mhz 68040 cpu.<br>
                <br>
                <b>Beta Testers that contriubted to this website:</b></br>
                 - Mikołaj Makos</br>
                 - Gabriel Staniszewski</br>
        </br>
        <b>Upload and delete api based on: </b>wewxd project called filesharingwebsite </br>
                <a href="https://github.com/wewxd/file-sharing-website">Link</a>
                <br>
                <form action=<?php print $link; ?>><input id="button" type="submit" value="Back to home"></form>
            </div>
        </div>
    </body>
</html>
