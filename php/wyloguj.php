<?php
session_start();

if(isset($_POST['wyloguj'])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit;
}
?>

<form action="" method="post">
    <input type="submit" name="wyloguj" value="Wyloguj">
</form>
