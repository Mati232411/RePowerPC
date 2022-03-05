<?php
include("../other/con.php");
include("../other/function.php");
require_once '../data/require/dblogin.php';
require_once '../data/require/cookieLogin.php';
$api = $_COOKIE['apikey'];
$settings = settings($con,$api);
$user_data = check_login($con,$api);
if(!$api == "OwxmoPXnS5ALlv85Qqh55OIj8PqVYFf2pNXexmbzoKN8f8") {
    print "Api Key doesnt match";
    header("Location: /");
}
if ($_POST['chngbtn'])
    {
        $id = $_POST['updatechng'];
        $q=$db->prepare('INSERT INTO chng (text) VALUES (?)');
        $q->execute([htmlentities($id)]);	
    } elseif($_POST['userdel']) {
        $id = $_POST['uid'];
        $admintool = admintooldel($con, $id);
        $targetapi = $admintool['apikey'];
        $path = "/var/www/srv/files/$targetapi";
        deleteDir($path);
        $q=$db->prepare('DELETE FROM settings WHERE id=?');
        $q->execute([htmlentities($admintool['apikey'])]);
        $q=$db->prepare('DELETE FROM files WHERE id_user=?');
        $q->execute([htmlentities($id)]);
        $q=$db->prepare('DELETE FROM users WHERE id=?');
        $q->execute([htmlentities($id)]);	
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Re:PowerPC - Update console</title>
        <link rel="stylesheet" href="../css/newstyle.css">
    </head>
    <body style="background-image: url(../data/<?php echo $settings['wallpaper']; ?>)" >
        <div class="middle">
            <p>Hello there admin: <b><?php print $user_data['name']; ?></b></p>
        </div>
        <div class="admin"><center>
            <b>Tool's</b></br>
            <p>Update changelog's</p>
            <form id="button" method="post">
				<input id="text" type="text" name="updatechng">
                <input id="button" type="submit" name="chngbtn" value="Submit"><br><br>
        </form>
        <form action="/index.php"><button>Back</button></form></div>
        <div class="users">
            <h2><b>Users:</b></h2>
<?php
include_once '/other/con.php';
$result = mysqli_query($con,"SELECT * FROM users");
?>
<?php
if (mysqli_num_rows($result) > 0) {
?>
    <table border=1>
        <tr>
            <td>User</td>
            <td>Files</td>
            <td>Delete</td>
        </tr>
<?php
$i=0;
while($row = mysqli_fetch_array($result)) {
?>
<tr>
<td><?php echo $row["name"]; ?></td>
<td><?php echo $row["fileCount"]; ?></td>
<td><form id="button" method="post">
        <input type="hidden" name="uid" value="<?php echo $row['id']; ?>"/>
        <input id="button" type="submit" name="userdel" value="Delete"/>
    </form></td>
</tr>
<?php
$i++;
}
?>
</table></br>
            <?php
            }
            else{
            echo "No result found";
            }
            ?>
        </center></div></div>
    </body>
</html>