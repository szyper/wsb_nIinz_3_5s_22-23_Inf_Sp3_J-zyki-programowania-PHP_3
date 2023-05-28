<?php
	//print_r($_POST);
session_start();
$errors = [];
foreach ($_POST as $key => $value){
	if (empty($value)){
		$errors[] = "Pole <b>$key</b> jest wymagane";
	}
}

if (!empty($errors)){
	$_SESSION["error_message"] = implode("<br>", $errors);
	echo "<script>history.back();</script>";
	exit();
}

try{
	require_once "./connect.php";
	$stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
	$stmt->bind_param('s', $_POST["login"]);
	$stmt->execute();
	$result = $stmt->get_result();
	$user = $result->fetch_assoc();
	if ($result->num_rows != 0){
		if(password_verify($_POST["pass"], $user["password"])){
			$_SESSION["logged"]["firstName"] = $user["firstName"];
			$_SESSION["logged"]["lastName"] = $user["lastName"];
//			$_SESSION["logged"]["role_id"] = $user["role_id"];
			header("location: ../pages/view/logged.php");
		}else{
			echo "error";
		}
	}else{
		echo "Nie ma takiego maila!";
	}

} catch(mysqli_sql_exception $e){
	//echo $e->getMessage();
	$_SESSION["error_message"] = $e->getMessage();
	echo "<script>history.back();</script>";
	exit();
}
