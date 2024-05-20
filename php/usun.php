<?php
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["delete"];
    $sql = "DELETE FROM login WHERE username = '$username'";
    $query = mysqli_query($link, $sql);

    if (!empty($_POST["usun"])) {

        if (!empty($_POST["delete"])) {

            if ($query) {
                echo "Użytkownik '$username' został usunięty";
            } else {
                echo "Usuwanie użytkownika '$username' nie powiodło się";
            }
        }
    }
    }

?>

<html>
    <body>
    <form method="post" action="usun.php">
        Którego użytkownika chcesz usunąć:<br>
        <input type="text" name="delete"><br><br>
        <input type="submit" name="usun" value="wyslij">
    </form>
    </body>
</html>