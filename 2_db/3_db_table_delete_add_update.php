<?php
  session_start();
?>
<!doctype html>
<html lang="pl">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/table.css">
	<title>Użytkownicy</title>
</head>
<body>
<?php
  if (isset($_GET["deleteUser"])){
    if ($_GET["deleteUser"] == 0){
      echo "<h4>Nie udało się usunąć użytkownika</h4>";
    }else{
      echo "<h4>Udało się usunąc użytkownika o id=$_GET[deleteUser]</h4>";
    }
    }

    if (isset($_SESSION["success"])){
      echo "<h4>$_SESSION[success]</h4>";
      unset($_SESSION["success"]);
    }

    if (isset($_SESSION["error"])){
      echo "<h4>$_SESSION[error]</h4>";
      unset($_SESSION["error"]);
    }
?>
<h4>Użytkownicy</h4>
<table>
    <tr>
        <th>Imię</th>
        <th>Nazwisko</th>
        <th>Data urodzenia</th>
        <th>Miasto</th>
        <th>Województwo</th>
    </tr>

<?php
	require_once "./scripts/connect.php";
    $sql = "SELECT users.id, users.firstName, users.lastName, users.birthday, cities.cityName, states.stateName FROM `users`INNER JOIN `cities` ON `users`.`city_id`=`cities`.`id` INNER JOIN `states` ON `cities`.`state_id`=`states`.`id`;";
    $result = $conn->query($sql);
//    echo $result->num_rows;
    if ($result->num_rows == 0){
      echo "<tr><td colspan='5'>Brak rekordów do wyświetlenia</td></tr>";
    }else{
	    while($user = $result->fetch_assoc()){
		    echo <<< USERS
            <tr>
                <td>$user[firstName]</td>
                <td>$user[lastName]</td>
                <td>$user[birthday]</td>
                <td>$user[cityName]</td>
                <td>$user[stateName]</td>
                <td><a href="./scripts/deleteUser.php?userId=$user[id]">Usuń</a></td>
                  <td><a href="./3_db_table_delete_add_update.php?updateUserId=$user[id]">Aktualizacja</a></td>
            </tr>
USERS;
	    }
    }
    echo "</table><hr>";

    //dodawanie użytkownika
    if (isset($_GET["addUserForm"])){
      echo <<< ADDUSERFORM
        <h3>Dodawanie użytkownika</h3>
        <form action="./scripts/add_user.php" method="post">
          <input type="text" name="firstName" placeholder="Podaj imię"><br><br>
          <input type="text" name="lastName" placeholder="Podaj nazwisko"><br><br>
          <input type="date" name="birthday"> Data urodzenia<br><br>
          <select name="city_id">
ADDUSERFORM;
      $sql = "SELECT * FROM `cities`";
      $result = $conn->query($sql);
      while ($city = $result->fetch_assoc()){
        echo "<option value='$city[id]'>$city[cityName]</option>";
      }
	    echo <<< ADDUSERFORM
          </select><br><br>
          <input type="checkbox" name="terms"> Regulamin<br><br>
          <input type="submit" value="Dodaj Użytkownika">
        </form>
ADDUSERFORM;

    }else{
      echo "<a href=\"./3_db_table_delete_add_update.php?addUserForm=1\">Dodaj użytkownika</a>";
    }

    //aktualizacja użytkownika
if (isset($_GET["updateUserId"]))
{
	$_SESSION["updateUserId"] = $_GET["updateUserId"];
  $sql = "SELECT * FROM users WHERE id=$_GET[updateUserId]";
  $result = $conn->query($sql);
  $user = $result->fetch_assoc();
	echo <<< UPDATEUSERFORM
        <h3>Aktulizacja użytkownika</h3>
        <form action="./scripts/update_user.php" method="post">
          <input type="text" name="firstName" placeholder="Podaj imię" value="$user[firstName]"><br><br>
          <input type="text" name="lastName" placeholder="Podaj nazwisko" value="$user[lastName]"><br><br>
          <input type="date" name="birthday" value="$user[birthday]"> Data urodzenia<br><br>
          <select name="city_id">
UPDATEUSERFORM;
	$sql = "SELECT * FROM `cities`";
	$result = $conn->query($sql);
	while ($city = $result->fetch_assoc()){
    if ($user["city_id"] == $city["id"]){
			echo "<option value='$city[id]' selected>$city[cityName]</option>";
    }else{
			echo "<option value='$city[id]'>$city[cityName]</option>";
    }

	}
	echo <<< UPDATEUSERFORM
          </select><br><br>
          <input type="checkbox" name="terms"> Regulamin<br><br>
          <input type="submit" value="Zaktualizuj Użytkownika">
        </form>
UPDATEUSERFORM;

}
    $conn->close();
?>

</body>
</html>
