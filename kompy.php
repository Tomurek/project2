<?php
define('DB_SERVER', '127.0.0.1');
define('DB_USERNAME', 'Tomur');
define('DB_PASSWORD', 'ZAQ!2wsx');
define('DB_NAME', 'kompy');
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
if($link === false){
    die("ERROR: " . mysqli_connect_error());
}
?>
