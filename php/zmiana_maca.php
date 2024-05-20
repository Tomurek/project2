<?php
require_once "kompy.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $computer = $_POST['computer'];
    $MAC = $_POST['MAC'];
    if (isset($_POST['update'])) {
        
        $sql = "UPDATE gora SET MAC = '$MAC' WHERE nr_stanowiska = '$computer'";
        $query = mysqli_query($link, $sql);

        if ($query) {
            echo "MAC stanowiska '$computer' zostało zmienione";
        } else {
            echo "Nie udało się zmienić MACa stanowiska '$computer'";
        }
    }
}
?>

<html>
    <body>
    <form method="post">
        Wprowadź numer stanowiska:<br>
        <input type="text" name="computer"><br><br>
        Wprowadź nowy adres MAC:<br>
        <input type="MAC" name="MAC"><br><br>
        <input type="submit" name="update" value="Zmień MAC">
    </form>
    </body>
</html>