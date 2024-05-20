<!DOCTYPE html>
<html lang="en">
<?php 
session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: install.php");
    exit;
}

require_once "config.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST["user"]))){
        $username_err = "Wprowadz swoja nazwe uzytkownika.";
    } else{
        $username = trim($_POST["user"]);
    }

    if(empty(trim($_POST["pass"]))){
        $password_err = "Wprowadz swoje haslo.";
    } else{
        $password = trim($_POST["pass"]);
    }

    if(empty($username_err) && empty($password_err)){
        $sql = "SELECT id, username, passwd FROM logins WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = $username;      
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            session_start();

                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            // print_r($_SESSION);
                            header("location: install.php");
                        } else{
                            $password_err = "Haslo ktore wpisales jest niewlasciwe.";
                        }
                    }
                } else{
                    $username_err = "Nie ma uzytkownika z taka nazwa.";
                }
            } else{
                echo "Cos poszlo nie tak. Sprobuj ponownie..";
            }
        }
        
        mysqli_stmt_close($stmt);
    }
    
    mysqli_close($link);
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style_login.css">
    <title>Logowanie</title>

    <script src="script.js"></script>

</head>
<body>


    <form onsubmit = "return validation()" method = "POST">
    <div class="box">
        <div class="form">
            <h2>
                Zaloguj się
            </h2>
            <div class="inputBox">
                <input type="text" name="user" required>
                <span>Nazwa Użytkownika</span><i></i>
            </div>
            <?php
                if(isset($username_err)) {
                    echo '<font color="red">'.$username_err."</font>";
                 }
                ?>
            <div class="inputBox">
                <input type="password" name="pass" required>
                <span>Hasło</span><i></i>
                
            </div>
            <?php
                if(isset($password_err)) {
                    echo '<font color="red">'.$password_err."</font>";
                 }
                ?>
	    <div class = "links">
		<a onclick="showAlert()" >Zarejestruj się </a>
        <div id="alert">
        Skontaktuj sie z administratorem pracowni.
        </div>
	    </div> 
            <input type="submit" value="Zaloguj" class="c">
        </div>
    </div>
    </form>
</body>
</html>
