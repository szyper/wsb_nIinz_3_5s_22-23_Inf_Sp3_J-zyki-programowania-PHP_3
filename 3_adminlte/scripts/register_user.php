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

	//print_r($errors);
	if (!empty($errors)){
		//$_SESSION["error_message"] = implode(", ", $errors);
		$_SESSION["error_message"] = implode("<br>", $errors);
		//print_r($_SESSION["error_message"]);
		//echo $_SESSION["error_message"];
		echo "<script>history.back();</script>";
	}
