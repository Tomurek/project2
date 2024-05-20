<?php
require_once "kompy.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nr_stanowiska = $_POST["MAC"];
    $sql = "DELETE FROM gora WHERE nr_stanowiska = '$nr_stanowiska'";
    $query = mysqli_query($link, $sql);

    if (!empty($_POST["usun"])) {

        if (!empty($_POST["MAC"])) {

            if ($query) {
                echo "Stanowisko nr '$nr_stanowiska' zostało usunięte";
            } else {
                echo "Usuwanie stanowiska nr '$nr_stanowiska' nie powiodła się";
            }
        }
    }
    }

?>

<html>
    <body>
    <form method="post">
        Które stanowisko chcesz usunąć:<br>
        <input type="text" name="MAC"><br><br>
        <input type="submit" name="usun" value="Usuń MAC">
    </form>
    </body>

</html>