<?php 
if(file_exists('/var/www/fmc.conf')){
    $conf=json_decode(file_get_contents('/var/www/fmc.conf'), true);
}else{
    die('No config file found at '.getenv('HOME').'/fmc.conf');
}
$u=$conf['usr'];
$p=$conf['pwd'];
try{$db=new PDO('mysql:host=localhost;dbname=fmc',$u,$p);}
catch(PDOException $e){die($e->getMessage());}
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
