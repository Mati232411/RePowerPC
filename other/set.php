<?php
    if ($_POST['walld'])
    {
		$dataz = $_POST['wall'];
		$data = "$dataz.png";
		wallupd($con,$data,$api);
        header("Location: /");
    } elseif ($_POST['GIF']) {
        $data = $_POST['gifin'];
		gifup($con,$data,$api);
        header("Location: /");
    } elseif ($_POST['LITE']) {
        $data = $_POST['litein'];
		liteup($con,$data,$api);
        header("Location: /");
    } elseif ($_POST['UPLVER']) {
        $data = $_POST['UPLVER'];
        print $data;
		chngupload($con,$data,$api);
        header("Location: /");
    } else {
        print "Hello";
    }
    ?>