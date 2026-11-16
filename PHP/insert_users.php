<?php
include_once("./db.php");

// raccolta dati da richiesta POST
$username = $_POST["username"];
$password = $_POST["password"];

/* 
FUNZIONAMENTO DI password_hash():
-) generazione di un "salt", una stringa unica, da unire alla password
-) utilizzo di algoritmi di hashing moderni sulla stringa unita (lenti computazionalmente) 
    in questo caso PASSWORD_DEFAULT è il più forte e sicuro
-) inclusione dei metadati (algoritmo usato, costo computazionale e salt) per riavere la stringa originale 
*/
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO users (username, password) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
if(!$stmt)
    die();

$stmt->bind_param("ss", $username, $hashed_password);

if(!$stmt->execute())
    die();

session_start();
$_SESSION["username"] = $username;

$stmt->close();
$conn->close();
echo "Utente inserito con successo!";

header("Location: ../HTML/dashboard.php");

?>
