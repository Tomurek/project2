<?php
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST["wybor"]) && $_POST["wybor"] == "gora")
    {
        $miejsce = "gora";
    }
    else if(isset($_POST["wybor"]) && $_POST["wybor"] == "dol")
    {
        $miejsce = "dol";
    }

    $nr_stanowiska = $_POST["MAC"];
    $sql = "DELETE FROM kompy WHERE nr_stanowiska = '$nr_stanowiska' AND miejsce = '$miejsce'";
    $query = mysqli_query($link, $sql);

    if (!empty($_POST["usun"])) {

        if (!empty($_POST["MAC"])) {

            if ($query) {
                header("location: computers.php");
            } else {
                echo "Usuwanie stanowiska nr '$nr_stanowiska' nie powiodła się";
            }
        }
    }
    }
    header("location: computers.php")
?>

