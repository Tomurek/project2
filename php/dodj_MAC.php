<?php
require_once "kompy.php";

$nr_stanowiska = $MAC = $confirm_MAC = "";
$nr_stanowiska_err = $MAC_err = $confirm_MAC_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST["nr_stanowiska"]))){
        $nr_stanowiska_err = "Wprowadz numer stanowiska.";
    } else{
        $sql = "SELECT id FROM gora WHERE nr_stanowiska = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_nr_stanowiska);
            
            $param_nr_stanowiska = trim($_POST["nr_stanowiska"]);
            
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $nr_stanowiska_err = "Ten numer stanowiska jest już zajęty.";
                } else{
                    $nr_stanowiska = trim($_POST["nr_stanowiska"]);
                }
            } else{
                echo "Cos poszlo nie tak. Sprobuj ponownie..";
            }
        }

        mysqli_stmt_close($stmt);
    }

    if(empty(trim($_POST["MAC"]))){
        $MAC_err = "Wprowadz MAC.";
    } elseif(strlen(trim($_POST["MAC"])) != 12){
        $MAC_err = "Adres MAC ma 12 znaków";
    } else{
        $MAC = trim($_POST["MAC"]);
    }
    
    if(empty($nr_stanowiska_err) && empty($MAC_err) && empty($confirm_MAC_err)){

        $sql = "INSERT INTO gora (nr_stanowiska, MAC) VALUES (?,?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ss",$param_nr_stanowiska, $param_MAC);

            $param_nr_stanowiska = $nr_stanowiska;
            $param_MAC = $MAC;

            if(mysqli_stmt_execute($stmt)){
                header("location: index.php");
            } else{
                echo "Cos poszlo nie tak. Sprobuj ponownie..";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
}
?>

<html>
    <body>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="center">
                <label>Numer Stanowiska</label>
                <input type="text" name="nr_stanowiska" class="form-control" value="<?php echo $nr_stanowiska; ?>">
                <span class="help-block"><?php echo $nr_stanowiska_err; ?></span>
            </div>
            </div>    
            <div class="form-group <?php echo (!empty($MAC_err)) ? 'has-error' : ''; ?>">
            <div class="center">
                <label>MAC</label>
                <input type="text" name="MAC" class="form-control" value="<?php echo $MAC; ?>">
                <span class="help-block"><?php echo $MAC_err; ?></span>
            </div>
            </div>
            <div class="center">
                <input type="submit" class="btn btn-primary" value="Dodaj adres MAC">
            </div> 
        </form>
    </body>
</html>