<?php
include("../other/con.php");
include("../other/function.php");
if(empty($_COOKIE['apikey'])){
    header("Location: /");
}
$user_data = check_login($con,$api);
$settings = settings($con,$api);
$gif = $settings['gif'];
if ($settings['wallpaper'] == "0") { // If zero means a that there is a custom wallpaper else one of the predefined
    $basewallpaper = $settings['custom_wallpaper']; // A base name of wallpaper
    $wallpaper = "/pfp/$basewallpaper"; // An adress to a wallpaper
    $parameters = "background-repeat: repeat-y; background-size: cover;"; // Disable repeat and enable cover to strech the image across the website
} else {
    $basewallpaper = $settings['wallpaper'];
    $wallpaper = "/data/wallpaper/$basewallpaper";
    $parameters = " ";
}
if( $_SERVER['SERVER_NAME'] == "") {
    $adres = ""; // I use it to port forward as i dont use 80 port but 8079
    } else {
    $adres = $_SERVER['SERVER_NAME']; // Gets server name
}
if( (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443 ){ // Checks if SSL
        $secure="Yes"; // Checks if SSL
}
if( $settings['lite'] == "1" ) {
    $lite = '<form action="../api/upload.php" method="post" enctype="multipart/form-data">
    <input type="file" name="file" id="inputFile">
    <input type="submit" value="Upload" name="submit">
    </form></br>'; // Lite version of page
} elseif( $settings['lite'] == "0" ) {
    $litesc = "";
    $lite = '<form id="upload_form" enctype="multipart/form-data" method="post">
    <input type="file" name="file" id="file">
  <input type="button" value="Upload" onclick="uploadFile()"></br>
  <progress id="progressBar" value="0" max="100"></progress>
  <h3 id="status"></h3>
  <p id="loaded_n_total"></p>
    </form>'; // Ajax with progress bar
}
