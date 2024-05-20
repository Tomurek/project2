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
    } else {
        echo "Nie udało się zmienić hasła użytkownika '$username'";
    }
}
?>

<html>
    <body>
    <form method="post">
        Wprowadź nazwę użytkownika:<br>
        <input type="text" name="username"><br><br>
        Wprowadź nowe hasło:<br>
        <input type="password" name="password"><br><br>
        <input type="submit" name="update" value="Zmień hasło">
    </form>
    </body>
</html>