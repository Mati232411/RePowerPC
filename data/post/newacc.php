<?php 
// Check if an account already exists with the same username/email
require_once '../require/dblogin.php';
if($conf['allowNewAccounts']==false){
    die("New accounts aren't given away right now");
}
if(!preg_match('/\w*@\w*\.\w*/', $_POST['email'])){
    die('fix your email address ok');
}

$q=$db->prepare('SELECT name FROM users WHERE name=?');
$q->execute([$_POST['name']]);
if(!empty($q->fetch())){
    die('Username already taken');
}
$q=$db->prepare('SELECT mail FROM users WHERE mail=?');
$q->execute([$_POST['email']]);
if(!empty($q->fetch())){
    die('email address already taken');
}

// Update the database
$q=$db->prepare('INSERT INTO users (name, mail, maxSize, fileCount, fileCountWDel, actSize, pwd, apikey, allowed) VALUES (?, ?, ?, 0, 0, 0, ?, ?, 1)');
$pwd=password_hash($_POST['pwd'], PASSWORD_DEFAULT);
$key=preg_replace('/\W/', '', base64_encode(random_bytes(35)));
$q->execute([htmlentities($_POST['name']), $_POST['email'], $conf['newAccountMaxSize'], $pwd, $key]);
$base = $conf['path'];
mkdir($base.$key);
print $key;
$q=$db->prepare('INSERT INTO settings (id) VALUES (?)');
$q->execute([htmlentities($key)]);


if( (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443 ){
    setcookie('apikey', $key, 0, '/', null, true);
    } else {
        setcookie('apikey', $key, 0, '/', null);
    }
header("Location: /user/account.php");
?>
