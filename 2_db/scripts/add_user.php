<?php
	session_start();
	//print_r($_POST);
	$error = 0;
	foreach ($_POST as $key => $value){
		//echo "$key: $value<br>";
		if (empty($value)){
			echo "$key<br>";
			echo "<script>history.back();</script>";
			exit();
		}
	}

	if (!isset($_POST["terms"])){
		$_SESSION["error"] = "Zatwierdź regulamin!";
		$error = 1;
	}

	if ($error != 0){
		echo "<script>history.back();</script>";
		exit();
	}

	require_once "./connect.php";
	$sql = "INSERT INTO `users` (`id`, `city_id`, `firstName`, `lastName`, `birthday`) VALUES (NULL, '$_POST[city_id]', '$_POST[firstName]', '$_POST[lastName]', '$_POST[birthday]');";
	$conn->query($sql);
	if ($conn->affected_rows != 0){
		$_SESSION["success"] = "Prawidłowo dodano użytkownika $_POST[firstName] $_POST[lastName]";
	}else{
		$_SESSION["error"] = "Nie dodano użytkownika!";
	}

	header("location: ../2_db_table_delete_add.php");