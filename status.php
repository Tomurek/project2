<?php

session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}


$atftpd = shell_exec("systemctl status atftpd | grep -w 'active' | awk '{print $2}'");
$ssh = shell_exec("systemctl status ssh | grep -w 'active' | awk '{print $2}'");
$www = shell_exec("systemctl status apache2 | grep -w 'active' | awk '{print $2}'");

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

  <table>
      <thead>
      <tr>
      <th>Usługa</th>
      <th>Status</th>
      <th></th>
      </tr>
    </thead>
    <tbody>
  <?php 
  if ($atftpd= "active")
  {
   echo (" <tr>");
   echo (" <td data-title='Usługa'> ATFTPD </td>");
   echo (" <td data-title='Status'>");
   echo ("  <div class='box'>");
   echo ("  <div class='server'>");
   echo ("    <ul>");
   echo ("      <li></li><li></li><li></li><li></li><li></li><li></li>");
   echo ("    </ul>");
   echo ("  </div>");
   echo ("  <span>RUNNING</span>");
   echo (" </div>");
   echo ("   </td>");
   echo ("  <td class='select'>");
   echo ("     <a href='?page=atftpdr()'><button class='button'>Wylacz</button> </a>
   <button class='button' onClick='window.location.reload();'>Odswież</button>");
   echo ("  </tr>");
  }
  else
  {
    echo (" <tr>");
    echo (" <td data-title='Usługa'> ATFTPD </td>");
    echo (" <td data-title='Status'>");
    echo ("  <div class='box'>");
    echo ("  <div class='server error'>");
    echo ("    <ul>");
    echo ("      <li></li><li></li><li></li><li></li><li></li><li></li>");
    echo ("    </ul>");
    echo ("  </div>");
    echo ("  <span>OFFLINE</span>");
    echo (" </div>");
    echo ("   </td>");
    echo ("  <td class='select'>
    <form method='post' action='stat.php'><button class='button' name='status' action='stat.php'>Restart</button></form>
    <button class='button' onClick='window.location.reload();'>Odswież</button> </td>");
    // echo ("     <a href='stat.php'><button class='button'>Wlacz</button></a></td>");  <form method='post' action='stat.php'>
    echo ("  </tr>");
   }
   if ($ssh = !"active")
   {
    echo (" <tr>");
    echo (" <td data-title='Usługa'> SSH </td>");
    echo (" <td data-title='Status'>");
    echo ("  <div class='box'>");
    echo ("  <div class='server'>");
    echo ("    <ul>");
    echo ("      <li></li><li></li><li></li><li></li><li></li><li></li>");
    echo ("    </ul>");
    echo ("  </div>");
    echo ("  <span>RUNNING</span>");
    echo (" </div>");
    echo ("   </td>");
    echo ("  <td class='select'>");
    echo (" <button class='button' name='status' action='stat.php'>Wylacz</button>
    <button class='button' onClick='window.location.reload();'>Odswież</button>");
    echo ("  </tr>");
   }
   else 
   {
     echo (" <tr>");
     echo (" <td data-title='Usługa'> SSH </td>");
     echo (" <td data-title='Status'>");
     echo ("  <div class='box'>");
     echo ("  <div class='server error'>");
     echo ("    <ul>");
     echo ("      <li></li><li></li><li></li><li></li><li></li><li></li>");
     echo ("    </ul>");
     echo ("  </div>");
     echo ("  <span>OFFLINE</span>");
     echo (" </div>");
     echo ("   </td>");
     echo ("  <td class='select'>
     <button class='button' name='status' action='stat.php'>Restart</button>
     <button class='button' onClick='window.location.reload();'>Odswież</button> </td>");
     echo ("  </tr>");
    }
    if ($www = !"active")
    {
     echo (" <tr>");
     echo (" <td data-title='Usługa'> WWW </td>");
     echo (" <td data-title='Status'>");
     echo ("  <div class='box'>");
     echo ("  <div class='server '>");
     echo ("    <ul>");
     echo ("      <li></li><li></li><li></li><li></li><li></li><li></li>");
     echo ("    </ul>");
     echo ("  </div>");
     echo ("  <span>RUNNING</span>");
     echo (" </div>");
     echo ("   </td>");
     echo ("  <td class='select'>");
     echo ("      <button class='button' onClick='window.location.reload();'>Odswież</button>");
     echo ("  </tr>");
    }
    else 
    {
      echo (" <tr>");
      echo (" <td data-title='Usługa'> WWW </td>");
      echo (" <td data-title='Status'>");
      echo ("  <div class='box'>");
      echo ("  <div class='server warning'>");
      echo ("    <ul>");
      echo ("      <li></li><li></li><li></li><li></li><li></li><li></li>");
      echo ("    </ul>");
      echo ("  </div>");
      echo ("  <span>WARNING</span>");
      echo (" </div>");
      echo ("   </td>");
      echo ("  <td class='select'>
      <button class='button' name='status' action='stat.php'>Restart</button></form>
      <button class='button' onClick='window.location.reload();'>Odswież</button> </td>");
      echo ("  </tr>");
     }
  ?>
   <tfoot>
      <tr><th colspan='3'>
      <button class="button" onClick="window.location.reload();">Odswież</button> </td>
      </th></tr>
    </tfoot>
     </tbody>
     </table>



  </main>
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