<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: login.php");
  exit;
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
        <a >
          <form action="wyloguj.php"><input class="logout" type="submit" name="wyloguj" value="Wyloguj"></input></form>
          
        </a>
      </li>
    </ul>
  </header>

  <main class="main">
    <?php
    require_once "config.php";

    $sql = "SELECT * FROM komps";

    $result = mysqli_query($link, $sql);

    echo "<table>
      <thead>
      <tr>
      <th>ID</th>
      <th>NR_Stanowiska</th>
      <th>Miejsce</th>
      <th>MAC</th>
      
      <th></th>
      </tr>
    </thead>";
    echo "<tfoot>
      <tr><th colspan='6'>
      <button class='button' type='submit' id='add' name='dodaj' onclick='showAdd()'>Dodaj nowy komputer</button>
      </th></tr>
    </tfoot>";
    echo "<tbody>";
    while ($row = mysqli_fetch_array($result)) {
      echo "<tr>";
      echo "<td data-title='ID'>" . $row['id'] . "</td>";
      echo "<td data-title='NR_Stanowiska'>" . $row['nr_stanowiska'] . "</td>";
      echo "<td data-title='Miejsce'>" . $row['miejsce'] . "</td>";
      echo "<td data-title='MAC'>" . $row['MAC'] . "</td>";
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
    <form method="post" action="dodj_MAC.php">
      <form action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF"]); ?>" method="post">
        <div class="center">
          <label>Miejsce:</label>
          <select name="wybor" class="selectop">
            <option value="gora">Góra</option>
            <option value="dol">Dól</option>
          </select>
        </div>
        <div class="center">
          <label>Numer Stanowiska:</label>
          <input type="text" name="nr_stanowiska" class="form-control" value="<?php echo $nr_stanowiska; ?>" required>
          <span class="help-block">
            <?php
            if (isset($nr_stanowiska_err)) {
              echo '<font color="red">' . $nr_stanowiska_err . "</font>";
            }
            ?>
          </span>
        </div>

        </div>
        <div class="form-group <?php echo (!empty($MAC_err)) ? 'has-error' : ''; ?>">
          <div class="center">
            <label>MAC:</label>
            <input type="text" name="MAC" class="form-control" value="<?php echo $MAC; ?>" required>
            <span class="help-block">
              <?php
              if (isset($MAC_err)) {
                echo '<font color="red">' . $MAC_err . "</font>";
              }
              ?>
            </span>
          </div>
        </div>
        <div class="center">
          <input type="submit" class="btn btn-primary" value="Dodaj adres MAC">
          <a class="alertB" onclick="hideAdd()">Anuluj</a>
        </div>
      </form>
    </form>
  </section>

  <section class="edituser" id="showEdit">
    <form method="post" action="zmiana_maca.php">
      <div class="center">
        <label>Miejsce</label>
        <select name="wybor" class="selectop">
          <option value="gora">Gora</option>
          <option value="dol">dol</option>
        </select>
      </div>
      <div class="center">
      <label>Wprowadź numer stanowiska: </label><br>
      <input type="text" name="computer" required><br>
      <span class="help-block">
        <?php
        if (isset($nr_stanowiska_err)) {
          echo '<font color="red">' . $nr_stanowiska_err . "</font>";
        }
        ?>
      </span>
      <div class="center">
      <label>Wprowadź nowy adres MAC: </label><br>
      <input type="MAC" name="MAC">
      <input type="submit" name="update" value="Zmień MAC">
      <span class="help-block">
        <?php
        if (isset($MAC_err)) {
          echo '<font color="red">' . $MAC_err . "</font>";
        }
        ?>
      </span>
      <div class="center">
        <a class="alertB" onclick="hideEdit()">Anuluj</a>
      </div>
    </form>
  </section>

  <section class="delluser" id="showDell">
    <form method="post" action="usun_MAC.php">
      <div class="center">
        <label>Miejsce</label>
        <select name="wybor" class="selectop">
          <option value="gora">Gora</option>
          <option value="dol">dol</option>
        </select>

        <label>Które stanowisko chcesz usunąć: </label><br>
        <input type="text" name="MAC" required>
        <input type="submit" name="usun" value="Usuń MAC">
        <div class="center">
          <a class="alertB" onclick="hideDell()">Anuluj</a>
        </div>
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