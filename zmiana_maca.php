<?php
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $computer = $_POST['computer'];
    $MAC = $_POST['MAC'];
    if(isset($_POST["wybor"]) && $_POST["wybor"] == "gora")
    {
        $miejsce = "gora";
    }
    else if(isset($_POST["wybor"]) && $_POST["wybor"] == "dol")
    {
        $miejsce = "dol";
    }
    if (isset($_POST['update'])) {
        
        $sql = "UPDATE kompy SET MAC = '$MAC' WHERE nr_stanowiska = '$computer' AND miejsce = '$miejsce'";
        $query = mysqli_query($link, $sql);

        if ($query) {
            header("location: computers.php");
        } else {
            echo "Nie udało się zmienić MACa stanowiska '$computer'";
        }
    }
}

header("location: computers.php");
?>
