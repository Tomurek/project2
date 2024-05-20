<?php
require_once "config.php";

if(isset($_POST['update'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hashuj hasło
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Update hasła użytkownika
    $sql = "UPDATE login SET passwd = '$hashed_password' WHERE username = '$username'";
    $query = mysqli_query($link, $sql);

    if($query) {
        echo "Hasło użytkownika '$username' zostało zmienione";
        header("location: users.php");
    } else {
        echo "Nie udało się zmienić hasła użytkownika '$username'";
    }
}
?>
