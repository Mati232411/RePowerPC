<?php
$api = $_COOKIE['apikey']; // Gets apikey which is my login method
include("../other/general.php");
$maxmb = $user_data['maxSize'] / (1024 * 1024);
$curkb = $user_data['actSize'] / 1024;
if ($maxmb > "1023") { // Calculates maximum size for a user
    $maxgb = $maxmb / 1024;
    $maxtmp = number_format((float)$maxgb, 2, '.', '');
    $max = "$maxtmp GB";
} else {
    $max = "$maxmb MB";
}
if ($curkb > "1023") { // And current size
    $curmb = $curkb / 1024;
    if ($curmb > "1023") {
        $cur = $curmb / 1024;
        $curtmp = number_format((float)$cur, 2, '.', '');
        $cur = "$curtmp GB";
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
        <style>
            body {
                background-image: url(<?php echo $wallpaper; ?>);
                <?php echo $parameters; ?>
            }
        </style>
        <script>
    function _(el){
        return document.getElementById(el);
    }
    function uploadFile(){
        var file = _("file").files[0];
        // alert(file.name+" | "+file.size+" | "+file.type);
        var formdata = new FormData();
        formdata.append("file", file);
        var ajax = new XMLHttpRequest();
        ajax.upload.addEventListener("progress", progressHandler, false);
        ajax.addEventListener("load", completeHandler, false);
        ajax.addEventListener("error", errorHandler, false);
        ajax.addEventListener("abort", abortHandler, false);
        ajax.open("POST", "../api/upload.php");
        ajax.send(formdata);
    }
    function progressHandler(event){
        var percent = (event.loaded / event.total) * 100;
        _("progressBar").value = Math.round(percent);
        _("status").innerHTML = Math.round(percent)+"% uploaded...";
    }
    function completeHandler(event){
        _("status").innerHTML = event.target.responseText;
        _("progressBar").value = 0;
    }
    function errorHandler(event){
        _("status").innerHTML = "Upload Failed";
        xhr.abort()
        }
    function abortHandler(event){
        _("status").innerHTML = "Upload Aborted";
        xhr.abort()
    }
    </script>
        <?php echo $litesc; ?>
    </head>
    <body>
        <div class="rest">
            <b>User info:</b></br>
            <p>Upload limit: <?php echo $max; ?></br>
            Current size: <?php echo $cur; ?></br>
            File count: <?php echo $user_data['fileCount']; ?><br></p>
        </div>
        <div class="srest">
            <div class="btn"><center>
        <div class="wrapper">
            <h2 class="nomargintop marginbottom">Welcome to Files</h2>
            <?php echo $lite; ?>
	<form action="<?php if($settings["uploads"] == "PHP") {echo "upload.php"; } else {echo "uploads.html";} ?>"><input id="button" type="submit" value="Uploads"></form>
        <form action="account.php"><input id="button" type="submit" value="Back to home"></form>
            <p></p>
    </center></div></div></div>
    </div>
    </body>
</html>
