<?php
	//print_r($_POST);
	session_start();
	$errors = [];
	foreach ($_POST as $key => $value){
		//echo "$key: $value<br>";
		if (empty($value)){
			$errors[] = "Pole <b>$key</b> jest wymagane";
		}
	}

	if (!isset($_POST["terms"]))
		$errors[] = "Pole <b>terms</b> jest wymagane";

	//dodaj walidację dla hasła i adresu email

	if ($_POST["email"] != $_POST["email2"])
		$errors[] = "Adrey poczty elektronicznej są różne!";

if ($_POST["pass"] != $_POST["pass2"])
	$errors[] = "Hasła są różne!";

	//print_r($errors);
	if (!empty($errors)){
		//$_SESSION["error_message"] = implode(", ", $errors);
		$_SESSION["error_message"] = implode("<br>", $errors);
		//print_r($_SESSION["error_message"]);
		//echo $_SESSION["error_message"];
		echo "<script>history.back();</script>";
		exit();
	}

	try{
	require_once "./connect.php";
	$stmt = $conn->prepare("INSERT INTO `users` (`city_id`, `email`, `firstName`, `lastName`, `birthday`, `password`) VALUES (?, ?, ?, ?, ?, ?);");
	$pass = password_hash($_POST["pass"], PASSWORD_ARGON2ID);
	$stmt->bind_param('isssss', $_POST["city_id"], $_POST["email"], $_POST["firstName"], $_POST["lastName"], $_POST["birthday"], $pass);
	$stmt->execute();
//	echo $stmt->affected_rows;
		if ($stmt->affected_rows == 1){
			$_SESSION["success"] = "Prawidłowo dodano użytkownika $_POST[firstName] $_POST[lastName]";
			header("location: ../pages/view");
		}
	} catch(mysqli_sql_exception $e){
		//echo $e->getMessage();
		$_SESSION["error_message"] = $e->getMessage();
		echo "<script>history.back();</script>";
		exit();
	}