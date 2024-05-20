<?php

session_start();

// if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
//     header("location: login.php");
//     exit;
// }
?>


<?php
require_once "config.php";



if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $password = $confirm_password = "";
  $username_err = $password_err = $confirm_password_err = "";
  $name = "";
  $surname = "";

  if (empty(trim($_POST["name"]))) {
    $username_err = "Wprowadz swoje imie.";
  } else {
    $sql = "SELECT id FROM logins WHERE name = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
      mysqli_stmt_bind_param($stmt, "s", $param_name);

      $param_name = trim($_POST["name"]);
    }

    mysqli_stmt_close($stmt);
  }
  if (empty(trim($_POST["surname"]))) {
    $username_err = "Wprowadz swoja nazwisko.";
  } else {
    $sql = "SELECT id FROM logins WHERE surname = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
      mysqli_stmt_bind_param($stmt, "s", $param_surname);

      $param_surname = trim($_POST["surname"]);
    }

    mysqli_stmt_close($stmt);
  }


  if (empty(trim($_POST["username"]))) {
    $username_err = "Wprowadz swoja nazwe uzytkownika.";
  } else {
    $sql = "SELECT id FROM logins WHERE username = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
      mysqli_stmt_bind_param($stmt, "s", $param_username);

      $param_username = trim($_POST["username"]);

      if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) == 1) {
          $username_err = "Ta nazwa uzytkownika jest juz zajeta.";
        } else {
          $username = trim($_POST["username"]);
        }
      } else {
        echo "Cos poszlo nie tak. Sprobuj ponownie..";
      }
    }

    mysqli_stmt_close($stmt);
  }

  if (empty(trim($_POST["password"]))) {
    $password_err = "Wprowadz swoje haslo.";
  } elseif (strlen(trim($_POST["password"])) < 5) {
    $password_err = "Haslo musi miec przynajmniej 5 znakow";
  } else {
    $password = trim($_POST["password"]);
  }

  if (empty(trim($_POST["confirm_password"]))) {
    $confirm_password_err = "Potwierdz swoje haslo.";
  } else {
    $confirm_password = trim($_POST["confirm_password"]);
    if (empty($password_err) && ($password != $confirm_password)) {
      $confirm_password_err = "Hasla sie nie zgadzaja.";
    }
  }

  if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {

    $sql = "INSERT INTO logins (name,surname,username, passwd) VALUES (?,?,?,?)";

    if ($stmt = mysqli_prepare($link, $sql)) {
      mysqli_stmt_bind_param($stmt, "ssss", $param_name, $param_surname, $param_username, $param_password);

      $param_username = $username;
      $param_password = password_hash($password, PASSWORD_DEFAULT);

      if (mysqli_stmt_execute($stmt)) {
        header("location: users.php");
      } else {
        echo "Cos poszlo nie tak. Sprobuj ponownie..";
      }
    }
    mysqli_stmt_close($stmt);
  }
  mysqli_close($link);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="CSS/style3.css">
  <script src="script.js"></script>
  <title>Document</title>
</head>

<body class="container">
  <header class="header">
    <a href="#" class="logo"><img src="image/logo.png" alt="Logo strony"></a>
    <label class="switch">
      <input type="checkbox" id="dark-mode-switch" onclick="switchTheme(event)" />
      <span class="slider"></span>
    </label>
    <input class="menu-btn" type="checkbox" id="menu-btn" />
    <label class="menu-icon" for="menu-btn"><span class="navicon"></span></label>
    <ul class="menu">
      <li><a href="install.php">Instalacja</a></li>
      <li><a href="computers.php">Komputery</a></li>
      <li><a href="users.php">Uzytkownicy </a></li>
      <li><a href="status.php">Status </a></li>
      <li><a onclick="showBackup()" href="#">Backup</a></li>
      <li>
        <a>
          <form action="wyloguj.php"><input class="logout" type="submit" name="wyloguj" value="Wyloguj"></input></form>
        </a>
      </li>
    </ul>
  </header>
  <main class="main">
    <?php
    require_once "config.php";

    $sql = "SELECT * FROM logins";

    $result = mysqli_query($link, $sql);

    echo "<table>
      <thead>
      <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Surname</th>
      <th>Username</th>
      
      <th></th>
      </tr>
    </thead>";
    echo "<tfoot>
      <tr><th colspan='6'>
      <button class='button' type='submit' id='add' name='dodaj' onclick='showAdd()'>Dodaj nowego uzytkownika</button>
      </th></tr>
    </tfoot>";
    echo "<tbody>";
      while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td data-title='ID'>" . $row['id'] . "</td>";
        echo "<td data-title='Name'>" . $row['name'] . "</td>";
        echo "<td data-title='Surname'>" . $row['surname'] . "</td>";
        echo "<td data-title='Username'>" . $row['username'] . "</td>";
        // echo "<td data-title='Password'>" . $row['passwd'] . "</td>";
        echo "<td class='select'>
          <button class='button' onclick='showEdit()'>Edit</button>
          <button class='button' onclick='showDell()'>Delete</button></td>";
        echo "</tr>";
      }
      echo "</tbody>";
      echo "</table>";

    mysqli_close($link);
    ?>
  </main>
    <section class="adduser" id="showAdd">
      <form method="post">
        <div class="center">
        <label><h2>Tworzenie uzytkownika</h2>
          <p>Podaj dane aby zarejestrowac użytkownika.</p></label>
        </div>
        <form action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF"]); ?>" method="post">
          <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
            <div class="center">
              <label>Imie</label>
              <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" required>
            </div>
            <div class="center">
              <label>Nazwisko</label>
              <input type="text" name="surname" class="form-control" value="<?php echo $surname; ?>" required>
            </div>
            <div class="center">
              <label>Nazwa uzytkownika</label>
              <input type="text" name="username" class="form-control" value="<?php echo $username; ?>" required>
              <span class="help-block">
                <?php
                if (isset($username_err)) {
                  echo '<font color="red">' . $username_err . "</font>";
                }
                ?>
              </span>
            </div>
          </div>
          <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
            <div class="center">
              <label>Haslo</label>
              <input type="password" name="password" class="form-control" value="<?php echo $password; ?>" required>
              <span class="help-block">
                <?php
                if (isset($password_err)) {
                  echo '<font color="red">' . $password_err . "</font>";
                }
                ?>
              </span>
              </span>
            </div>
          </div>
          <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
            <div class="center">
              <label>Potwierdz haslo</label>
              <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>" required>
              <span class="help-block">
                <?php
                if (isset($username_err)) {
                  echo '<font color="red">' . $username_err . "</font>";
                }
                ?>
              </span>
            </div>
          </div>
          <div class="form-group">
            <div class="center">
              <input type="submit" class="btn btn-primary" value="Zarejestruj sie">
              <a class="alertB" onclick="hideAdd()">Anuluj</a>
            </div>
          </div>

        </form>
        </div>
      </form>
    </section>

    <section class="edituser" id="showEdit">
      <form method="post" action="zmiana.php">
      <label>Wprowadź nazwę użytkownika:</label><br>
        <input type="text" name="username" required><br>
        <?php
        if (isset($password_err)) {
          echo '<font color="red">' . $password_err . "</font>";
        }
        ?>
        <label>Wprowadź nowe hasło:</label><br>
        <input type="password" name="password">
        <input type="submit" name="update" value="Zmień hasło" required>
        <?php
        if (isset($password_err)) {
          echo '<font color="red">' . $password_err . "</font>";
        }
        ?>
        <div class="center">
          <a class="alertB" onclick="hideEdit()">Anuluj</a>
        </div>
      </form>
    </section>

    <section class="delluser" id="showDell">
      <form method="post" action="usun.php">
      <label>Którego użytkownika chcesz usunąć:</label><br>
        <input type="text" name="delete" required>
        <input type="submit" name="usun" value="Usun">
        <div class="center">
          <a class="alertB" onclick="hideDell()">Anuluj</a>
        </div>
      </form>
    </section>

    <section class="showBackup" id="showBackup">
      <form method="post" action="backup.php">
        <div class="center">
        <label>Backup</label><br>
          <input type="submit" name="Backup" value="Zrób Backup">
          <a class="alertB" onclick="hideBackup()">Anuluj</a>
        </div>
      </form>
    </section>
  </body>

</html>