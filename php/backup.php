<?php
require_once "config.php";

if (isset($_POST["Backup"])) {

    $result = mysqli_query($link, "SELECT * FROM login");

    $file = fopen("data.sql", "w");

    fwrite($file, "INSERT INTO table (col1, col2, col3) VALUES");
    while ($row = mysqli_fetch_assoc($result)) {
        fwrite($file, "(" . implode(", ", $row) . "),");
    }

    fseek($file, -1, SEEK_END);
    fwrite($file, ";");

    $phar = new PharData('backup/data.tar');
    $phar->addFile('data.sql');

    foreach (glob("*.php") as $filename) {
        $phar->addFile($filename);
    }

    $phar->compress(Phar::GZ);

    header("Content-Disposition: attachment; filename=data.tar.gz");
    header("Content-Type: application/octet-stream");

    readfile('backup/data.tar.gz');

    fclose($file);

    mysqli_close($link);
}
?>

