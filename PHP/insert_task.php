<?php
include_once("./db.php");
session_start();

// raccolta dati da richiesta POST
$descrizione = $_POST["descrizione"];
$user_id = $_SESSION["user_id"];

$sql = "INSERT INTO tasks (descrizione, user_id) VALUES (?,?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $descrizione, $user_id);
if(!$stmt->execute())
    die();

$stmt->close();
$conn->close();
echo "Task inserito con successo!";

header("Location: ../HTML/dashboard.php");
die();

?>
