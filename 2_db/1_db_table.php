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
            </tr>
USERS;
	    }
    }
    echo "</table><hr>";

    if (isset($_GET["addUserForm"])){
      echo <<< ADDUSERFORM
        <h3>Dodawanie użytkownika</h3>
ADDUSERFORM;

    }else{
      echo "<a href=\"./1_db_table.php?addUserForm=1\">Dodaj użytkownika</a>";
    }
?>

</body>
</html>
