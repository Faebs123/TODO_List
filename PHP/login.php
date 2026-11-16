<?php
include_once("./db.php");

session_start();

// raccolta dati da richiesta POST
$username = $_POST["username"];
$password = $_POST["password"];


// recupero password salvata sul db corrispondente all'username
$sql = "SELECT password FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
if(!$stmt){ die(); }

if(!$stmt->bind_param("s", $username)) { die(); }

if(!$stmt->execute()) { die(); }

// recupero risposta dallo statement sottoforma di array associativo
$result = $stmt->get_result()->fetch_assoc();

// se non esiste l'username lo mando alla pagina di registrazione
if(!isset($result)){
    header("Location: ../HTML/signup.html");
    die();
}
$db_hashed_password = $result["password"];

/* password_verify() confronta la password in chiaro con quella salvata nel database */
$success = password_verify($password, $db_hashed_password);

if($success) {
    $_SESSION["username"] = $username;
    header("Location: ../HTML/dashboard.php");
    die();
}
else {
    echo "Password errata!";
    die();
}

?>
