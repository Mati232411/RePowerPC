<?php
if (isset($_SERVER['HTTP_COOKIE'])) {
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    foreach($cookies as $cookie) {
        $parts = explode('=', $cookie);
        $name = trim($parts[0]);
        setcookie($name, '', time()-1000); // Removes cookie loging user out.
        setcookie($name, '', time()-1000, '/');
        header("Location: /");
        exit;
    }
}
?>
