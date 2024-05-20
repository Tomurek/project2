<?php
require_once "config.php";

$sql = "SELECT * FROM login";

$result = mysqli_query($link, $sql);

echo "<table border='1'>
<tr>
<th>ID</th>
<th>Name</th>
<th>Surname</th>
<th>Username</th>
<th>Password</th>
</tr>";

while ($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td>" . $row['id'] . "</td>";
  echo "<td>" . $row['name'] . "</td>";
  echo "<td>" . $row['surname'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" . $row['passwd'] . "</td>";
  echo "</tr>";
}
echo "</table>";

mysqli_close($link);
